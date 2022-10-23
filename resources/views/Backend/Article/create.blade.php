@extends('Backend.Layout.app')

@section('css')
<style>
    .kv-file-zoom {
        visibility: hidden;
    }
    .close {
        visibility: hidden;
    }
    .field-icon {
        float: right;
        margin-right: 10px;
        margin-top: -28px;
        position: relative;
        z-index: 2;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4>Tambah Artikel</h4>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('konten-artikel.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="title"
                            name="title" placeholder="Judul Artikel" value="{{old('title')}}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Kategori Artikel</label>
                            <select
                                class="form-control"
                                data-trigger
                                id="article-category" 
                                name="article_category_id"
                                placeholder="Kategori Artikel"
                            >
                                <option selected disabled> Pilih Kategori Artikel </option>
                                @foreach($categories as $cat)
                                <option value="{!! $cat->id !!}">{!! $cat->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Artikel</label>
                            <textarea id="content" class="form-control" name="content"></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Thumbnail</label>
                            <div class="file-loading">
                                <input id="input-b6" class="form-control" name="thumbnail" type="file">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Aktivasi</label>
                            <select
                                class="form-control"
                                data-trigger
                                id="active" 
                                name="is_active"
                                placeholder="Aktivasi"
                            >
                                <option selected disabled> Pilih Aktivasi Kategori </option>
                                <option value="1">Aktiv</option>
                                <option value="0">Non Aktiv</option>
                            </select>
                        </div>
                    </div>
                </div>

                <br>
                <br>

                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary" style="float: right"> Simpan </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        var category = new Choices('#article-category', {
            allowHTML: true,
        });
        var active = new Choices('#active', {
            allowHTML: true,
        });
    });
</script>

<script type="text/javascript">
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    @if ($message = Session::get('error'))
        Toast.fire({
            icon: 'error',
            title: '{{$message}}'
        })
    @endif
</script>

<script>
    $(document).ready(function() {
        $("#input-b6").fileinput({
            showUpload: false,
            dropZoneEnabled: false,
            maxFileCount: 10,
            // mainClass: "input-group-lg"
        });
    });
</script>

<script> 
    var editor = new FroalaEditor('#content', {

        heightMin: 300,
        imageMove: true,
        imageUploadParam: 'content_img',
        imageUploadMethod: 'post',
        imageUploadURL: "{{ route('img-artikel.upload') }}",
        imageUploadParams: {
                            // id: 'content_file',
                            froala: 'true', // This allows us to distinguish between Froala or a regular file upload.
	                        _token: "{{ csrf_token() }}" // This passes the laravel token with the ajax request.
                          },
        
        fileUploadParam: 'content_file',
        // Set request type.
        fileUploadMethod: 'post',
        // Set the file upload URL.
        fileUploadURL: "{{ route('file-artikel.upload') }}",
        // Allow to upload any file.
        fileAllowedTypes: ['*'],
        fileUploadParams: {
                            // id: 'content_file',
                            froala: 'true', // This allows us to distinguish between Froala or a regular file upload.
	                        _token: "{{ csrf_token() }}" // This passes the laravel token with the ajax request.
                          },

        videoUploadParam: 'content_video',
        videoUploadMethod: 'post',
        videoUploadURL: "{{ route('video-artikel.upload') }}",
        videoAllowedTypes: ['webm', 'mp4', 'ogg', 'avi'],
        videoMaxSize: 100 * 1024 * 1024,
        videoUploadParams: {
                            froala: 'true', // This allows us to distinguish between Froala or a regular file upload.
	                        _token: "{{ csrf_token() }}" // This passes the laravel token with the ajax request.
                          },


        // events: {
        //     'video.uploaded': function (response) {
        //        console.log(response);
        //     },
        //     'video.error': function (error, response) {
        //         console.log(error);
        //     }
        // }
    });
</script>
@endsection
      
  