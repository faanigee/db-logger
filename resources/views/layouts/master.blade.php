@isset($pageConfigs)
{!! Helper::updatePageConfig($pageConfigs) !!}
@endisset
@php
$configData = Helper::appClasses();
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
  class="{{ config('dblogger.dark_mode') ? 'dark-style' : 'light-style' }} layout-navbar-fixed layout-menu-fixed"
  dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('/assets') . '/' }}" data-base-url="{{url('/')}}"
  data-framework="laravel" data-template="vertical-menu-laravel">

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>@yield('title') | Dblogger Package</title>
  <meta name="description" content="" />
  <meta name="keywords" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Canonical SEO -->
  <link rel="canonical" href="">
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet">

  <!-- Icons -->
  <link rel="stylesheet" href="{{ asset(mix('assets/vendor/fonts/boxicons.css')) }}" />
  <link rel="stylesheet" href="{{ asset(mix('assets/vendor/fonts/fontawesome.css')) }}" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="{{ asset(mix('assets/vendor/css/rtl/core.css')) }}" />
  <link rel="stylesheet" href="{{ asset(mix('assets/vendor/css/rtl/theme-default.css')) }}" />
  <link rel="stylesheet" href="{{ asset(mix('assets/css/demo.css')) }}" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="{{ asset(mix('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')) }}" />
  <link rel="stylesheet" href="{{ asset(mix('assets/vendor/libs/typeahead-js/typeahead.css')) }}" />

  <!-- Page CSS -->
  @yield('page-style')

  <!-- Helper CSS -->
  @yield('vendor-style')

  <!-- Scripts -->
  <script src="{{ asset(mix('assets/vendor/js/helpers.js')) }}"></script>
  <script src="{{ asset(mix('assets/vendor/js/template-customizer.js')) }}"></script>
  <script src="{{ asset(mix('assets/js/config.js')) }}"></script>

  @livewireStyles
</head>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->
      @include('dblogger::layouts.sections.menu')
      <!-- / Menu -->

      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->
        @include('dblogger::layouts.sections.navbar')
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->
          <div class="container-fluid flex-grow-1 container-p-y">
            @yield('content')
          </div>
          <!-- / Content -->

          <!-- Footer -->
          @include('dblogger::layouts.sections.footer')
          <!-- / Footer -->

          <div class="content-backdrop fade"></div>
        </div>
        <!-- / Content wrapper -->
      </div>
      <!-- / Layout container -->
    </div>
  </div>
  <!-- / Layout wrapper -->

  <!-- Core JS -->
  @include('dblogger::layouts.sections.scripts')

  @livewireScripts
</body>

</html>