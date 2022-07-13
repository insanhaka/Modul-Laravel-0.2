@extends('Super_Admin.Layout.app')

@section('css')
<style>
    .table {
        font-size: 14px;
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
                    <h4>Tambah Data Api Header</h4>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('api-header.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <div class="alert alert-danger" style="color: #fff" role="alert">
                                Tulisan Key tidak boleh berisi spasi
                            </div>
                            <p>Key</p>
                            <input type="text" class="form-control" id="key"
                            name="key" placeholder="Tulis kode kunci disini" value="{{old('key')}}">
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
        $("#api-header").addClass("active");
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

