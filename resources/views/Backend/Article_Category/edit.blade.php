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
                    <h4>Ubah Kategori Artikel</h4>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('kategori-artikel.update', ['kategori_artikel'=>$data->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name"
                            name="name" placeholder="Nama Kategori" value="{!! $data->name !!}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Url</label>
                            <input type="text" class="form-control" id="uri" name="uri" placeholder="uri" value="{!! $data->uri !!}" readonly>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleForm21">Icon</label>
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
                                <option value="1" {{ $data->is_active == 1 ? 'selected' : '' }}>Aktiv</option>
                                <option value="0" {{ $data->is_active == 0 ? 'selected' : '' }}>Non Aktiv</option>
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
            initialPreview: [
                "{{Storage::url('icon/'.$data->icon)}}"
            ],
            initialPreviewAsData: true,
            initialPreviewFileType: 'image',
        });
    });
</script>

{{-- <script>
    $(document).ready(function(){
      $("#name").change(function(){
        var name = document.getElementById('name').value;
        var uri = name.replace(/\s+/g, '-').toLowerCase();
        document.getElementById('uri').value = uri;
      });
    });
</script> --}}
@endsection
      
  