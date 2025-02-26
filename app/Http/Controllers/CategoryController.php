<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        return view("backend.category.index", [
            "title" => "Category",
            "categories" => Category::all(),
        ]);
    }

    public function create()
    {
        return view("backend.category.create", [
            "title" => "Category",
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $file = $request->file("image");
            $fileName = "CATEGORY_IMAGE_" . date("Ymdhis") . "." . $file->extension();
            $file->move(public_path("uploads/categories"), $fileName);
            Category::create([
                "name" => $request->name,
                "slug" => Str::slug($request->name),
                "description" => $request->description,
                "image" => $fileName,
            ]);
            DB::commit();
            return redirect_user("success", "Successfully Added Class Category", "admin.category.index");
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
        $category = Category::find($id);
        return view("backend.category.edit", [
            "title" => "Category",
            "category" => $category,
        ]);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $category = Category::find($id);
        try {
            $updatedData = [
                "name" => $request->name,
                "slug" => Str::slug($request->name),
                "description" => $request->description,
            ];
            if ($request->hasFile("image")) {
                $file = $request->file("image");
                $fileName = "CATEGORY_IMAGE_" . date("Ymdhis") . "." . $file->extension();
                $file->move(public_path("uploads/categories"), $fileName);
                if (File::exists(public_path("uploads/categories/{$category->image}"))) {
                    unlink(public_path("uploads/categories/{$category->image}"));
                }
                $updatedData["image"] = $fileName;
            }
            $category->update($updatedData);
            DB::commit();
            return redirect_user("success", "Successfully Added Class Category", "admin.category.index");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect_user("error", $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        notificationFlash("success", "Successfully Delete Class Category");
        return response()->json(["success" => true]);
    }
}
