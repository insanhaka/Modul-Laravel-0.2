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
    <li class="menu-item mb-2" id="dashboard" onclick="sidemenu(this)">
      <a href="/admin/dashboard" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle text-primary"></i>
        <div data-i18n="Analytics">Dashboard</div>
      </a>
    </li>

    @foreach ( BackMenu::getRole(Auth::user()->role_id)['parent'] as $parent_menu )
      @if (in_array($parent_menu->id, BackMenu::getRole(Auth::user()->role_id)['parenthaschild']))

      <li class="menu-item mb-2 {{ (BackMenu::getURI() == Str::after($parent_menu->uri, '/') || BackMenu::getID() == $parent_menu->id) ? 'open active' : '' }}" id="{!! Str::after($parent_menu->uri, '/') !!}" onclick="sidemenu(this)">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <img src="{!! Storage::url('icon/'.$parent_menu->icon) !!}" class="img-fluid" alt="Responsive image" width="16" style="margin-right: 18px; margin-left: 2px">
          <div data-i18n="Layouts">{!! $parent_menu->name !!}</div>
        </a>
  
        <ul class="menu-sub">
          @foreach (BackMenu::getRole(Auth::user()->role_id)['child'] as $child_menu )
            @if ($child_menu->parent_id == $parent_menu->id)
            <li class="menu-item {{ (BackMenu::getURI() == Str::after($child_menu->uri, '/')) ? 'active' : '' }}" id="{!! Str::after($child_menu->uri, '/') !!}" onclick="sidemenu(this)">
              <a href="{!! "/admin/".$child_menu->uri !!}" class="menu-link">
                <div data-i18n="Without menu">{!! $child_menu->name !!}</div>
              </a>
            </li>
            @endif
          @endforeach
        </ul>
      </li>

      @else

      <li class="menu-item mb-2 {{ (BackMenu::getURI() == Str::after($parent_menu->uri, '/')) ? 'active' : '' }}" id="{!! Str::after($parent_menu->uri, '/') !!}" onclick="sidemenu(this)">
        <a href="{!! "/admin/".$parent_menu->uri !!}" class="menu-link">
          <img src="{!! Storage::url('icon/'.$parent_menu->icon) !!}" class="img-fluid" alt="Responsive image" width="16" style="margin-right: 18px; margin-left: 2px">
          <div data-i18n="Analytics">{!! $parent_menu->name !!}</div>
        </a>
      </li>
      
      @endif
    @endforeach

    {{-- {!! BackMenu::getRole(Auth::user()->role_id) !!} --}}

  </ul>
</aside>
<!-- / Menu -->
