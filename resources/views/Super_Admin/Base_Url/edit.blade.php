@extends('Super_Admin.Layout.app')

@section('css')
<style>
    .table {
        font-size: 14px;
        /* width: 100% !important; */
    }
    .table thead th {
        padding: 0;
        padding-bottom: 5px;
    } 
</style>
@endsection

@section('content')

<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4>Ubah Data Base URL</h4>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('base-url.update', ['base_url'=> $data->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <p>Name</p>
                            <input type="text" class="form-control" id="name"
                            name="name" placeholder="Name" value="{!! $data->name !!}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <p>Url</p>
                            <input type="text" class="form-control" id="url"
                            name="url" placeholder="Url" value="{!! $data->url !!}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-info" style="float: right"> Simpan </button>
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
        $("#base-url").addClass("active");
    });
</script>

<script type="text/javascript">
    @if ($message = Session::get('error'))
        Swal.fire({
          position: 'center',
          icon: 'error',
          text: '{{$message}}',
          showConfirmButton: false,
          timer: 2000
        })
    @endif
</script>

@endsection

