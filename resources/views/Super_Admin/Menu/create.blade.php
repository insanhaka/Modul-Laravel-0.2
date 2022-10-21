@extends('Super_Admin.Layout.app')

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

    .hide {
        display: none;
    }
    .show {
        display: block;
    }
</style>
@endsection

@section('content')

<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4>Tambah Data Menu</h4>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name"
                            name="name" placeholder="Nama Menu" value="{{old('name')}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Url</label>
                            <input type="text" class="form-control" id="uri" name="uri" placeholder="uri" readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Tipe Menu</label>
                            <select
                                class="form-control"
                                data-trigger
                                id="tipe" 
                                onchange="getType()" 
                                name="menu_type"
                                placeholder="Tipe Menu"
                            >
                                <option value="" selected disabled> Pilih Tipe Menu </option>
                                <option value="parent">Parent Menu</option>
                                <option value="child">Child Menu</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row hide" id="child-menu">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Pilih Parent Menu</label>
                            <select
                                class="form-control"
                                data-trigger
                                id="parent-id" 
                                name="parent_id"
                                placeholder="Parent Menu"
                            >
                                <option value="" selected disabled> Pilih Parent Menu </option>
                                @foreach ($parent as $item)
                                <option value="{!!$item->id!!}">{!!$item->name!!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Icon</label>
                            <div class="file-loading">
                                <input id="input-b6" class="form-control" name="icon" type="file">
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
                                <option selected disabled> Pilih Aktivasi Menu </option>
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
        $("#menu").addClass("active");
    });
</script>

<script>
    $(document).ready(function() {
        var type = new Choices('#tipe', {
            allowHTML: true,
        });
        var parent = new Choices('#parent-id', {
            allowHTML: true,
        });
        var active = new Choices('#active', {
            allowHTML: true,
        });
    });
</script>

<script>
    function getType() {
        var val = document.getElementById("tipe").value;
        if (val === "child") {
            $("#child-menu").removeClass("hide");
            $("#child-menu").addClass("show");    
        }else {
            $("#child-menu").removeClass("show");
            $("#child-menu").addClass("hide");   
        }
    }
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
    $(document).ready(function(){
      $("#name").change(function(){
        var name = document.getElementById('name').value;
        var uri = name.replace(/\s+/g, '-').toLowerCase();
        document.getElementById('uri').value = uri;
      });
    });
</script>

@endsection

