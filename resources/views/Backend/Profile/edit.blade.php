<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <title>
    Profile - Kitasiapin
    </title>
    
    <meta name="description" content="" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
    
    <style>
        table td {
          font-size: 14px;
        }
        .table {
            font-size: 14px;
            width: 100% !important;
        }
        .table thead th {
            padding: 0;
            padding-bottom: 1%;
            padding-left: 1%;
        }
        .dataTables_scrollBody::-webkit-scrollbar {
            height: 10px !important;
            background-color: #ccc;
        }
        .dataTables_scrollBody::-webkit-scrollbar-track
        {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            border-radius: 10px;
            background-color: #F5F5F5;
        }
        .dataTables_scrollBody::-webkit-scrollbar
        {
            width: 12px;
            background-color: #F5F5F5;
        }
        .dataTables_scrollBody::-webkit-scrollbar-thumb
        {
            border-radius: 10px;
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
            background-color: #d2dae2;
        }
    </style>
    <style>
        .kv-file-zoom {
            visibility: hidden;
        }
        .kv-file-remove {
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
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css')}}">
    <link href="{{ asset('assets/vendor/Krajee-file-input/css/fileinput.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendor/Krajee-file-input/themes/explorer-fa/theme.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.css') }}">
</head>

<body class="g-sidenav-show  bg-gray-100">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <img src="{{asset('assets/img/profile-edit-top.png')}}" class="img-fluid" alt="Responsive image">
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 offset-md-3" style="padding-top: 2%;">
            <div class="row">
                <div class="col-md-6">
                    <h2>Edit Profile</h2>
                </div>
                <div class="col-md-6">

                </div>
            </div>

            <br>

            <form method="POST" action="/profile/admin/{!!$data->id!!}/update" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap" value="{!! $data->name !!}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{!! $data->username !!}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="email">Alamat Email Aktif</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="{!! $data->email !!}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" value="{{ old('password') }}" name="password">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="exampleInput">Upload Photo profile</label>
                            <div class="file-loading">
                                <input id="input-b6" class="form-control" name="photo" type="file">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="float: right">
                    <div class="col-md-5">
                        <input class="btn btn-primary" type="submit" value="Save">
                    </div>
                    <div class="col-md-5">
                        <a class="btn btn-secondary" href="/profile/admin/{{ $data->id }}" role="button">Back</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-3">
            <img src="{{asset('assets/img/profile-edit-side.png')}}" height="300" alt="Responsive image">
        </div>
    </div>
</div>

<!--   Core JS Files   -->

<!-- build:js assets/vendor/js/core.js -->
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/js/extended-ui-perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
<!-- endbuild -->

<!-- Main JS -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<!-- Page JS -->
<script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<script type="text/javascript" src="{{asset('assets/vendor/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="{{asset('assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendor/datatables.net-select-bs4/js/select.bootstrap4.min.js')}}"></script>

<script src="{{ asset('assets/vendor/Krajee-file-input/js/fileinput.min.js') }}"></script>
<script src="{{ asset('assets/vendor/Krajee-file-input/themes/explorer-fa/theme.js') }}"></script>
<script src="{{ asset('assets/vendor/Krajee-file-input/themes/gly/theme.js') }}"></script>

<script src="{{ asset('assets/js/sweetalert2.js') }}"></script>

<script>
    $(document).ready(function() {
        $("#input-b6").fileinput({
            showUpload: false,
            dropZoneEnabled: false,
            maxFileCount: 10,
            initialPreview: [
                "{{Storage::url('profile-picture/'.$data->photo)}}"
            ],
            initialPreviewAsData: true,
            initialPreviewFileType: 'image',
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

    @if ($message = Session::get('success'))
        Toast.fire({
            icon: 'success',
            title: '{{$message}}'
        })
    @endif
    @if ($message = Session::get('error'))
        Toast.fire({
            icon: 'error',
            title: '{{$message}}'
        })
    @endif
</script>

</body>

</html>

