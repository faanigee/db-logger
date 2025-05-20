@php
$containerNav = $containerNav ?? 'container-fluid';
@endphp

<nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
  <div class="{{$containerNav}}">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0">
      <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
        <i class="bx bx-menu bx-sm"></i>
      </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
      <!-- Search -->
      <div class="navbar-nav align-items-center">
        <div class="nav-item navbar-search-wrapper mb-0">
          <a class="nav-item nav-link search-toggler px-0" href="javascript:void(0);">
            <i class="bx bx-search-alt bx-sm"></i>
            <span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span>
          </a>
        </div>
      </div>
      <!-- /Search -->

      <ul class="navbar-nav flex-row align-items-center ms-auto">
        <!-- User -->
        <li class="nav-item navbar-dropdown dropdown-user dropdown">
          <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
            <div class="avatar avatar-online">
              <img src="{{ Auth::user()->profile_photo_url }}" alt class="rounded-circle">
            </div>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item" href="{{ route('profile.show') }}">
                <i class="bx bx-user me-2"></i>
                <span class="align-middle">Profile</span>
              </a>
            </li>
            <li>
              <div class="dropdown-divider"></div>
            </li>
            <li>
              <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bx bx-power-off me-2"></i>
                <span class="align-middle">Logout</span>
              </a>
              <form method="POST" id="logout-form" action="{{ route('logout') }}">
                @csrf
              </form>
            </li>
          </ul>
        </li>
        <!--/ User -->
      </ul>
    </div>

    <!-- Search Small Screens -->
    <div class="navbar-search-wrapper search-input-wrapper d-none">
      <input type="text" class="form-control search-input container-fluid border-0" placeholder="Search..."
        aria-label="Search...">
      <i class="bx bx-x bx-sm search-toggler cursor-pointer"></i>
    </div>
  </div>
</nav>