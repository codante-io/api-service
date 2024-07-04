<?php

namespace App\Http\Controllers\RegisterUser;

use App\Http\Controllers\Controller;
use App\Rules\ValidCpf;
use Illuminate\Http\Request;

class RegisterUserController extends Controller
{
    public function validate(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:8|max:255',
            'password_confirmation' => 'required|min:8|max:255',
            'terms' => ['required'],
            'phone' => 'required|max:20',
            'cpf' => ['required', 'max:14', 'regex:/\d{3}\.\d{3}\.\d{3}-\d{2}/', new ValidCpf()],
            'zipcode' => 'required|max:9|regex:/\d{5}-\d{3}/',
            'address' => 'required|max:255',
            'city' => 'required|max:255',
        ]);

        return response()->json(["message" => "User registered.", "user" => $request->all()]);
    }
}
