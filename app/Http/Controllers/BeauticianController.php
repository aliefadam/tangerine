<?php

namespace App\Http\Controllers;

use App\Models\Beautician;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class BeauticianController extends Controller
{
    public function index()
    {
        return view('backend.beautician.index', [
            "title" => "Beautician",
            "beauticians" => Beautician::all(),
        ]);
    }

    public function create()
    {
        return view('backend.beautician.create', [
            "title" => "Add Beautician",
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $file = $request->file("image");
            $fileName = "BEAUTICIAN_IMAGE_" . date("Ymdhis") . "." . $file->extension();
            $file->move(public_path("uploads/beauticians"), $fileName);
            Beautician::create([
                "name" => $request->name,
                "description" => $request->description,
                "image" => $fileName,
            ]);
            DB::commit();
            return redirect_user("success", "Successfully Add Beautician", "admin.beautician.index");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect_user("error", $e->getMessage());
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $beautician = Beautician::find($id);
        return view('backend.beautician.edit', [
            "title" => "Edit Beautician {$beautician->name}",
            "beautician" => $beautician,
        ]);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $beautician = Beautician::find($id);
        $updatedData = [
            "name" => $request->name,
            "description" => $request->description,
        ];
        if ($request->hasFile("image")) {
            $file = $request->file("image");
            $fileName = "BEAUTICIAN_IMAGE_" . date("Ymdhis") . "." . $file->extension();
            $file->move(public_path("uploads/beauticians"), $fileName);
            if (File::exists(public_path("uploads/beauticians/{$beautician->image}"))) {
                unlink(public_path("uploads/beauticians/{$beautician->image}"));
            }
            $updatedData["image"] = $fileName;
        }
        try {
            $beautician->update($updatedData);
            DB::commit();
            return redirect_user("success", "Successfully Edit Beautician", "admin.beautician.index");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect_user("error", $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $beautician = Beautician::find($id);
            $beautician->delete();

            notificationFlash("success", "Successfully Deleted Beautician");
            return redirect_user("success", "Successfully Deleted Beautician", "admin.beautician.index");
        } catch (\Exception $e) {
            notificationFlash("failed", $e->getMessage());
            return redirect_user("error", $e->getMessage());
        }
    }
}
