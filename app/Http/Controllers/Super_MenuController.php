<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class Super_MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $get_parent = Menu::where('type', 'parent')->get();
        $get_child = Menu::where('type', 'child')->get();
        return view('Super_Admin.Menu.index', ['parent'=> $get_parent, 'child'=> $get_child]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $get_parent = Menu::where('type', 'parent')->get();
        return view('Super_Admin.Menu.create', ['parent'=> $get_parent]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Nama menu diisi ya..',
            // 'menu_type.required' => 'Pilih dulu tipe menunya ya..',
            'icon.required' => 'Icon ditambahkan biar keren..',
            'icon.mimes' => 'Format file harus JPEG/PNG/JPG..',
            'is_active.required' => 'Aktifasi dipilih ya..',
        ];

        $validator = Validator::make( $request->all(), [
            'name' => 'required',
            // 'menu_type' => 'required',
            'icon' => 'required|mimes:jpeg,png,jpg',
            'is_active' => 'required',
        ], $messages );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }else {
            
            $buat = new Menu;
            $buat->name = $request->name;
            $buat->uri = $request->uri;
            $buat->type = $request->menu_type;
            $buat->parent_id = $request->parent_id;
            $buat->is_active = $request->is_active;
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('icon');
            $nama_file = time()."_".$file->getClientOriginalName();
            // Proses file diupload ke storage
            $path = Storage::putFileAs('public/icon', $file, $nama_file);
            $buat->icon = $nama_file;
            
            $simpan = $buat->save();
            if ($simpan) {
                return redirect()->route('menu.index')->with('success','Data Berhasil Dibuat');
            }else {
                return redirect()->route('menu.create')->with('error', 'Upps, Error nih');
            }

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
        $data = Menu::where('type', 'parent')->get();
        return DataTables::of($data)
        
        ->addColumn('name', function ($data) {
            $name = '<td>'.$data->name.'</td>';
            return $name;
        })
        ->addColumn('url', function ($data) {
            $url = '<td>'.$data->uri.'</td>';
            return $url;
        })
        ->addColumn('type', function ($data) {
            $type = '<td>'.$data->type.'</td>';
            return $type;
        })
        ->addColumn('child', function ($data) {
            $get_child = Menu::where('parent_id', $data->id)->count();
            if ($get_child == 0) {
                $parent = '<td>
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#parentID-'.$data->id.'" disabled>
                            No Child
                        </button>
                    </td>';
            }else {
            $parent = '<td>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#parentID-'.$data->id.'">
                            View Child
                        </button>
                    </td>';
            }
            return $parent;
        })
        ->addColumn('icon', function ($data) {
            if ($data->icon == null) {
                $icon = '<td> <img src="'.asset('assets/img/icon/no-image.png').'" class="img-fluid" alt="Responsive image" width="30"> </td>';
            }else {
                $path = Storage::url('icon/'.$data->icon);
                $icon = '<td> <img src="'.$path.'" class="img-fluid" alt="Responsive image" width="30"> </td>';
            }
            return $icon;
        })
        ->addColumn('activation', function ($data) {
            if ($data->is_active == 0) {
                $active = '<td> <a class="btn btn-secondary btn-sm" style="margin-right: 10px;" href="'.route('menu.activation', ['id'=>$data->id, 'data'=>'1']).'">OFF</a></td>';
            }else {
                $active = '<td> <a class="btn btn-success btn-sm" style="margin-right: 20px;" href="'.route('menu.activation', ['id'=>$data->id, 'data'=>'0']).'">ON</a> </td>';
            }
            return $active;
        })
        ->addColumn('action', function ($data) {
            $action = '<td>
                            <a style="margin-right: 20px;" href="'.route('menu.edit', ['menu' => $data->id]).'"><i class="fa fa-edit text-warning" style="font-size: 21px;"></i></a>
                            
                            <a style="margin-right: 10px;" href="'.route('menu.delete', ['id' => $data->id]).'"><i class="fa fa-trash text-danger" style="font-size: 21px;"></i></a>
                        </td>';
            return $action;
        })
        ->rawColumns(['name', 'url', 'type', 'child', 'icon', 'activation', 'action'])
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
        $old = Menu::findOrFail($id);
        return view('Super_Admin.Menu.edit', ['data'=>$old]);
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
        $messages = [
            'name.required' => 'Nama menu diisi ya..',
            'is_active.required' => 'Aktifasi dipilih ya..',
        ];

        $validator = Validator::make( $request->all(), [
            'name' => 'required',
            'is_active' => 'required',
        ], $messages );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }else {
            
            $ubah = Menu::find($id);
            $ubah->name = $request->name;
            $ubah->uri = $request->uri;
            $ubah->is_active = $request->is_active;
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('icon');

            if($file == null){
                $simpan = $ubah->save();
                if ($simpan) {
                    return redirect()->route('menu.index')->with('success','Data Berhasil Dibuat');
                }else {
                    return redirect()->back()->with('error', 'Upps, Error nih');
                }
            }else{
                $nama_file = time()."_".$file->getClientOriginalName();
                // Proses file diupload ke storage
                $path = Storage::putFileAs('public/icon', $file, $nama_file);
                $ubah->icon = $nama_file;
                
                $simpan = $ubah->save();
                if ($simpan) {
                    return redirect()->route('menu.index')->with('success','Data Berhasil Dibuat');
                }else {
                    return redirect()->back()->with('error', 'Upps, Error nih');
                }
            }

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
        $data = Menu::find($id);

        $hapus1 = $data->delete();
        $hapus2 = Menu::where('parent_id', $id)->delete();

        if ($hapus1 && $hapus2) {
            return redirect()->route('menu.index')->with('success','Data Berhasil Dihapus');
        }else {
            return back()->with('error', 'Upps.. Error Nih');
        }
    }

    public function activation($id, $data)
    {
        $old = Menu::find($id);
        $old->is_active = $data;
        $active = $old->save();

        if ($active) {
            return redirect()->route('menu.index')->with('success','Data Berhasil Diubah');
        }else {
            return redirect()->route('menu.index')->with('error', 'Upps, Error nih');
        }

    }
}
