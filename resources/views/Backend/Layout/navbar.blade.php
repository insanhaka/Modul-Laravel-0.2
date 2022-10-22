<!-- Navbar -->
<nav
  class="layout-navbar container-fluid navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
  id="layout-navbar"
  
>
  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
      <i class="bx bx-menu bx-sm"></i>
    </a>
  </div>

  <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
    
    <div class="navbar-nav align-items-center">
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
              <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5" style="font-size: 12px">
                <li class="breadcrumb-item text-sm">Pages</li>
                <li class="breadcrumb-item text-sm text-primary active" aria-current="page">{!! Label::label2() !!}</li>
              </ol>
            </li>
        </ol>
      </nav>
    </div>

    <ul class="navbar-nav flex-row align-items-center ms-auto">

      <!-- User -->
      <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
          <span class="d-sm-inline d-none">
            <h6 style="margin-top: 15%"><i class='bx bx-user-circle' style="font-size: 21px"></i> {{ Auth::user()->name }}</h6>
          </span>
          <span class="d-block d-sm-none" id="breadmenu">
            <div class="avatar avatar-online">
              <img src="{{ asset('assets/img/noimg-user.png') }}" alt class="w-px-40 h-auto rounded-circle" />
            </div>
          </span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" style="margin-right: -25px">
          <li>
            <a class="dropdown-item" href="#">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar avatar-online">
                    <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                  </div>
                </div>
                <div class="flex-grow-1">
                  <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                  <small class="text-muted">Admin</small>
                </div>
              </div>
            </a>
          </li>
          <li>
            <div class="dropdown-divider"></div>
          </li>
          <li>
            <a class="dropdown-item" href="/profile/admin/{{ Auth::user()->id }}">
              <i class="bx bx-user me-2"></i>
              <span class="align-middle">My Profile</span>
            </a>
          </li>
          @if (Auth::user()->role_id == 1)
          <li>
            <a class="dropdown-item" href="/super/setting">
              <i class="bx bx-cog me-2"></i>
              <span class="align-middle">Settings</span>
            </a>
          </li>
          @endif
          <li>
            <div class="dropdown-divider"></div>
          </li>
          <li>
            <a class="dropdown-item" href="/logout/admin">
              <i class="bx bx-power-off me-2"></i>
              <span class="align-middle">Log Out</span>
            </a>
          </li>
        </ul>
      </li>
      <!--/ User -->
    </ul>
  </div>
</nav>

  <!-- End Navbar -->
