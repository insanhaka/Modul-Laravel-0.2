<!-- Image and text -->
<nav class="navbar navbar-light bg-light" id="nav-besar">
    <a class="navbar-brand" style="font-weight: bold; font-size: 18px;" href="/">
        <img src="{{ asset('assets/img/logos/Logo2.png') }}" width="100" height="40" class="d-inline-block align-top" style="margin-right: 5%" alt="">
    </a>
    <button data-trigger="#navbar_main" class="d-lg-none btn mt-3" type="button">
        <i class="fa fa-bars" aria-hidden="true"></i>
    </button>
</nav>

<nav id="navbar_main" class="mobile-offcanvas navbar navbar-expand-lg navbar-light bg-light">

    <a class="navbar-brand" style="font-weight: bold; font-size: 18px; margin-right: 30px;" href="/">
        <img src="{{ asset('assets/img/logos/Logo2.png') }}" width="100" height="40" class="d-inline-block align-top" style="margin-right: 5%" alt="">
    </a>
    <button data-trigger="#navbar_main" class="d-lg-none btn mt-3" type="button">
        <i class="fa fa-times" aria-hidden="true"></i>
    </button>

    <ul class="navbar-nav">
        <li class="nav-item" style="margin-right: 10px">
            <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item" style="margin-right: 10px">
            <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item" style="margin-right: 10px">
            <a class="nav-link" href="#">Services</a>
        </li>
    </ul>

</nav>




<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 border-radius-xl mt-3 " id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <a class="navbar-brand" style="font-weight: bold; font-size: 18px;" href="/">
            <img src="{{ asset('assets/img/logos/Logo2.png') }}" width="100" height="40" class="d-inline-block align-top" style="margin-right: 5%" alt="">
        </a>
      </nav>
      <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
        </div>

        <ul class="navbar-nav justify-content-end">
            <li class="nav-item align-items-center" style="margin-right: 30px; margin-top: 20px;">
                <a href="/" class="nav-link text-body p-0" aria-expanded="false">
                  <span class="d-sm-inline d-none">Home</span>
                </a>
            </li>
            <li class="nav-item align-items-center" style="margin-right: 30px; margin-top: 20px;">
                <a href="/product" class="nav-link text-body p-0" aria-expanded="false">
                  <span class="d-sm-inline d-none">Produk</span>
                </a>
            </li>
            <li class="nav-item align-items-center" style="margin-right: 40px; margin-top: 20px;">
                <a href="/information" class="nav-link text-body p-0" aria-expanded="false">
                  <span class="d-sm-inline d-none">Informasi</span>
                </a>
            </li>

            @if (Auth::check())
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
                <a href="javascript:;" class="btn" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="margin-top: 10px;">
                  <span class="d-sm-inline d-none">Hi, {{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" style="margin-top: 35px !important" aria-labelledby="dropdownMenuButton">
                    <li class="mb-2">
                        <a class="dropdown-item border-radius-md" href="/profil/user">
                          <div class="d-flex py-1">
                            <div class="my-auto">
                              <img src="{{ asset('assets/img/icon/user.png') }}" width="20">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="text-sm font-weight-normal mb-1" style="margin-left: 20px;">
                                <span class="font-weight-bold">PROFIL</span>
                              </h6>
                            </div>
                          </div>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a class="dropdown-item border-radius-md" href="/setting">
                        <div class="d-flex py-1">
                            <div class="my-auto">
                            <img src="{{ asset('assets/img/icon/settings.png') }}" width="20">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                            <h6 class="text-sm font-weight-normal mb-1" style="margin-left: 20px;">
                                <span class="font-weight-bold">PENGATURAN</span>
                            </h6>
                            </div>
                        </div>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a class="dropdown-item border-radius-md" href="/logout/user">
                        <div class="d-flex py-1">
                            <div class="my-auto">
                            <img src="{{ asset('assets/img/icon/back.png') }}" width="20">
                            </div>
                            <div class="d-flex flex-column justify-content-right">
                                <h6 class="text-sm font-weight-normal mb-1" style="margin-left: 20px;">
                                    <span class="font-weight-bold">LOG OUT</span>
                                </h6>
                            </div>
                        </div>
                        </a>
                    </li>
                </ul>
            </li>
            @else
            <li class="nav-item align-items-center" style="margin-right: 20px; margin-top: 15px;">
                <a href="/masuk" class="btn btn-sm btn-info" aria-expanded="false">
                  <span class="d-sm-inline d-none">Masuk</span>
                </a>
            </li>

            <li class="nav-item align-items-center" style="margin-top: 15px;">
                <a href="/daftar" class="btn btn-sm btn-outline-info" aria-expanded="false">
                  <span class="d-sm-inline d-none">Daftar</span>
                </a>
            </li>
            @endif

        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
