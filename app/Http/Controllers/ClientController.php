<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ClientController extends Controller
{
    //
    public function index(){

        Gate::authorize("viewAny",[Client::class]);

        return ClientResource::collection(Client::all());
    }

    public function store(Request $request){
        $r=$request->validate([
            "name"=>"required|max:255",
            "phone"=>"required",
            "identity_number"=>"required"
        ]);

        Gate::authorize("create",[Client::class]);

        $client=Client::create($r);
        return ClientResource::make($client);
    }

    public function show(Client $client){

        Gate::authorize("view",[Client::class]);

        return ClientResource::make($client);
    }
    
    public function update(Request $request, Client $client){
        $r=$request->validate([
            "name"=>"required|max:255",
            "phone"=>"required",
            "identity_number"=>"required"
        ]);

        Gate::authorize("update",[Client::class]);

        $clientNew=$client->update($r);
        return ClientResource::make($client);
    }
    public function destroy(Client $client){

        Gate::authorize("delete",[Client::class]);

        return $client->delete();
    }
}
