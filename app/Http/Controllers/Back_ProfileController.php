<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class Back_ProfileController extends Controller
{
    public function index($id)
    {
        $get_user = User::find($id);
        return view('Backend.profile.index', ['data' => $get_user]);
    }

    public function edit($id)
    {
        $get_user = User::find($id);
        return view('Backend.profile.edit', ['data' => $get_user]);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());

        $messages = [
            'password.required' => 'Password diisi dong..',
            'password.min' => 'Password diisi minimal 8 karakter ya..',
        ];

        $validator = Validator::make( $request->all(), [
            'password' => 'required|min:8',
        ], $messages );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }else {

            $data = User::find($id);
            $data->name = $request->name;
            $data->username = $request->username;
            $data->email = $request->email;
            $data->password = bcrypt($request->password);

            $file = $request->file('photo');

            if($file == null){
                $simpan = $data->save();
                if ($simpan) {
                    return redirect()->route('profile.index', ['id' => $id])->with('success','Data Berhasil Diubah');
                }else {
                    return redirect()->back()->with('error', 'Upps, Error nih');
                }
            }else{
                $nama_file = time()."_".$file->getClientOriginalName();
                // Proses file diupload ke storage
                $path = Storage::putFileAs('public/profile-picture', $file, $nama_file);
                $data->photo = $nama_file;

                $simpan = $data->save();
                if ($simpan) {
                    return redirect()->route('profile.index', ['id' => $id])->with('success','Data Berhasil Diubah');
                }else {
                    return redirect()->back()->with('error', 'Upps, Error nih');
                }
            }
        }
    }
}