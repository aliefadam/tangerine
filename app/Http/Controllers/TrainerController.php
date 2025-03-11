<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use phpseclib3\Math\BinaryField;

class TrainerController extends Controller
{
    public function index()
    {
        return view('backend.trainer.index', [
            "title" => "Trainer",
            "trainers" => Trainer::all(),
        ]);
    }

    public function create()
    {
        return view('backend.trainer.create', [
            "title" => "Add Trainer",
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $file = $request->file("image");
            $fileName = "TRAINER_IMAGE_" . date("Ymdhis") . "." . $file->extension();
            $file->move(public_path("uploads/trainers"), $fileName);
            Trainer::create([
                "name" => $request->name,
                "description" => $request->description,
                "image" => $fileName,
                "facebook_link" => $request->facebook_link,
                "instagram_link" => $request->instagram_link,
                "twitter_link" => $request->twitter_link,
                "for_class" => $request->for_class,
            ]);
            DB::commit();
            return redirect_user("success", "Successfully Add Trainer", "admin.trainer.index");
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
        $trainer = Trainer::find($id);
        return view('backend.trainer.edit', [
            "title" => "Edit Trainer {$trainer->name}",
            "trainer" => $trainer,
        ]);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $trainer = Trainer::find($id);
        $updatedData = [
            "name" => $request->name,
            "description" => $request->description,
            "facebook_link" => $request->facebook_link,
            "instagram_link" => $request->instagram_link,
            "twitter_link" => $request->twitter_link,
            "for_class" => $request->for_class,
        ];
        if ($request->hasFile("image")) {
            $file = $request->file("image");
            $fileName = "TRAINER_IMAGE_" . date("Ymdhis") . "." . $file->extension();
            $file->move(public_path("uploads/trainers"), $fileName);
            if (File::exists(public_path("uploads/trainers/{$trainer->image}"))) {
                unlink(public_path("uploads/trainers/{$trainer->image}"));
            }
            $updatedData["image"] = $fileName;
        }
        try {
            $trainer->update($updatedData);
            DB::commit();
            return redirect_user("success", "Successfully Edit Trainer", "admin.trainer.index");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect_user("error", $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $trainer = Trainer::find($id);
            $trainer->delete();

            notificationFlash("success", "Successfully Deleted Trainer");
            return response()->json([
                "success" => true,
            ]);
        } catch (\Exception $e) {
            notificationFlash("success", $e->getMessage());
            return response()->json([
                "success" => false,
            ]);
        }
    }
}
