<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    protected $redirectTo = '/usuario/home';

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        //$email = $request->input('email');
        //$password = $request->input('password'));

        if (Auth::attempt($credentials)) {
            //return Auth::user()->nome_completo;
            //return redirect()->intended('/usuario/home');
            return var_dump(Auth::user());
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
