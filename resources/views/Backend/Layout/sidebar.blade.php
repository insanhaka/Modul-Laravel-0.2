<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo mb-3">
    <a href="/admin/dashboard" class="app-brand-link">
      <span class="app-brand-logo demo">
        <img src="{{asset('assets/img/icon/speedometer.png')}}" class="img-fluid" alt="logo" style="margin-right: 10px; width: 30px">
      </span>
      <span class="ms-1" style="font-size: 21px; font-weight: bold; color : #303952">Dashboard</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item mb-2" id="dashboard">
      <a href="/admin/dashboard" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle text-primary"></i>
        <div data-i18n="Analytics">Dashboard</div>
      </a>
    </li>

    {!! BackMenu::getRole(Auth::user()->role_id) !!}

    <!-- Dropdown -->
    {{-- <li class="menu-item active open">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-layout"></i>
        <div data-i18n="Layouts">Layouts</div>
      </a>

      <ul class="menu-sub">
        <li class="menu-item">
          <a href="layouts-without-menu.html" class="menu-link">
            <div data-i18n="Without menu">Without menu</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="layouts-without-navbar.html" class="menu-link">
            <div data-i18n="Without navbar">Without navbar</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="layouts-container.html" class="menu-link">
            <div data-i18n="Container">Container</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="layouts-fluid.html" class="menu-link">
            <div data-i18n="Fluid">Fluid</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="layouts-blank.html" class="menu-link">
            <div data-i18n="Blank">Blank</div>
          </a>
        </li>
      </ul>
    </li> --}}

  </ul>
</aside>
<!-- / Menu -->
