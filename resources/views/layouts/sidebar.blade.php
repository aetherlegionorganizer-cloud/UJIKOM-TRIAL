<!-- Sidebar Menu -->
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
      <a href="{{ route('dashboard.index') }}" class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Dashboard</p>
      </a>
    </li>

    @if (auth()->user()->role == 'admin')
      <li class="nav-header">MASTER DATA</li>
      <li class="nav-item">
        <a href="{{ route('user.index') }}" class="nav-link {{ request()->routeIs('user.*') ? 'active' : '' }}">
          <i class="nav-icon fas fa-users"></i>
          <p>Kelola User</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('kategori.index') }}" class="nav-link {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
          <i class="nav-icon fas fa-tags"></i>
          <p>Kelola Kategori</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('alat.index') }}" class="nav-link {{ request()->routeIs('alat.*') ? 'active' : '' }}">
          <i class="nav-icon fas fa-tools"></i>
          <p>Kelola Alat</p>
        </a>
      </li>

      <li class="nav-header">TRANSAKSI</li>
      <li class="nav-item">
        <a href="{{ route('peminjaman.index') }}" class="nav-link {{ request()->routeIs('peminjaman.index') ? 'active' : '' }}">
          <i class="nav-icon fas fa-clipboard"></i>
          <p>Data Peminjaman</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('pengembalian.index') }}" class="nav-link {{ request()->routeIs('pengembalian.index') ? 'active' : '' }}">
          <i class="nav-icon fas fa-undo"></i>
          <p>Data Pengembalian</p>
        </a>
      </li>

      <li class="nav-header">SISTEM</li>
      <li class="nav-item">
        <a href="{{ route('log.index') }}" class="nav-link {{ request()->routeIs('log.*') ? 'active' : '' }}">
          <i class="nav-icon fas fa-history"></i>
          <p>Log Aktivitas</p>
        </a>
      </li>
    @elseif (auth()->user()->role == 'petugas')
      <li class="nav-header">TRANSAKSI</li>
      <li class="nav-item">
        <a href="{{ route('peminjaman.index') }}" class="nav-link {{ request()->routeIs('peminjaman.index') ? 'active' : '' }}">
          <i class="nav-icon fas fa-check"></i>
          <p>Setujui Peminjaman</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('pengembalian.pantau') }}" class="nav-link {{ request()->routeIs('pengembalian.pantau') ? 'active' : '' }}">
          <i class="nav-icon fas fa-eye"></i>
          <p>Pantau Pengembalian</p>
        </a>
      </li>

      <li class="nav-header">LAPORAN</li>
      <li class="nav-item">
        <a href="{{ route('laporan.index') }}" class="nav-link {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
          <i class="nav-icon fas fa-print"></i>
          <p>Cetak Laporan</p>
        </a>
      </li>
    @else
      <li class="nav-header">PEMINJAMAN</li>
      <li class="nav-item">
        <a href="{{ route('peminjaman.katalog') }}" class="nav-link {{ request()->routeIs('peminjaman.katalog') ? 'active' : '' }}">
          <i class="nav-icon fas fa-search"></i>
          <p>Daftar Alat</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('peminjaman.saya') }}" class="nav-link {{ request()->routeIs('peminjaman.saya') ? 'active' : '' }}">
          <i class="nav-icon fas fa-list"></i>
          <p>Peminjaman Saya</p>
        </a>
      </li>
    @endif

    <li class="nav-header">AKUN</li>
    <li class="nav-item">
      <a href="{{ route('logout') }}" class="nav-link">
        <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
        <p>Logout</p>
      </a>
    </li>
  </ul>
</nav>
<!-- /.sidebar-menu -->
