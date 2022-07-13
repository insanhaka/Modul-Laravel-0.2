<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true" style="padding-top: 15px;">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center" style="margin-right: 30px">
                <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                  <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                  </div>
                </a>
            </li>
            <li>
              <h6 class="font-weight-bolder mb-0">{!! Label::label1() !!}</h6>
              <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{!! Label::label2() !!}</li>
              </ol>
            </li>
        </ol>
      </nav>
      <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
        </div>
        <ul class="navbar-nav  justify-content-end">
            <li class="nav-item dropdown pe-2 d-flex align-items-center">
                <a href="javascript:;" class="btn" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="margin-top: 10px;">
                  <span class="d-sm-inline d-none">Hi, {{ Auth::user()->name }}</span>
                  <span class="d-sm-inline d-none" id="breadmenu">=</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" id="dropbreadmenu" aria-labelledby="dropdownMenuButton">
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
                    @if (Auth::user()->role_id == 1)
                    <li class="mb-2">
                      <a class="dropdown-item border-radius-md" href="/super/setting">
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
                    @endif
                    <li class="mb-2">
                        <a class="dropdown-item border-radius-md" href="/logout/admin">
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
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
