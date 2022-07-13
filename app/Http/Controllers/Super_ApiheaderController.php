<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Api_header;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class Super_ApiheaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Super_Admin.Api_Header.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Super_Admin.Api_Header.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $get_key = Str::slug($request->key, '-');

        // dd($get_key);

        $simpan = Api_header::create([
            'key' => $get_key,
            'is_active' => 1
        ]);

        if ($simpan) {
            return redirect()->route('api-header.index')->with('success','Data Berhasil Dibuat');
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
        $old = Api_header::findOrFail($id);
        return view('Super_Admin.Api_Header.edit', ['data'=>$old]);
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
        $old = Api_header::find($id);
        $old->key = $request->key;
        $ubah = $old->save();

        if ($ubah) {
            return redirect()->route('api-header.index')->with('success','Data Berhasil Dibuat');
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
        $data = Api_header::find($id);
        $hapus = $data->delete();

        if ($hapus) {
            return redirect()->route('api-header.index')->with('success','Data Berhasil Dihapus');
        }else {
            return back()->with('error', 'Upps.. Error Nih');
        }
    }

    public function activation($id, $data)
    {
        $old = Api_header::find($id);
        $old->is_active = $data;
        $active = $old->save();

        if ($active) {
            return redirect()->route('api-header.index')->with('success','Data Berhasil Diubah');
        }else {
            return redirect()->route('api-header.index')->with('error', 'Upps, Error nih');
        }

    }

    public function serverside()
    {
        $data = Api_header::query();
        return DataTables::eloquent($data)

        ->orderColumn('key', function ($query, $order) {
            $query->orderBy('key', 'asc');
        })
        ->addColumn('activation', function ($data) {
            if ($data->is_active == 0) {
                $active = '<td> <a class="btn btn-secondary btn-sm" style="margin-right: 10px;" href="'.route('api-header.activation', ['id'=>$data->id, 'data'=>'1']).'">OFF</a></td>';
            }else {
                $active = '<td> <a class="btn btn-success btn-sm" style="margin-right: 20px;" href="'.route('api-header.activation', ['id'=>$data->id, 'data'=>'0']).'">ON</a> </td>';
            }
            return $active;
        })
        ->addColumn('action', function ($data) {
            $action = '<td>
                            <a style="margin-right: 20px;" href="'.route('api-header.edit', ['api_header' => $data->id]).'"><i class="fa fa-edit text-warning" style="font-size: 21px;"></i></a>

                            <a style="margin-right: 10px;" href="'.route('api-header.delete', ['id' => $data->id]).'"><i class="fa fa-trash text-danger" style="font-size: 21px;"></i></a>
                        </td>';
            return $action;
        })
        ->rawColumns(['key', 'activation', 'action'])
        ->make(true);
    }

}
