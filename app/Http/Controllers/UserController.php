<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

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


    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->getMessageBag()->all());
        }

        return response()->json(User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]));
    }


}
