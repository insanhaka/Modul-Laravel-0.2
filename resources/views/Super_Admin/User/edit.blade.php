@extends('Super_Admin.Layout.app')

@section('css')
<style>
    .kv-file-zoom {
        visibility: hidden;
    }
    .close {
        visibility: hidden;
    }
    .btn-file {
        background-color: #0fbcf9;
    }
    .btn-file:hover {
        background-color: #0fbcf9;
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
                    <h4>Ubah Data User</h4>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('user.update', ['id'=>$data->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name"
                            name="name" placeholder="Nama Lengkap" value="{!! $data->name !!}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="{!! $data->email !!}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username"
                            name="username" placeholder="Username" value="{!! $data->username !!}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Password</label>
                            <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon" name="password" id="password-field">
                            <span toggle="#password-field" class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleForm21">Role</label>
                            <select class="form-select form-control" aria-label="Default select example" name="roles_id">
                                <option selected disabled>-- Pilih Role --</option>
                                @foreach ($role as $roles)
                                <option value="{{ $roles->id }}" {{ $roles->id == $data->role_id ? 'selected' : '' }}>{{ $roles->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        {{-- <div class="mb-3">
                            <label for="exampleForm21">Foto Profil</label>
                            <div class="file-loading">
                                <input id="input-b6" class="form-control" name="photo" type="file">
                            </div>
                        </div> --}}
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
        $("#user").addClass("active");
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
    $(".toggle-password").click(function() {
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });
</script>

@endsection

