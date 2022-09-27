@extends('Back_Auth.Layout.app')

@section('css')
    <style>
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
    <div class="page-header min-vh-75">
        <div class="container pt-5">
            <div class="row">

                <div class="col-md-6">
                    <center>
                    <img src="{{ asset('assets/img/image-header-new-back.png') }}" class="img-fluid" alt="Image">
                    </center>
                </div>
                <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto pt-4">
                    <div class="card card-plain mt-5">
                        <div class="card-header pb-3 text-center bg-transparent">
                            <h3 class="font-weight-bolder">Welcome Admin</h3>
                        </div>
                        <div class="card-body">
                            <form role="form" method="POST" action="/post-dapur" >
                            @csrf
                            <label class="form-label">Email / Username</label>
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Email / Username" aria-label="Email" aria-describedby="email-addon" name="username" value="{{ old('username') }}">
                            </div>
                            <label class="form-label">Password</label>
                            <div class="mb-3">
                                <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon" name="password" id="password-field" value="{{ old('password') }}">
                                <span toggle="#password-field" class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-100 mt-4 mb-0">Sign in</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')

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

<script type="text/javascript">
  @if ($message = Session::get('error'))
      Swal.fire({
        position: 'center',
        icon: 'error',
        text: '{{$message}}',
        showConfirmButton: false,
        timer: 3000
      })
  @endif
</script>

@endsection
