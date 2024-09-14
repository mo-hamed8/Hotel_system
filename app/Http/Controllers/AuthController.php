<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function login(Request $request){
        $r=$request->validate([
            "email"=>"required|email|exists:Users",
            "password"=>"required"
        ]);
        $user=User::where("email",$request->email)->first();
        if(!$user || !Hash::check($request->password,$user->password)){
            return ["message"=>"fuck you"];
        }

        $token=$user->createToken($request->email)->plainTextToken;
        return ["email"=>$user->email,"token"=>$token];
    }

    public function register(Request $request){
        $request->validate([
            "name"=>"required",
            "email"=>"required|email|unique:Users",
            "password"=>"required|confirmed"
        ]);

        $user=User::create([
            "email"=>$request->email,
            "password"=>$request->password,
            "name"=>$request->name
        ]);

        $token=$user->createToken($user->email)->plainTextToken;
        return ["email"=>$user->email,"token"=>$token];
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return ["message"=>"done"];
    }
}
