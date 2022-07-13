<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Base_url;
use Yajra\DataTables\DataTables;

class Super_BaseurlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Super_Admin.Base_Url.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Super_Admin.Base_Url.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $simpan = Base_url::create($request->all());

        if ($simpan) {
            return redirect()->route('base-url.index')->with('success','Data Berhasil Dibuat');
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
        $old = Base_url::findOrFail($id);
        return view('Super_Admin.Base_Url.edit', ['data'=>$old]);
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
        $old = Base_url::find($id);
        $old->name = $request->name;
        $old->url = $request->url;
        $ubah = $old->save();

        if ($ubah) {
            return redirect()->route('base-url.index')->with('success','Data Berhasil Dibuat');
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
        $data = Base_url::find($id);
        $hapus = $data->delete();

        if ($hapus) {
            return redirect()->route('base-url.index')->with('success','Data Berhasil Dihapus');
        }else {
            return back()->with('error', 'Upps.. Error Nih');
        }
    }

    public function serverside()
    {
        $data = Base_url::query();
        return DataTables::eloquent($data)

        ->orderColumn('name', function ($query, $order) {
            $query->orderBy('name', 'asc');
        })
        ->addColumn('url', function ($data) {
            $url = '<td>'.$data->url.'</td>';
            return $url;
        })
        ->addColumn('action', function ($data) {
            $action = '<td>
                            <a style="margin-right: 20px;" href="'.route('base-url.edit', ['base_url' => $data->id]).'"><i class="fa fa-edit text-warning" style="font-size: 21px;"></i></a>

                            <a style="margin-right: 10px;" href="'.route('base-url.delete', ['id' => $data->id]).'"><i class="fa fa-trash text-danger" style="font-size: 21px;"></i></a>
                        </td>';
            return $action;
        })
        ->rawColumns(['name', 'url', 'action'])
        ->make(true);
    }
}
