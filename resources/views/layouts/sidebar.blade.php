 <!-- Sidebar Menu -->
 <style>
    .dashboard-menu { border-left: 3px solid #17a2b8; }
    .dashboard-menu .nav-icon, .dashboard-menu p { color: #17a2b8 !important; }

    .user-menu { border-left: 3px solid #6f42c1; }
    .user-menu .nav-icon, .user-menu p { color: #6f42c1 !important; }

    .log-menu { border-left: 3px solid #6c757d; }
    .log-menu .nav-icon, .log-menu p { color: #6c757d !important; }

    .kategori-menu { border-left: 3px solid #fd7e14; }
    .kategori-menu .nav-icon, .kategori-menu p { color: #fd7e14 !important; }

    .alat-menu { border-left: 3px solid #20c997; }
    .alat-menu .nav-icon, .alat-menu p { color: #20c997 !important; }

    .alat-list-menu { border-left: 3px solid #0dcaf0; }
    .alat-list-menu .nav-icon, .alat-list-menu p { color: #0dcaf0 !important; }

    .peminjaman-menu { border-left: 3px solid #0d6efd; }
    .peminjaman-menu .nav-icon, .peminjaman-menu p { color: #0d6efd !important; }

    .approval-menu { border-left: 3px solid #ffc107; }
    .approval-menu .nav-icon, .approval-menu p { color: #ffc107 !important; }

    .return-monitoring-menu { border-left: 3px solid #f39c12; }
    .return-monitoring-menu .nav-icon, .return-monitoring-menu p { color: #f39c12 !important; }

    .return-self-menu { border-left: 3px solid #28a745; }
    .return-self-menu .nav-icon, .return-self-menu p { color: #28a745 !important; }

    .laporan-menu { border-left: 3px solid #dc3545; }
    .laporan-menu .nav-icon, .laporan-menu p { color: #dc3545 !important; }

    .ajukan-menu { border-left: 3px solid #6610f2; }
    .ajukan-menu .nav-icon, .ajukan-menu p { color: #6610f2 !important; }
 </style>
 <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link dashboard-menu">
          <i class="nav-icon fas fa-home"></i>
          <p>Dashboard</p>
        </a>
      </li>

      @php
          $user = auth()->user();
      @endphp

      @if ($user && $user->isAdmin())
        <li class="nav-item">
          <a href="{{ route('user.index') }}" class="nav-link user-menu">
            <i class="nav-icon fas fa-users"></i>
            <p>Kelola User</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('log.aktivitas') }}" class="nav-link log-menu">
            <i class="nav-icon fas fa-history"></i>
            <p>Log Aktivitas</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('kategori.index') }}" class="nav-link kategori-menu">
            <i class="nav-icon fas fa-tags"></i>
            <p>Kategori</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('alat.index') }}" class="nav-link alat-menu">
            <i class="nav-icon fas fa-toolbox"></i>
            <p>Alat</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('peminjaman.index') }}" class="nav-link peminjaman-menu">
            <i class="nav-icon fas fa-handshake"></i>
            <p>Peminjaman</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('approval.index') }}" class="nav-link approval-menu">
            <i class="nav-icon fas fa-check-circle"></i>
            <p>Persetujuan</p>
          </a>
        </li>
      @elseif ($user && $user->isPetugas())
        <li class="nav-item">
          <a href="{{ route('approval.index') }}" class="nav-link approval-menu">
            <i class="nav-icon fas fa-check-circle"></i>
            <p>Persetujuan</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('return-monitoring.index') }}" class="nav-link return-monitoring-menu">
            <i class="nav-icon fas fa-clipboard-check"></i>
            <p>Memantau Pengembalian</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('laporan') }}" class="nav-link laporan-menu">
            <i class="nav-icon fas fa-print"></i>
            <p>Laporan</p>
          </a>
        </li>
      @else
        @if ($user && $user->canAccessFeature('user'))
          <li class="nav-item">
            <a href="{{ route('user.index') }}" class="nav-link user-menu">
              <i class="nav-icon fas fa-users"></i>
              <p>Kelola User</p>
            </a>
          </li>
        @endif

        @if ($user && $user->canAccessFeature('log_aktivitas'))
          <li class="nav-item">
            <a href="{{ route('log.aktivitas') }}" class="nav-link log-menu">
              <i class="nav-icon fas fa-history"></i>
              <p>Log Aktivitas</p>
            </a>
          </li>
        @endif

        @if ($user && $user->canAccessFeature('kategori'))
          <li class="nav-item">
            <a href="{{ route('kategori.index') }}" class="nav-link kategori-menu">
              <i class="nav-icon fas fa-tags"></i>
              <p>Kategori</p>
            </a>
          </li>
        @endif

        @if ($user && $user->canAccessFeature('alat'))
          <li class="nav-item">
            <a href="{{ route('alat.index') }}" class="nav-link alat-menu">
              <i class="nav-icon fas fa-toolbox"></i>
              <p>Alat</p>
            </a>
          </li>
        @endif

        @if ($user && $user->canAccessFeature('alat_daftar'))
          <li class="nav-item">
            <a href="{{ route('alat.daftar') }}" class="nav-link alat-list-menu">
              <i class="nav-icon fas fa-list"></i>
              <p>Daftar Alat</p>
            </a>
          </li>
        @endif

        @if ($user && $user->canAccessFeature('peminjaman'))
          <li class="nav-item">
            <a href="{{ route('peminjaman.index') }}" class="nav-link peminjaman-menu">
              <i class="nav-icon fas fa-handshake"></i>
              <p>Peminjaman</p>
            </a>
          </li>
        @endif

        @if ($user && $user->canAccessFeature('approval'))
          <li class="nav-item">
            <a href="{{ route('approval.index') }}" class="nav-link approval-menu">
              <i class="nav-icon fas fa-check-circle"></i>
              <p>Persetujuan</p>
            </a>
          </li>
        @endif

        @if ($user && $user->canAccessFeature('return_monitoring'))
          <li class="nav-item">
            <a href="{{ route('return-monitoring.index') }}" class="nav-link return-monitoring-menu">
              <i class="nav-icon fas fa-clipboard-check"></i>
              <p>Memantau Pengembalian</p>
            </a>
          </li>
        @endif

        @if ($user && $user->canAccessFeature('return_monitoring_saya'))
          <li class="nav-item">
            <a href="{{ route('return-monitoring.saya') }}" class="nav-link return-self-menu">
              <i class="nav-icon fas fa-undo-alt"></i>
              <p>Kembalikan Barang</p>
            </a>
          </li>
        @endif

        @if ($user && $user->canAccessFeature('laporan'))
          <li class="nav-item">
            <a href="{{ route('laporan') }}" class="nav-link laporan-menu">
              <i class="nav-icon fas fa-print"></i>
              <p>Laporan</p>
            </a>
          </li>
        @endif

        @if ($user && $user->canAccessFeature('peminjaman_ajukan'))
          <li class="nav-item">
            <a href="{{ route('peminjaman.ajukan') }}" class="nav-link ajukan-menu">
              <i class="nav-icon fas fa-hand-holding"></i>
              <p>Ajukan Peminjaman</p>
            </a>
          </li>
        @endif
      @endif

      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-cog"></i>
          <p>
            Setting
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('profil') }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Profil</p>
            </a>
          </li>
          <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST" class="nav-link p-0 m-0 border-0 bg-transparent logout-form">
              @csrf
              <button type="submit" class="btn btn-link nav-link text-left w-100 border-0" onclick="return confirm('Apakah Anda yakin ingin logout?')">
                <i class="far fa-circle nav-icon"></i>
                <p class="d-inline">Logout</p>
              </button>
            </form>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
