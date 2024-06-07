<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
  
<img src="{{ asset('storage/back/pengaturan/') }}" alt=" Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
<span class="brand-text font-weight-light"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if(Auth::user()->foto_profile)
              <img src="{{ asset('storage/back/foto-profile/' . Auth::user()->foto_profile) }}" class="rounded-circle" alt="Foto Pengguna" >
          @else
              <img src="{{ asset('admin/img/profile.png') }}" alt="Foto Profil" class="rounded-circle" >
          @endif
        </div>
        <div class="info">
 
          <a href="#" class="d-block">{{ Auth::user()->name }} | {{ Auth::user()->level }}</a>
        </div>
      </div>


      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item menu-open">
            <a href="" class="nav-link active">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
            <li class="nav-header">APP</li>
            <li class="nav-item">
              <a href="{{route('kategori.index')}}" class="nav-link">
                <i class="nav-icon fas fa-trash"></i>
                <p>Kategori sampah</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('jenis.index')}}" class="nav-link">
                <i class="nav-icon fas fa-trash"></i>
                <p>jenis sampah</p>
              </a>
            </li>
  
          <li class="nav-header">Kelola pegawai</li>
          <li class="nav-item">
            <a href="{{route('users.index')}}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>User</p>
            </a>
          </li>
          <li class="nav-header">Informasi perusahaan</li>
          <li class="nav-item">
            <a href="{{route('setting.index')}}" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>setting</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>