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
        return view('Backend.Article.index');
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
        //
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
    public function destroy($id)
    {
        //
    }

    public function serverside()
    {
        // 
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
