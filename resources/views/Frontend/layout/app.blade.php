<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/logos/Logo1.png') }}">
  <title>
    Home - Autolife
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assets/css/soft-ui-dashboard.css?v=1.0.5') }}" rel="stylesheet" />

    <style type="text/css">
      body.offcanvas-active{
        overflow:hidden;
      }

      .offcanvas-header{ display:none; }

      #nav-besar {
        display: none;
      }

      #navbar_main {
        display: none;
      }

      .screen-overlay {
        width:0%;
        height: 100%;
        z-index: 30;
        position: fixed;
        top: 0;
        left: 0;
        opacity:0;
        visibility:hidden;
        background-color: rgba(34, 34, 34, 0.6);
        transition:opacity .2s linear, visibility .1s, width 1s ease-in;
        }
      .screen-overlay.show {
          transition:opacity .5s ease, width 0s;
          opacity:1;
          width:100%;
          visibility:visible;
      }

      @media all and (max-width:992px) {

        .offcanvas-header{ display:block; }

        #nav-besar {
          display: flex;
        }

        #navbarBlur {
          display: none;
        }

        #navbar_main {
          display: block;
        }

        .mobile-offcanvas{
          visibility: hidden;
          transform:translateX(-100%);
            border-radius:0;
          display:block;
            position: fixed;
            top: 0; left:0;
            height: 100%;
            z-index: 1200;
            width:80%;
            overflow-y: scroll;
            overflow-x: hidden;
            transition: visibility .2s ease-in-out, transform .2s ease-in-out;
        }

        .mobile-offcanvas.show{
          visibility: visible;
            transform: translateX(0);
        }
      }
    </style>

<style>
    .form-control:focus {
      border-color: #0fbcf9;
      box-shadow: 0 0 0 0.1rem #fff;
      }
</style>


  @yield('css')
</head>

<body class="">
  <main class="main-content mt-0">
    <section>
        {{-- @include('Frontend.layout.navbar') --}}
        @yield('content')
        @include('Frontend.Layout.footer')
    </section>
</main>

<!--   Core JS Files   -->
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
{{-- <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script> --}}
<script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
crossorigin="anonymous"></script>

<script>
  var win = navigator.platform.indexOf('Win') > -1;
  if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
      damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
  }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
{{-- <script src="{{ asset('assets/js/soft-ui-dashboard.min.js?v=1.0.5') }}"></script> --}}

<script type="text/javascript">
  /// some script

  // jquery ready start
  $(document).ready(function() {
    // jQuery code


    $("[data-trigger]").on("click", function(e){
          e.preventDefault();
          e.stopPropagation();
          var offcanvas_id =  $(this).attr('data-trigger');
          $(offcanvas_id).toggleClass("show");
          $('body').toggleClass("offcanvas-active");
          $(".screen-overlay").toggleClass("show");
      });

       // Close menu when pressing ESC
      $(document).on('keydown', function(event) {
          if(event.keyCode === 27) {
             $(".mobile-offcanvas").removeClass("show");
             $("body").removeClass("overlay-active");
          }
      });

      $(".btn-close, .screen-overlay").click(function(e){
        $(".screen-overlay").removeClass("show");
          $(".mobile-offcanvas").removeClass("show");
          $("body").removeClass("offcanvas-active");


      });


  }); // jquery end
</script>

@yield('js')
</body>

</html>
