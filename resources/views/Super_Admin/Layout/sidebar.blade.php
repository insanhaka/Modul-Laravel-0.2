<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="/admin/dashboard">
        <img src="{{asset('assets/img/icon/speedometer.png')}}" class="navbar-brand-img h-100" alt="logo" style="margin-right: 10px;">
        <span class="ms-1 font-weight-bold" style="font-size: 16px;">Super Dashboard</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">

        <li class="nav-item">
          <a class="nav-link" href="/super/dashboard" id="dashboard">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-chart-bar-32" style="color: #000"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/super/menu" id="menu">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-bullet-list-67" style="color: #000"></i>
            </div>
            <span class="nav-link-text ms-1">Menu</span>
          </a>
      </li>

        <li class="nav-item">
            <a class="nav-link" href="/super/role" id="role">
              <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="ni ni-badge" style="color: #000"></i>
              </div>
              <span class="nav-link-text ms-1">Role & Permission</span>
            </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/super/user" id="user">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-single-02" style="color: #000"></i>
            </div>
            <span class="nav-link-text ms-1">User</span>
          </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/super/api-header" id="api-header">
              <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="ni ni-key-25" style="color: #000"></i>
              </div>
              <span class="nav-link-text ms-1">API Header</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/super/base-url" id="base-url">
              <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="ni ni-world-2" style="color: #000"></i>
              </div>
              <span class="nav-link-text ms-1">Base URL</span>
            </a>
          </li>

      </ul>
    </div>
</aside>
