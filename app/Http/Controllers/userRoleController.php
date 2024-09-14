<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class userRoleController extends Controller
{

    public function __construct()
    {
        Gate::define("RoleControl",function(User $user){
            return $user->role==="system_manager";
        });
    }
    //
    public function assignRoleToUser(Request $request){
        $request->validate([
            "employee_email"=>"required|email|exists:Users,email",
            "role_title"=>"required|max:255"
        ]);

        Gate::authorize("RoleControl");

        $roles=config("roles.roles");
        
        if(in_array($request->role_title,$roles)){
            $user=User::where("email",$request->employee_email)->first();
            $user->role=$request->role_title;
            $user->save();
        }
        else{
            return["message"=>"error"];
        }

        return ["message"=>"done"];
        
    }
    public function removeRoleFromUser(Request $request){
        $request->validate([
            "employee_email"=>"required|email|exists:Users,email"
        ]);

        Gate::authorize("RoleControl");

        $user=User::where("email",$request->employee_email)->first();
        $user->role="user";
        $user->save();
        return ["message"=>"done"];
    }
}
