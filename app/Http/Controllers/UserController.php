<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\User;


class UserController extends Controller
{
    public function login(Requests\UserRequest $request)
    {
        return (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) ?
            response()->json(Auth::user()) :
            null;
    }


    public function register(Requests\UserPostRequest $request)
    {
        return response()->json(User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]));
    }
}
