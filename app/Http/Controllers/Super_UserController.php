<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class Super_UserController extends Controller
{
    public function index()
    {
        return view('Super_Admin.User.index');
    }

    public function create()
    {
        $role = Role::all();
        return view('Super_Admin.User.create', ['data'=>$role]);
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $get_user = User::all();

        foreach ($get_user as $user) {
            if ($user->email == $request->email) {
                return redirect()->back()->with('error', 'Email sudah terdaftar')->withInput();
            }elseif ($user->username == $request->username) {
                return redirect()->back()->with('error', 'Username sudah terdaftar')->withInput();
            }
        }

        $messages = [
            'name.required' => 'Nama Lengkap diisi ya..',
            'email.required' => 'Email aktif kamu dicantumkan ya..',
            'email.email' => 'Coba cek lagi emailnya, kayaknya salah..',
            'username.required' => 'Username Diisi dong..',
            'password.required' => 'Password diisi dong..',
            'password.min' => 'Password diisi minimal 8 karakter ya..',
        ];

        $validator = Validator::make( $request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'password' => 'required|min:8',
        ], $messages );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }else {
            
            $signup = new User;
            $signup->name = $request->name;
            $signup->username = $request->username;
            $signup->email = $request->email;
            $signup->password = bcrypt($request->password);
            $signup->is_active = 1;
            $signup->role_id = $request->roles_id;

            $daftar = $signup->save();
            if ($daftar) {
                return redirect()->route('user.index')->with('success','Data Berhasil Dibuat');
            }else {
                return redirect()->route('user.create')->with('error', 'Upps, Error nih')->withInput();
            }

        }
    }

    public function edit($id)
    {
        $old =  User::findOrFail($id);
        $role = Role::all();
        return view('Super_Admin.User.edit', ['data'=>$old, 'role'=>$role]);
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'password.required' => 'Password diisi dong..',
            'password.min' => 'Password diisi minimal 8 karakter ya..',
        ];

        $validator = Validator::make( $request->all(), [
            'password' => 'required|min:8',
        ], $messages );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }else {
            
            $data = User::find($id);
            $data->name = $request->name;
            $data->username = $request->username;
            $data->email = $request->email;
            $data->password = bcrypt($request->password);
            $data->role_id = $request->roles_id;

            $daftar = $data->save();
            if ($daftar) {
                return redirect()->route('user.index')->with('success','Data Berhasil Diubah');
            }else {
                return redirect()->route('user.edit')->with('error', 'Upps, Error nih');
            }
        }

    }

    public function delete($id)
    {
        $data = User::find($id);
        $hapus = $data->delete();

        if ($hapus) {
            return redirect()->route('user.index')->with('success','Data Berhasil Dihapus');
        }else {
            return redirect()->route('user.index')->with('error', 'Upps, Error nih');
        }
    }

    public function activation($id, $data)
    {
        $old = User::find($id);
        $old->is_active = $data;
        $active = $old->save();

        if ($active) {
            return redirect()->route('user.index')->with('success','Data Berhasil Diubah');
        }else {
            return redirect()->route('user.index')->with('error', 'Upps, Error nih');
        }

    }

    public function serverside()
    {
        $data = User::query();
        return DataTables::eloquent($data)
        
        ->orderColumn('name', function ($query, $order) {
            $query->orderBy('name', 'asc');
        })
        ->addColumn('username', function ($data) {
            $username = '<td>'.$data->username.'</td>';
            return $username;
        })
        ->addColumn('email', function ($data) {
            $email = '<td>'.$data->email.'</td>';
            return $email;
        })
        ->addColumn('role', function ($data) {
            $role = '<td>'.$data->role->name.'</td>';
            return $role;
        })
        ->addColumn('active', function ($data) {
            if ($data->is_active == 0) {
                $active = '<td> <a class="btn btn-secondary btn-sm" style="margin-right: 10px;" href="'.route('user.activation', ['id'=>$data->id, 'data'=>'1']).'">OFF</a></td>';
            }else {
                $active = '<td> <a class="btn btn-success btn-sm" style="margin-right: 20px;" href="'.route('user.activation', ['id'=>$data->id, 'data'=>'0']).'">ON</a> </td>';
            }
            return $active;
        })
        ->addColumn('action', function ($data) {
            $action = '<td>
                            <a style="margin-right: 20px;" href="'.route('user.edit', ['id' => $data->id]).'"><i class="fa fa-edit text-warning" style="font-size: 21px;"></i></a>
                            
                            <a style="margin-right: 10px;" href="'.route('user.delete', ['id' => $data->id]).'"><i class="fa fa-trash text-danger" style="font-size: 21px;"></i></a>
                        </td>';
            return $action;
        })
        ->rawColumns(['name', 'username', 'email', 'role', 'active', 'action'])
        ->make(true);
    }
}
