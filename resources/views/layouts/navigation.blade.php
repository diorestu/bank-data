<ul class="navbar-nav">
    <li class="nav-item @if (request()->routeIs('admin.home')) active @endif">
        <a class="nav-link" href="{{ route('admin.home') }}">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
                <i class='bx bxs-dashboard'></i>
            </span>
            <span class="nav-link-title">
                {{ __('Dashboard') }}
            </span>
        </a>
    </li>
    <li class="nav-item @if (request()->routeIs('kategori*')) active @endif">
        <a class="nav-link" href="{{ route('kategori.index') }}">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
                <i class='bx bx-category'></i>
            </span>
            <span class="nav-link-title">
                {{ __('Kategori') }}
            </span>
        </a>
    </li>
    <li class="nav-item @if (request()->routeIs('kandidat*')) active @endif">
        <a class="nav-link" href="{{ route('kandidat.index') }}">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
                <i class='bx bx-user'></i>
            </span>
            <span class="nav-link-title">
                {{ __('Kandidat') }}
            </span>
        </a>
    </li>
    <li class="nav-item @if (request()->routeIs('mitra*')) active @endif">
        <a class="nav-link" href="{{ route('mitra.index') }}">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
                <i class='bx bx-building'></i>
            </span>
            <span class="nav-link-title">
                {{ __('Perusahaan Mitra') }}
            </span>
        </a>
    </li>
    {{-- <li class="nav-item @if (request()->routeIs('riwayat*')) active @endif">
        <a class="nav-link" href="{{ route('riwayat.index') }}">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
                <i class='bx bx-building'></i>
            </span>
            <span class="nav-link-title">
                {{ __('Log ') }}
            </span>
        </a>
    </li> --}}
    {{-- <li class="nav-item dropdown @if (request()->routeIs('transaksi*')) active @endif">
        <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" data-bs-auto-close="outside"
            role="button" aria-expanded="false">
            <span class="nav-link-icon d-md-none d-lg-inline-block">
                <i class='bx bx-transfer-alt'></i>
            </span>
            <span class="nav-link-title">
                Transaksi
            </span>
        </a>
        <div class="dropdown-menu">
            <a class="dropdown-item {{ request()->is('transaksi') ? 'active' : '' }}"
                href="{{ route('transaksi.harian') }}">
                Transaksi Harian
            </a>
            <a class="dropdown-item {{ request()->is('transaksi/perLokasi') ? 'active' : '' }}"
                href="{{ route('transaksi.lokasi') }}">
                Transaksi Per Lokasi
            </a>
            <a class="dropdown-item {{ request()->is('transaksi/perPetugas') ? 'active' : '' }}"
                href="{{ route('transaksi.petugas') }}">
                Transaksi Per Petugas
            </a>
            <a class="dropdown-item {{ request()->is('transaksi/report') ? 'active' : '' }}"
                href="{{ route('transaksi.report') }}">
                Laporan Transaksi
            </a>
        </div>
    </li> --}}
</ul>
