<div class="sidebar" data-color="green" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="/login" class="simple-text logo-normal">
      {{ __('E-Document') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'main' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="material-icons">home</i>
            <p>{{ __('หน้าหลัก') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'search' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('search') }}">
          <i class="material-icons">search</i>
            <p>{{ __('ค้นหาเอกสาร') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'manage_documents' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('manage') }}">
          <i class="material-icons">description</i>
            <p>{{ __('จัดการประเภทเอกสาร') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'manage_users' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('manage_users.index') }}">
          <i class="material-icons">manage_accounts</i>
            <p>{{ __('จัดการผู้ใช้งาน') }}</p>
        </a>
      </li>
    </ul>
  </div>
</div>
