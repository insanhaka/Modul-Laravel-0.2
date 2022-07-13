<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class Back_AuthController extends Controller
{
    public function index()
    {
        return view('Back_Auth.Sign_in.index');
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
            $user_role_id = Auth::user()->role_id;
            $user_role = Role::find($user_role_id);

            if ($user_activation == 1 && $user_role->name !== "User")
            {
                // $token = $user->createToken('userToken')->accessToken;
                return redirect()->route('control');
            }
            elseif ($user_activation == 1 && $user_role->name == "User") {
                return redirect()->route('dapur')->with('error','Hanya Admin yg bisa masuk ke sini')->withInput();
            }
            else
            {
                Auth::logout();
                return redirect()->route('notactive');
            }
        }
        else{
            return redirect()->route('dapur')
            ->with('error','Username/Email dan Password salah')->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('dapur');
    }
}
