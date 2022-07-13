<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;

class Api_AuthorizeController extends Controller
{
    public function postlogin(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            $user = User::where('email', $request->email)->first();
            $user_activation = Auth::user()->is_active;
            $user_role_id = Auth::user()->role_id;
            $user_role = Role::find($user_role_id);

            if ($user_activation == 1 && $user_role->name == "User")
            {
                $token = $user->createToken('Token')->accessToken;
                return response()->json([
                    'message' => 'success',
                    'user' => $user->name,
                    'token' => $user->name.'#'.$user->email.'#'.$token
                ]);
            }
            else
            {
                return response()->json([
                    'message' => 'failed',
                    'data' => 'User Tidak Aktif',
                ]);
            }
        }
        else
        {
            return response()->json([
                'message' => 'error',
                'data' => 'Email / Password yang anda ketik tidak cocok',
            ]);
        }

    }

    public function postsignup(Request $request)
    {
        $datauser = User::all();

        $messages = [
            'nama.required' => 'Tulis nama lengkap kamu',
            'email.required' => 'Masukan alamat email kamu',
            'email.email' => 'Coba cek ulang alamat email kamu, kayaknya salah',
            'password.min' => 'Password harus terdiri minimal 8 karakter',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], $messages);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'error',
                'data' => $validator->errors()->first()
            ]);
        }

        foreach ($datauser as $user) {
            if ($user->email == $request->email) {
                return response()->json([
                    'message' => 'error',
                    'data' => 'Email sudah terdaftar'
                ]);
            }
        }

        $signup = new User;
        $signup->name = $request->name;
        $signup->email = $request->email;
        $signup->password = bcrypt($request->password);
        $signup->is_active = 1;
        $signup->role_id = 3;

        $process = $signup->save();

        if ($process) {
            return response()->json([
                'message' => 'success',
                'data' => 'Registrasi Berhasil',
            ]);
        }else {
            return response()->json([
                'message' => 'error',
                'data' => 'Upps.. Registrasi Gagal',
            ]);
        }
    }
}
