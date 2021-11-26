@php
$configData = Helper::applClasses();
@endphp

<body
  class="vertical-layout vertical-menu-modern 2-columns {{ $configData['blankPageClass'] }} {{ $configData['bodyClass'] }} {{($configData['theme'] === 'light') ? '' : $configData['layoutTheme'] }} {{ $configData['verticalMenuNavbarType'] }} {{ $configData['sidebarClass'] }} {{ $configData['footerType'] }} "
  data-menu="vertical-menu-modern" data-col="2-columns" {{ Session::has('notification') ? 'data-notification' : '' }}
  data-notification-type='{{ Session::get('alert_type', 'info') }}'
  data-notification-message='{{ json_encode(Session::get('message')) }}'>
  {{-- Include Sidebar --}}
  @include('panels.admin.sidebar')
  <!-- BEGIN: Content-->
  <div class="app-content content">
    <!-- BEGIN: Header-->
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>

    {{-- Include Navbar --}}
    @include('panels.admin.navbar')

    @if(($configData['contentLayout']!=='default') && isset($configData['contentLayout']))
    <div class="content-area-wrapper">
      <div class="{{ $configData['sidebarPositionClass'] }}">
        <div class="sidebar">
          {{-- Include Sidebar Content --}}
          @yield('content-sidebar')
        </div>
      </div>
      <div class="{{ $configData['contentsidebarClass'] }}">
        <div class="content-wrapper">
          <div class="content-body">
            {{-- Include Page Content --}}
            @yield('content')
          </div>
        </div>
      </div>
    </div>
    @else
    <div class="content-wrapper">
      {{-- Include Breadcrumb --}}

      @if($configData['pageHeader'] === true && isset($configData['pageHeader']))
      @include('panels.admin.breadcrumb')
      @endif

      <div class="content-body">

        @include('panels.admin.messages')


        {{-- Include Page Content --}}
        @yield('content')
      </div>
    </div>
    @endif

  </div>
  <!-- End: Content-->

  <div class="sidenav-overlay"></div>
  <div class="drag-target"></div>

  {{-- include footer --}}
  @include('panels.admin.footer')

  {{-- include default scripts --}}
  @include('panels.admin.scripts')

</body>

</html>
