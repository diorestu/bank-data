<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>
        Dapat Kerja - Portal Lowongan Kerja Mudah & Terpercaya
    </title>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,600;0,700;0,800;1,800&display=swap"
        rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        .hero-text {
            font-size: 32px;
            font-weight: 800 !important;
        }
    </style>
    @vite('resources/sass/app.scss')
    @yield('css')
</head>

<body class="border-top-wide border-primary d-flex flex-column bg-default">
    <header class="navbar navbar-expand-md navbar-light d-print-none">
        <div class="container-xl">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
                aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                <a href=".">
                    <img src="{{ asset('assets/img/logo-dark.png') }}" alt="" width="125">
                </a>
            </h1>
            <div class="navbar-nav flex-row order-md-last py-2 gap-3">
                <a href="{{ route('app.postJob') }}"
                    class="btn btn-pill btn-ghost-primary btn-sm d-none d-md-inline-flex">
                    Pasang Lowongan
                </a>
                @auth
                    <a href="#" class="d-flex lh-1 text-reset p-0 align-items-center" data-bs-toggle="dropdown"
                        aria-label="Open user menu">
                        <span class="avatar avatar-sm rounded-circle border border-default"
                            style="background-image: url({{ asset('assets/img/no-user2.png') }})"></span>
                        <div class="d-none d-xl-block ps-2">
                            <div>{{ auth()->user()->name }}</div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <a href="{{ route('user.dashboard') }}" class="dropdown-item"><i
                                class='bx bxs-tachometer me-2'></i>{{ __('Dasbor') }}</a>
                        <a href="{{ route('profile.show') }}" class="dropdown-item"><i
                                class='bx bxs-cog me-2'></i>{{ __('Profil Saya') }}</a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" class="dropdown-item text-danger"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class='bx bxs-log-out-circle me-2 text-danger font-bold'></i>{{ __('Keluar') }}
                            </a>
                        </form>
                    </div>
                @endauth
                @guest
                    <a href="javascript:void(0);" class="btn btn-outline-dark btn-pill btn-sm" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        Masuk
                    </a>
                    <!-- Modal -->
                    <div class="modal fade" tabindex="-1" class="modal fade" id="exampleModal" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <h3>Siap untuk ambil langkah berikutnya?</h3>
                                    <div class="py-2">
                                        <a href='/' class="btn btn-default btn-md w-100" tabindex="4"><i
                                                class='bx bxs-log-in-circle me-1'></i>Masuk via Google</a>
                                    </div>
                                    <hr class="my-2">
                                    <form class="" action="{{ route('login') }}" method="post" autocomplete="off">
                                        @csrf
                                        <div class="">
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Nama Pengguna') }}</label>
                                                <input type="text" name="username" value="{{ old('username') }}"
                                                    class="form-control @error('username') is-invalid @enderror"
                                                    placeholder="{{ __('Nama Pengguna Anda') }}" required autofocus
                                                    tabindex="1">
                                                @error('username')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-2">
                                                <label class="form-label">
                                                    {{ __('Kata Sandi') }}
                                                </label>
                                                <input type="password" name="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    placeholder="{{ __('Kata Sandi Anda') }}" required tabindex="2">
                                                @error('password')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div>
                                                <label class="form-check">
                                                    <input type="checkbox" class="form-check-input" tabindex="3"
                                                        name="remember" />
                                                    <span class="form-check-label">{{ __('Ingat saya') }}</span>
                                                </label>
                                            </div>

                                            <div class="form-footer">
                                                <button type="submit" class="btn btn-blue shadow w-100"
                                                    tabindex="4"><i class='bx bxs-log-in-circle me-1'></i>Masuk</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="text-center mt-3">
                                        <code>Developed by &copy; ASTA PIJAR KREASI TEKNOLOGI ∘ {{ date('Y') }}</code>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endguest

            </div>
            <div class="collapse navbar-collapse" id="navbar-menu">
                <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                    <ul class="navbar-nav">
                        <li class="nav-item {{ request()->is('cari*') ? 'active' : '' }}">
                            <a class="nav-link" href="/cari">
                                <span class="nav-link-title">
                                    Cari Lowongan
                                </span>
                            </a>
                        </li>
                        <li class="nav-item dropdown {{ request()->is('layanan*') ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle" href="#navbar-third" data-bs-toggle="dropdown"
                                data-bs-auto-close="outside" role="button" aria-expanded="false">
                                <span class="nav-link-title">
                                    Layanan Informasi
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('app.l1') }}">
                                    Informasi Bidang Pekerjaan
                                </a>
                                <a class="dropdown-item" href="{{ route('app.l2') }}">
                                    Informasi Gaji
                                </a>
                                <a class="dropdown-item" href="{{ route('app.l3') }}">
                                    Informasi Perusahaan
                                </a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('resume.index') }}">
                                <span class="nav-link-title">
                                    Buat CV
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <div class="page">
        <div class="page-body">
            @yield('content')
        </div>
        <footer class="footer footer-white d-print-none">
            <div class="container-xl">
                <div class="row text-center align-items-center flex-row-reverse">
                    <div class="col-lg-auto ms-lg-auto">
                        <ul class="list-inline list-inline-dots mb-0">
                            <li class="list-inline-item"><a href="../docs/" class="link-secondary">Tentang Kami</a>
                            </li>
                            <li class="list-inline-item"><a href="../license.html" class="link-secondary">Bantuan</a>
                            </li>
                            <li class="list-inline-item"><a href="../license.html" class="link-secondary">FAQ</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                        <ul class="list-inline list-inline-dots mb-0">
                            <li class="list-inline-item">
                                Hak Cipta © 2022
                                <a href=".." class="link-secondary">PT Asta Pijar Kreasi Teknologi</a>.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    @vite('resources/js/app.js')
    @yield('js')
</body>

</html>
