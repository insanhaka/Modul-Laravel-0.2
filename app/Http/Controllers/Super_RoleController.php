<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Role_has_menu;
use App\Models\Role_has_permission;
use Yajra\DataTables\DataTables;
use App\Models\Menu;
use Illuminate\Support\Str;

class Super_RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Super_Admin.Role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = Menu::all();
        $permission = Permission::all();
        return view('Super_Admin.Role.create', ['menus'=>$menu, 'access'=>$permission]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());

        $role = Role::create([
            'name' => $request->name
        ]);

        $permission_check = $request->permission;
        if ($role && $permission_check == null) {
            return redirect()->route('role.index')->with('success','Data Berhasil Dibuat');
        }

        foreach($request->permission as $data)
        {
            $menu_id = Str::before($data, ':');

            $pivot1 = Role_has_menu::create([
                'role_id' => $role->id,
                'menu_id' => $menu_id,
            ]);
        }

        $access_check = $request->access;
        if ($role && $access_check == null) {
            return redirect()->route('role.index')->with('success','Data Berhasil Dibuat');
        }

        foreach($request->access as $akses)
        {
            $get_menu = Str::between($akses, '/', '/');
            $menu = Menu::where('uri', $get_menu)->first();

            $permission_id = Str::after($akses, ':');

            $pivot2 = Role_has_permission::create([
                'menu_id' => $menu->id,
                'permission_id' => $permission_id,
                'role_id' => $role->id,
            ]);
        }

        if ($role) {
            return redirect()->route('role.index')->with('success','Data Berhasil Dibuat');
        }else {
            return back()->with('error', 'Upps.. Error Nih')->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function serverside()
    {
        $data = Role::query();
        return DataTables::eloquent($data)
        
        ->orderColumn('name', function ($query, $order) {
            $query->orderBy('name', 'asc');
        })

        ->addColumn('permission', function ($data) {
            $permission = '<td>
                            <a style="margin-right: 20px;" href="'.route('role.edit', ['role' => $data->id]).'"><i class="fa fa-list-ul text-info" style="font-size: 21px;"></i></a>
                        </td>';
            return $permission;
        })

        ->addColumn('action', function ($data) {
            $action = '<td>                           
                            <a style="margin-right: 10px;" href="'.route('role.delete', ['id' => $data->id]).'"><i class="fa fa-trash text-danger" style="font-size: 21px;"></i></a>
                        </td>';
            return $action;
        })
        ->rawColumns(['name', 'permission', 'action'])
        ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $old = Role::findOrFail($id);
        $menu = Menu::all();
        $permission = Permission::all();
        
        return view('Super_Admin.Role.edit', ['data'=>$old, 'menus'=>$menu, 'access'=>$permission]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // dd($request->all());

        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $ubah_role = $role->save();

        $role_menu_delete = Role_has_menu::where('role_id', $id)->delete();
        // membuat baru data role menu
        foreach($request->permission as $data)
        {
            $menu_id = Str::before($data, ':');

            $pivot1 = Role_has_menu::create([
                'role_id' => $id,
                'menu_id' => $menu_id,
            ]);
        }

        $menu_access_delete = Role_has_permission::where('role_id', $id)->delete();
        // membuat baru data role menu akses
        foreach($request->access as $akses)
        {
            $get_menu = Str::between($akses, '/', '/');
            $menu = Menu::where('uri', $get_menu)->first();

            $permission_id = Str::after($akses, ':');

            $pivot2 = Role_has_permission::create([
                'menu_id' => $menu->id,
                'permission_id' => $permission_id,
                'role_id' => $id,
            ]);
        }

        if ($role) {
            return redirect()->route('role.index')->with('success','Data Berhasil Diubah');
        }else {
            return back()->with('error', 'Upps.. Error Nih')->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {

        $role_menu_delete = Role_has_menu::where('role_id', $id)->delete();

        $menu_access_delete = Role_has_permission::where('role_id', $id)->delete();

        $get_role = Role::find($id);
        $role_del = $get_role->delete();
        

        if ($role_menu_delete && $menu_access_delete && $role_del) {
            return redirect()->route('role.index')->with('success','Data Berhasil Dihapus');
        }else {
            return back()->with('error', 'Upps.. Error Nih');
        }
    }
}
