<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{ route('dblogger.logs.index') }}" class="app-brand-link">
      <span class="app-brand-logo demo">
        <i class="bx bx-log-in-circle"></i>
      </span>
      <span class="app-brand-text demo menu-text fw-bold ms-2">DBLogger</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="bx menu-toggle-icon d-none d-xl-block fs-4 align-middle"></i>
      <i class="bx bx-x d-block d-xl-none bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-divider mt-0"></div>
  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- System Logs -->
    <li class="menu-item {{ request()->is('db-logs') ? 'active' : '' }}">
      <a href="{{ route('dblogger.logs.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-list-ul"></i>
        <div>System Logs</div>
      </a>
    </li>

    <!-- Settings -->
    <li class="menu-item {{ request()->is('db-logs/settings*') ? 'active' : '' }}">
      <a href="{{ route('dblogger.settings.index') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-cog"></i>
        <div>Settings</div>
      </a>
    </li>
  </ul>
</aside>