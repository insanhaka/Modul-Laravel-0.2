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
                return response()->json([
                    'message' => 'error',
                    'data' => 'Email sudah terdaftar',
                ]);
            }
        }

        $messages = [
            'name.required' => 'Nama Lengkap diisi ya..',
            'email.required' => 'Email aktif kamu dicantumkan ya..',
            'email.email' => 'Coba cek lagi emailnya, kayaknya salah..',
            'password.required' => 'Password diisi dong..',
            'password.min' => 'Password diisi minimal 8 karakter ya..',
            'role.required' => 'Pilih role untuk user tersebut.',
        ];

        $validator = Validator::make( $request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'role' => 'required',
        ], $messages );

        if ($validator->fails()) {
            return response()->json([
                'message' => 'error',
                'data' => $validator->errors()->first()
            ]);
        }else {

            $signup = new User;
            $signup->name = $request->name;
            $signup->email = $request->email;
            $signup->password = bcrypt($request->password);
            $signup->is_active = 1;

            $daftar = $signup->save();

            $signup->roles()->sync($request->role);

            if ($daftar) {
                return response()->json([
                    'message' => 'success',
                    'data' => 'Data berhasil disimpan'
                ]);
            }else {
                return response()->json([
                    'message' => 'error',
                    'data' => 'Proses gagal, harap coba lagi'
                ]);
            }

        }
    }

    public function edit($id)
    {
        $old =  User::findOrFail($id);
        $role = Role::all();
        return view('Super_Admin.User.edit', ['data'=>$old, 'role'=>$role]);
    }

    public function user_edit(Request $request)
    {
        $user_old = User::find($request->id);
        $role_old = array();
        foreach ($user_old->roles as $role) {
            array_push($role_old, $role);
        }
        return response()->json([
            'message' => 'success',
            'user' => $user_old,
            'role' => $role_old,
        ]);
    }

    public function update(Request $request)
    {        
        $data = User::find($request->id);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        if ($request->password !== null) {
            $data->password = bcrypt($request->password);
        }
        if (count($request->role) > 0) {
            $data->roles()->sync($request->role);
        }

        $daftar = $data->save();
        if ($daftar) {
            return response()->json([
                'message' => 'success',
                'data' => 'Data berhasil di ubah'
            ]);
        }else {
            return response()->json([
                'message' => 'error',
                'data' => 'Proses gagal'
            ]);
        }
    }

    public function delete(Request $request)
    {
        $data = User::find($request->id);
        $hapus = $data->delete();

        if ($hapus) {
            return response()->json([
                'message' => 'success',
                'data' => 'Data berhasil di hapus',
            ]);
        }else {
            return response()->json([
                'message' => 'error',
                'data' => 'Proses Gagal',
            ]);
        }
    }

    public function activation(Request $request)
    {
        $old = User::find($request->id);
        $old->is_active = $request->data;
        $active = $old->save();

        if ($active) {
            return response()->json([
                'message' => 'success',
                'data' => 'Data berhasil di ubah',
            ]);
        }else {
            return response()->json([
                'message' => 'error',
                'data' => 'Proses Gagal',
            ]);
        }

    }

    public function all_user()
    {
        $get_user = User::with('roles')->get();

        return response()->json([
            'message' => 'success',
            'data' => $get_user,
        ]);
    }

    // public function serverside()
    // {
    //     $data = User::query();
    //     return DataTables::eloquent($data)
        
    //     ->orderColumn('name', function ($query, $order) {
    //         $query->orderBy('name', 'asc');
    //     })
    //     ->addColumn('username', function ($data) {
    //         $username = '<td>'.$data->username.'</td>';
    //         return $username;
    //     })
    //     ->addColumn('email', function ($data) {
    //         $email = '<td>'.$data->email.'</td>';
    //         return $email;
    //     })
    //     ->addColumn('role', function ($data) {
    //         $role = '<td>'.$data->role->name.'</td>';
    //         return $role;
    //     })
    //     ->addColumn('active', function ($data) {
    //         if ($data->is_active == 0) {
    //             $active = '<td> <a class="btn btn-secondary btn-sm" style="margin-right: 10px;" href="'.route('user.activation', ['id'=>$data->id, 'data'=>'1']).'">OFF</a></td>';
    //         }else {
    //             $active = '<td> <a class="btn btn-success btn-sm" style="margin-right: 20px;" href="'.route('user.activation', ['id'=>$data->id, 'data'=>'0']).'">ON</a> </td>';
    //         }
    //         return $active;
    //     })
    //     ->addColumn('action', function ($data) {
    //         $action = '<td>
    //                         <a style="margin-right: 20px;" href="'.route('user.edit', ['id' => $data->id]).'"><i class="fa fa-edit text-warning" style="font-size: 21px;"></i></a>
                            
    //                         <a style="margin-right: 10px;" href="'.route('user.delete', ['id' => $data->id]).'"><i class="fa fa-trash text-danger" style="font-size: 21px;"></i></a>
    //                     </td>';
    //         return $action;
    //     })
    //     ->rawColumns(['name', 'username', 'email', 'role', 'active', 'action'])
    //     ->make(true);
    // }
}
