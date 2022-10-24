<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Article_Category;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use stdClass;

class Back_ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $get_article = Article::all();
        return view('Backend.Article.index', ['content'=>$get_article]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $get_category = Article_Category::where('is_active', 1)->get();
        return view('Backend.Article.create', ['categories'=> $get_category]);
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
            'article_category_id.required' => 'Pilih dulu kategorinya ya..',
            'thumbnail.required' => 'Icon ditambahkan biar keren..',
            'thumbnail.mimes' => 'Format file harus JPEG/PNG/JPG..',
            'is_active.required' => 'Aktifasi dipilih ya..',
        ];

        $validator = Validator::make( $request->all(), [
            'title' => 'required',
            'article_category_id' => 'required',
            'thumbnail' => 'required|mimes:jpeg,png,jpg',
            'is_active' => 'required',
        ], $messages );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }else {
            
            $buat = new Article;
            $buat->title = $request->title;
            $buat->article_category_id = $request->article_category_id;
            $buat->content = $request->content;
            $buat->is_active = $request->is_active;
            // menyimpan data file yang diupload ke variabel $file
            $file = $request->file('thumbnail');
            if ($file) {
                $nama_file = time()."_".$file->getClientOriginalName();
                // Proses file diupload ke storage
                $path = Storage::putFileAs('public/content-thumbnail', $file, $nama_file);
                $buat->thumbnail = $nama_file;
            }else {
                $buat->thumbnail = null;
            }
            
            $simpan = $buat->save();
            if ($simpan) {
                return redirect()->route('konten-artikel.index')->with('success','Data Berhasil Dibuat');
            }else {
                return redirect()->route('konten-artikel.create')->with('error', 'Upps, Error nih');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data = Article::find($id);

        $hapus = $data->delete();

        if ($hapus) {
            return redirect()->route('konten-artikel.index')->with('success','Data Berhasil Dihapus');
        }else {
            return back()->with('error', 'Upps.. Error Nih');
        }
    }

    public function activation($id, $data)
    {
        $old = Article::find($id);
        $old->is_active = $data;
        $active = $old->save();

        if ($active) {
            return redirect()->route('konten-artikel.index')->with('success','Data Berhasil Diubah');
        }else {
            return redirect()->route('konten-artikel.index')->with('error', 'Upps, Error nih');
        }

    }

    public function serverside()
    {
        $data = Article::all();
        return DataTables::of($data)
        
        ->addColumn('title', function ($data) {
            $title = $data->title;
            return $title;
        })
        ->addColumn('thumbnail', function ($data) {
            if ($data->thumbnail == null) {
                $thumbnail = '<td> <img src="'.asset('assets/img/icon/no-image.png').'" class="img-fluid" alt="Responsive image" width="100"> </td>';
            }else {
                $path = Storage::url('content-thumbnail/'.$data->thumbnail);
                $thumbnail = '<td> <img src="'.$path.'" class="img-fluid" alt="Responsive image" width="100"> </td>';
            }
            return $thumbnail;
        })
        ->addColumn('view', function ($data) {
            $view = '<td>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#parentID-'.$data->id.'">
                            Lihat
                        </button>
                    </td>';
            return $view;
        })
        ->addColumn('activation', function ($data) {
            if ($data->is_active == 0) {
                $active = '<td> <a class="btn btn-secondary btn-sm" style="margin-right: 10px;" href="'.route('konten-artikel.activation', ['id'=>$data->id, 'data'=>'1']).'">OFF</a></td>';
            }else {
                $active = '<td> <a class="btn btn-success btn-sm" style="margin-right: 20px;" href="'.route('konten-artikel.activation', ['id'=>$data->id, 'data'=>'0']).'">ON</a> </td>';
            }
            return $active;
        })
        ->addColumn('action', function ($data) {
            $action = '<td>
                            <a style="margin-right: 20px;" href="'.route('konten-artikel.edit', ['konten_artikel' => $data->id]).'"><i class="fa fa-edit text-warning" style="font-size: 21px;"></i></a>
                            
                            <a style="margin-right: 10px;" href="'.route('konten-artikel.delete', ['id' => $data->id]).'"><i class="fa fa-trash text-danger" style="font-size: 21px;"></i></a>
                        </td>';
            return $action;
        })
        ->rawColumns(['name', 'thumbnail', 'view', 'activation', 'action'])
        ->make(true);
    }

    public function upload_img(Request $request)
    {
        // Allowed extentions.
        $allowedExts = array("gif", "jpeg", "jpg", "png");
        // Get filename.
        $temp = explode(".", $_FILES["content_img"]["name"]);
        // Get extension.
        $extension = end($temp);
        // An image check is being done in the editor but it is best to
        // check that again on the server side.
        // Do not use $_FILES["file"]["type"] as it can be easily forged.
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $_FILES["content_img"]["tmp_name"]);

        if ((($mime == "image/gif")
        || ($mime == "image/jpeg")
        || ($mime == "image/pjpeg")
        || ($mime == "image/x-png")
        || ($mime == "image/png"))
        && in_array($extension, $allowedExts)) {
            // Generate new random name.
            $name = sha1(microtime()) . "." . $extension;

            // Save file in the uploads folder.
            // move_uploaded_file($_FILES["content_img"]["tmp_name"], getcwd() . "public/content-image" . $name);
            Storage::putFileAs('public/content-image', $_FILES["content_img"]["tmp_name"], $name);
            // Generate response.
            $response = new StdClass;
            // $response->link = "public/content-image" . $name;
            $response->link = Storage::url('content-image/'.$name);
            echo stripslashes(json_encode($response));
        }
    }

    public function upload_file(Request $request)
    {
        // Allowed extentions.
        $allowedExts = array("txt", "pdf", "doc");
        // Get filename.
        $temp = explode(".", $_FILES["content_file"]["name"]);
        // Get extension.
        $extension = end($temp);
        // Validate uploaded files.
        // Do not use $_FILES["file"]["type"] as it can be easily forged.
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $_FILES["content_file"]["tmp_name"]);

        if ((($mime == "text/plain")
        || ($mime == "application/msword")
        || ($mime == "application/x-pdf")
        || ($mime == "application/pdf"))
        && in_array($extension, $allowedExts)) {
            // Generate new random name.
            $name = sha1(microtime()) . "." . $extension;

            // Save file in the uploads folder.
            Storage::putFileAs('public/content-file', $_FILES["content_file"]["tmp_name"], $name);

            // Generate response.
            $response = new StdClass;
            $response->link = Storage::url('content-file/'.$name);
            echo stripslashes(json_encode($response));
        }
    }

    public function upload_video(Request $request)
    {
        // Allowed extentions.
        $allowedExts = array("mp4", "webm", "avi", "ogg");
        // Get filename.
        $temp = explode(".", $_FILES["content_video"]["name"]);
        // Get extension.
        $extension = end($temp);
        // Validate uploaded files.
        // Do not use $_FILES["file"]["type"] as it can be easily forged.
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $_FILES["content_video"]["tmp_name"]);

        if ((($mime == "video/mp4")
        || ($mime == "video/webm")
        || ($mime == "video/avi")
        || ($mime == "video/ogg"))
        && in_array($extension, $allowedExts)) {
            // Generate new random name.
            $name = sha1(microtime()) . "." . $extension;

            // Save file in the uploads folder.
            Storage::putFileAs('public/content-video', $_FILES["content_video"]["tmp_name"], $name);

            // Generate response.
            $response = new StdClass;
            $response->link = Storage::url('content-video/'.$name);
            echo stripslashes(json_encode($response));
        }
    }
}
