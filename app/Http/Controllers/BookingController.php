<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BookingController extends Controller
{
    //
    public function index(){

        Gate::authorize("viewAny",[Booking::class]);

        return Booking::all();
    }
    public function store(Request $request){
        $request->validate([
            "client_id"=>"required",
            "rooms_ids"=>"required|array",
            "start_date"=>"required|date",
            "end_date"=>"required|date",
            "status"=>"required"
        ]);

        Gate::authorize("create",[Booking::class]);

        $start_date=Carbon::parse($request->start_date)->toDate();
        $end_date=Carbon::parse($request->end_date)->toDate();

        if($this->canBooking($request->rooms_ids,$start_date,$end_date)){
            $booking=Booking::create(["user_id"=>Auth::user()->id,"client_id"=>$request->client_id,"start_date"=>$request->start_date,"end_date"=>$request->end_date,"status"=>$request->status]);
            $booking->rooms()->attach($request->rooms_ids[0]);
        }
        else{
            return ["message"=>"can not booking."];
        }
        return $booking;
    }

    public function show(Booking $booking){

        Gate::authorize("view",[Booking::class]);

        return $booking;
    }
    
    public function update(Request $request, Booking $booking){
        $r=$request->validate([
            "client_id"=>"required",
            "start_date"=>"required",
            "end_date"=>"required",
            "status"=>"required"
        ]);

        Gate::authorize("update",[Booking::class]);

        $booking->update($r);
        return $booking;
    }
    public function destroy(Booking $booking){

        Gate::authorize("delete",[Booking::class]);

        return $booking->delete();
    }

    private function canBooking($rooms_ids ,$start_date,$end_date){
        foreach($rooms_ids as $i){
            $room=Room::find($i);
            if($room){

                // if found in the same start date and end date
                $check0=$room->bookings()->where("start_date",$start_date)
                ->where("end_date",$end_date)->exists();

                $check1=$room->bookings()->where("start_date","<",$start_date)
                ->where("end_date",">",$start_date)
                ->exists();
               
                $check2=$room->bookings()->where("start_date","<",$end_date)
                ->where("end_date",">",$end_date)
                ->exists();


                $check3=$room->bookings()->where("start_date",">",$start_date)
                ->where("end_date","<",$end_date)
                ->exists();


                if($check0|| $check1 || $check2 || $check3){
                    return false;
                }
            }
        }
        
        
        return true;
    }
}
