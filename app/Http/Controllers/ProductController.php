<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        return view("backend.product.index", [
            "title" => "Product",
            "products" => Product::all(),
        ]);
    }

    public function create()
    {
        return view("backend.product.create", [
            "title" => "Add Product",
            "product" => Product::all(),
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $file = $request->file("image");
            $fileName = "SERIVCE_IMAGE_" . date("Ymdhis") . "." . $file->extension();
            $file->move(public_path("uploads/products"), $fileName);
            Product::create([
                "name" => $request->name,
                "image" => $fileName,
                "link" => $request->link,
            ]);
            DB::commit();
            return redirect_user("success", "Successfully Added Class", "admin.product.index");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect_user("error", $e->getMessage());
        }
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view("backend.product.edit", [
            "title" => "Edit Product {$product->name}",
            "product" => $product,
        ]);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $product = Product::find($id);
        try {
            $updatedData = [
                "name" => $request->name,
                "slug" => Str::slug($request->name),
                "category_id" => $request->category_id,
            ];
            if ($request->hasFile("image")) {
                $file = $request->file("image");
                $fileName = "SERVICE_IMAGE_" . date("Ymdhis") . "." . $file->extension();
                $file->move(public_path("uploads/products"), $fileName);
                if (File::exists(public_path("uploads/products/{$product->image}"))) {
                    unlink(public_path("uploads/products/{$product->image}"));
                }
                $updatedData["image"] = $fileName;
            }
            $product->update($updatedData);
            DB::commit();
            return redirect_user("success", "Successfully Updated Product", "admin.product.index");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect_user("error", $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        notificationFlash("success", "Successfully Delete Product");
        return redirect_user("success", "Successfully Deleted Product", "admin.product.index");
    }
}
