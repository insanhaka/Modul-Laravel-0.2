<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo mb-3">
    <a href="/admin/dashboard" class="app-brand-link">
      <span class="app-brand-logo demo">
        <img src="{{asset('assets/img/icon/speedometer.png')}}" class="img-fluid" alt="logo" style="margin-right: 10px; width: 30px">
      </span>
      <span class="ms-1" style="font-size: 21px; font-weight: bold; color : #303952">Super Dashboard</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item mb-2" id="dashboard">
      <a href="/super/dashboard" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Dashboard</div>
      </a>
    </li>

    <li class="menu-item mb-2" id="menu">
      <a href="/super/menu" class="menu-link">
        <i class="menu-icon tf-icons bx bx-list-ul"></i>
        <div data-i18n="Analytics">Menu</div>
      </a>
    </li>

    <li class="menu-item mb-2" id="role">
      <a href="/super/role" class="menu-link">
        <i class="menu-icon tf-icons bx bx-key"></i>
        <div data-i18n="Analytics">Role & Permission</div>
      </a>
    </li>

    <li class="menu-item mb-2" id="user">
      <a href="/super/user" class="menu-link">
        <i class="menu-icon tf-icons bx bxs-user-detail"></i>
        <div data-i18n="Analytics">All User</div>
      </a>
    </li>

    <li class="menu-item mb-2" id="api-header">
      <a href="/super/api-header" class="menu-link">
        <i class="menu-icon tf-icons bx bxs-hot"></i>
        <div data-i18n="Analytics">API Header</div>
      </a>
    </li>

    <li class="menu-item mb-2" id="base-url">
      <a href="/super/base-url" class="menu-link">
        <i class="menu-icon tf-icons bx bx-world"></i>
        <div data-i18n="Analytics">Base URL</div>
      </a>
    </li>

  </ul>
</aside>
<!-- / Menu -->


