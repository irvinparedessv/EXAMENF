<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vendedor;
use Illuminate\Http\Request;
use Hash;

class UserController extends Controller
{
public function store(Request $request)
    {
        $user = new User();
        $user->password = Hash::make($request['password']);
        $user->email = $request['email'];
        $user->name = $request['name'];
        $user->save();
        $request['id_usuario']= $user->id;
        Vendedor::insert($request->except(['email','password','name']));
        
        return response()->json(['message'=>'success']);
    }
}