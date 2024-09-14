<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoomResource;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoomController extends Controller
{
    //
    public function index(){

        Gate::authorize("viewAny",[Room::class]);

        return RoomResource::collection(Room::all());
    }
    public function store(Request $request){
        $request->validate([
            "name"=>"required|max:255",
            "description"=>"required",
            "type"=>"required"
        ]);

        Gate::authorize("create",[Room::class]);

        $room=Room::create(["name"=>$request->name,"description"=>$request->description,"type"=>$request->type]);
        return RoomResource::make($room);
    }

    public function show(Room $room){

        Gate::authorize("view",[Room::class]);

        return RoomResource::make($room);
    }
    
    public function update(Request $request, Room $room){
        $r=$request->validate([
            "name"=>"required|max:255",
            "description"=>"required",
            "type"=>"required"
        ]);

        Gate::authorize("update",[Room::class]);

        $room->update($r);
        return RoomResource::make($room);
    }
    public function destroy(Room $room){

        Gate::authorize("delete",[Room::class]);

        return $room->delete();
    }
}
