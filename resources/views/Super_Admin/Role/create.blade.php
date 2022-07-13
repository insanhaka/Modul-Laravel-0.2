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
                    <h4>Tambah Data Role & Permission</h4>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('role.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <p>Role Name</p>
                            <input type="text" class="form-control" id="name"
                            name="name" placeholder="Nama Role" value="{{old('name')}}">
                        </div>
                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Menu</th>
                                    <th scope="col">Permission</th>
                                    <th scope="col">Access</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($menus as $item )
                                    @if ($item->is_active == 1)
                                    <tr>
                                        <td>{!! $item->name !!}</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="view" name="permission[]" value="{{ $item->id.':/'.$item->uri }}">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="all-{!! $item->uri !!}">
                                                <label>all</label>
                                            </div>
                                        </td>
                                        @foreach ($access as $akses)
                                        <td id="td-{!! $item->uri !!}">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="create" name="access[]" value="{!! "/".Str::lower($item->uri).'/:'.$akses->id !!}">
                                                <label>{!! $akses->name !!}</label>
                                            </div>
                                        </td>
                                        @endforeach
                                    </tr>
                                    @endif
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

                <hr>

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
        $("#role").addClass("active");
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

@foreach ($menus as $cek)
<script>
    $( '#all-{!! $cek->uri !!}' ).click( function () {
        $( '#td-{!! $cek->uri !!} input[type="checkbox"]' ).prop('checked', this.checked)
    });
</script>
@endforeach

@endsection

