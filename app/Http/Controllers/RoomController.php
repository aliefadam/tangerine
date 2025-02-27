<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class RoomController extends Controller
{
    public function index()
    {
        return view("backend.room.index", [
            "title" => "Room",
            "rooms" => Room::all(),
        ]);
    }

    public function create()
    {
        return view("backend.room.create", [
            "title" => "Add Room",
        ]);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $file = $request->file("room_image");
            $fileName = "ROOM_IMAGE_" . date("Ymdhis") . "." . $file->extension();
            $file->move(public_path("uploads/rooms"), $fileName);
            Room::create([
                "name" => $request->name,
                "used_for" => $request->used_for,
                "capacity" => $request->capacity,
                "image" => $fileName,
            ]);
            DB::commit();
            return redirect_user("success", "Successfully Added Room", "admin.room.index");
        } catch (\Exception $e) {
            DB::rollback();
            return redirect_user("error", $e->getMessage());
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $room = Room::find($id);
        return view("backend.room.edit", [
            "title" => "Edit Room {$room->name}",
            "room" => $room,
        ]);
    }

    public function update(Request $request, $id)
    {
        $room = Room::find($id);
        try {
            DB::beginTransaction();
            $updatedData = [
                "name" => $request->name,
                "used_for" => $request->used_for,
                "capacity" => $request->capacity,
            ];
            if ($request->hasFile("room_image")) {
                $file = $request->file("room_image");
                $fileName = "ROOM_IMAGE_" . date("Ymdhis") . "." . $file->extension();
                $file->move(public_path("uploads/rooms"), $fileName);
                if (File::exists(public_path("uploads/rooms/{$room->image}"))) {
                    unlink(public_path("uploads/rooms/{$room->image}"));
                }
                $updatedData["image"] = $fileName;
            }
            $room->update($updatedData);
            DB::commit();
            return redirect_user("success", "Successfully Edit Room", "admin.room.index");
        } catch (\Exception $e) {
            DB::rollback();
            return redirect_user("error", $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $room = Room::find($id);
        $room->delete();

        notificationFlash("success", "Successfully Delete Room");
        return response()->json(["success" => true]);
    }
}
