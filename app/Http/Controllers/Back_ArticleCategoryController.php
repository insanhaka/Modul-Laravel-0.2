<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article_Category;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class Back_ArticleCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Backend.Article_Category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.Article_Category.create');
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
            'name.required' => 'Nama kategori diisi ya..',
            // 'menu_type.required' => 'Pilih dulu tipe menunya ya..',
            // 'icon.required' => 'Icon ditambahkan biar keren..',
            // 'icon.mimes' => 'Format file harus JPEG/PNG/JPG..',
            'is_active.required' => 'Aktifasi dipilih ya..',
        ];

        $validator = Validator::make( $request->all(), [
            'name' => 'required',
            // 'menu_type' => 'required',
            // 'icon' => 'required|mimes:jpeg,png,jpg',
            'is_active' => 'required',
        ], $messages );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }else {
            
            $buat = new Article_Category;
            $buat->name = $request->name;
            $buat->uri = $request->uri;
            $buat->is_active = $request->is_active;
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('icon');
            if ($file) {
                $nama_file = time()."_".$file->getClientOriginalName();
                // Proses file diupload ke storage
                $path = Storage::putFileAs('public/icon', $file, $nama_file);
                $buat->icon = $nama_file;
            }else {
                $buat->icon = null;
            }
            
            $simpan = $buat->save();
            if ($simpan) {
                return redirect()->route('kategori-artikel.index')->with('success','Data Berhasil Dibuat');
            }else {
                return redirect()->route('kategori-artikel.create')->with('error', 'Upps, Error nih');
            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $old = Article_Category::findOrFail($id);
        return view('Backend.Article_Category.edit', ['data'=>$old]);
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
            'name.required' => 'Nama kategori diisi ya..',
            'is_active.required' => 'Aktifasi dipilih ya..',
        ];

        $validator = Validator::make( $request->all(), [
            'name' => 'required',
            'is_active' => 'required',
        ], $messages );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }else {
            
            $ubah = Article_Category::find($id);
            $ubah->name = $request->name;
            $ubah->uri = $request->uri;
            $ubah->is_active = $request->is_active;
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('icon');
            if ($file) {
                $nama_file = time()."_".$file->getClientOriginalName();
                // Proses file diupload ke storage
                $path = Storage::putFileAs('public/icon', $file, $nama_file);
                $ubah->icon = $nama_file;
            }
            
            $simpan = $ubah->save();
            if ($simpan) {
                return redirect()->route('kategori-artikel.index')->with('success','Data Berhasil Diubah');
            }else {
                return redirect()->back()->with('error', 'Upps, Error nih');
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
        $data = Article_Category::find($id);

        $hapus = $data->delete();

        if ($hapus) {
            return redirect()->route('kategori-artikel.index')->with('success','Data Berhasil Dihapus');
        }else {
            return back()->with('error', 'Upps.. Error Nih');
        }
    }

    public function activation($id, $data)
    {
        $old = Article_Category::find($id);
        $old->is_active = $data;
        $active = $old->save();

        if ($active) {
            return redirect()->route('kategori-artikel.index')->with('success','Data Berhasil Diubah');
        }else {
            return redirect()->route('kategori-artikel.index')->with('error', 'Upps, Error nih');
        }

    }

    public function serverside()
    {
        $data = Article_Category::all();
        return DataTables::of($data)
        
        ->addColumn('name', function ($data) {
            $name = '<td>'.$data->name.'</td>';
            return $name;
        })
        ->addColumn('url', function ($data) {
            $url = '<td>'.$data->uri.'</td>';
            return $url;
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
                $active = '<td> <a class="btn btn-secondary btn-sm" style="margin-right: 10px;" href="'.route('kategori-artikel.activation', ['id'=>$data->id, 'data'=>'1']).'">OFF</a></td>';
            }else {
                $active = '<td> <a class="btn btn-success btn-sm" style="margin-right: 20px;" href="'.route('kategori-artikel.activation', ['id'=>$data->id, 'data'=>'0']).'">ON</a> </td>';
            }
            return $active;
        })
        ->addColumn('action', function ($data) {
            $action = '<td>
                            <a style="margin-right: 20px;" href="'.route('kategori-artikel.edit', ['kategori_artikel' => $data->id]).'"><i class="fa fa-edit text-warning" style="font-size: 21px;"></i></a>
                            
                            <a style="margin-right: 10px;" href="'.route('kategori-artikel.delete', ['id' => $data->id]).'"><i class="fa fa-trash text-danger" style="font-size: 21px;"></i></a>
                        </td>';
            return $action;
        })
        ->rawColumns(['name', 'url', 'icon', 'activation', 'action'])
        ->make(true);
    }
}
