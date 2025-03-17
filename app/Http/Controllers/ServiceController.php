<?php

namespace App\Http\Controllers;

use App\Models\CategorySalon;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        return view("backend.service.index", [
            "title" => "Service",
            "services" => Service::with("categorySalon")->get(),
        ]);
    }

    public function create()
    {
        return view("backend.service.create", [
            "title" => "Add Service",
            "categories" => CategorySalon::all(),
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $file = $request->file("image");
            $fileName = "SERIVCE_IMAGE_" . date("Ymdhis") . "." . $file->extension();
            $file->move(public_path("uploads/services"), $fileName);
            Service::create([
                "name" => $request->name,
                "slug" => Str::slug($request->name),
                "image" => $fileName,
                "price" => $request->price,
                "category_salon_id" => $request->category_id,
            ]);
            DB::commit();
            return redirect_user("success", "Successfully Added Class", "admin.service.index");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect_user("error", $e->getMessage());
        }
    }

    public function edit($id)
    {
        $service = Service::find($id);
        return view("backend.service.edit", [
            "title" => "Edit Service {$service->name}",
            "service" => $service,
            "categories" => CategorySalon::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $service = Service::find($id);
        try {
            $updatedData = [
                "name" => $request->name,
                "slug" => Str::slug($request->name),
                "price" => $request->price,
                "category_salon_id" => $request->category_id,
            ];
            if ($request->hasFile("image")) {
                $file = $request->file("image");
                $fileName = "SERVICE_IMAGE_" . date("Ymdhis") . "." . $file->extension();
                $file->move(public_path("uploads/services"), $fileName);
                if (File::exists(public_path("uploads/services/{$service->image}"))) {
                    unlink(public_path("uploads/services/{$service->image}"));
                }
                $updatedData["image"] = $fileName;
            }
            $service->update($updatedData);
            DB::commit();
            return redirect_user("success", "Successfully Updated Service", "admin.service.index");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect_user("error", $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $service = Service::find($id);
        // $service->serviceDetails()->delete();
        $service->delete();

        notificationFlash("success", "Successfully Delete Class");
        return redirect_user("success", "Successfully Deleted Class", "admin.service.index");
    }
}
