
<!-- Sidebar -->
<div class="sidebar">

    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('assets/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            @if (auth()->guard('web')->check())
            <a href="#" class="d-block">{{auth()->user()->name}} <span class="right badge badge-primary">Operator</span></a>
            @else
            <a href="#" class="d-block">{{auth()->user()->name}} <span style="position: absolute;
                right: 1rem;
                top: .5rem;" class="right badge badge-success">Admin</span></a>
            @endif
        </div>
      </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
          <a href="{{route('admin.home')}}" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        @if (auth()->guard('admin')->check())
        <li class="nav-item">
            <a href="{{route('student.sd')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Siswa SD
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('student.smp')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Siswa SMP
              </p>
            </a>
          </li>
        @else
        <li class="nav-item">
            <a href="{{route('siswa.index')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Siswa
              </p>
            </a>
          </li>
        @endif
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Data Master
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('student.sd')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Siswa</p>
              </a>
            </li>
            {{-- <li class="nav-item">
              <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Jabatan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Bagian</p>
              </a>
            </li> --}}
          </ul>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
