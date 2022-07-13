<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Front_AuthController extends Controller
{
    public function index()
    {
        return view('Front_Auth.Sign_in.index');
    }

    public function store(Request $request)
    {
        if (Auth::attempt([
                'username' => $request->username, 
                'password' => $request->password
            ]) || Auth::attempt([
                'email' => $request->username,
                'password' => $request->password
            ]))
        {
            // $user = User::where('username', $request->username)->first();
            // $user_activation =  $user->is_active;

            $user_activation = Auth::user()->is_active;

            if ($user_activation == 1)
            {
                // $token = $user->createToken('userToken')->accessToken;
                return redirect()->route('dashboard');
            }
            else
            {
                Auth::logout();
                return redirect()->route('notactive');
            }
        }
        else{
            return redirect()->route('masuk')
            ->with('error','Username/Email dan Password salah')->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('masuk');
    }
}
