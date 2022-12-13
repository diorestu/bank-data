<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,600;0,700;0,800;1,800&display=swap"
        rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/datatables.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('build/assets/app.665f89a5.css') }}" />
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
    </style>
    @yield('css')
</head>

<body class="d-flex flex-column bg-default">
    <aside class="navbar navbar-vertical navbar-expand-lg navbar-default border-end">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
                aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h1 class="navbar-brand navbar-brand-autodark pt-lg-4 align-items-center">
                <a href=".">
                    <img src="{{ asset('assets/img/logo-dark.png') }}" width="100" height="24" alt="Tabler"
                        class="navbar-brand-image">
                </a>
            </h1>
            <div class="collapse navbar-collapse" id="sidebar-menu">
                <ul class="navbar-nav pt-lg-3">
                    <li class="nav-item mb-1 d-none d-md-block">
                        <a href="#" class="nav-link d-flex justify-content-center lh-1 text-reset p-0"
                            data-bs-toggle="dropdown" aria-label="Open user menu">
                            <span class="avatar avatar-sm rounded-circle"
                                style="background-image: url(https://eu.ui-avatars.com/api/?length=1&background=90e0ef&color=333&name={{ urlencode(auth()->user()->name) }})"></span>
                            <div class="d-none d-lg-block ps-2">
                                <div>{{ auth()->user()->name }}</div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item mb-0 d-none d-md-block">
                        <div class="hr-text mt-4 mb-3">Menu</div>
                    </li>
                    <li class="nav-item mb-2 px-3">
                        <a class="nav-link {{ request()->is('dashboard') ? 'bg-dark rounded-2' : '' }}"
                            href="{{ route('user.dashboard') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="bx bx-fw bx-home"></i>
                            </span>
                            <span class="nav-link-title">
                                Beranda
                            </span>
                        </a>
                    </li>
                    @if (Auth::user()->roles[0]->name == 'user')
                        <li class="nav-item mb-2 px-3">
                            <a class="nav-link {{ request()->is('resume*') ? 'bg-dark rounded-2' : '' }}"
                                href="{{ route('resume.index') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <i class="bx bx-fw bx-file"></i>
                                </span>
                                <span class="nav-link-title">
                                    Buat CV
                                </span>
                            </a>
                        </li>
                        <li class="nav-item mb-2 px-3">
                            <a class="nav-link {{ request()->is('lamaran*') ? 'bg-dark rounded-2' : '' }}"
                                href="{{ route('user.lamaran') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <i class="bx bx-fw bx-file"></i>
                                </span>
                                <span class="nav-link-title">
                                    Lamaran Kerja Saya
                                </span>
                            </a>
                        </li>
                        <li class="nav-item mb-2 px-3">
                            <form class="nav-link" id="formLogout" method="post" action="{{ route('logout') }}">
                                @csrf
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <i class="bx bx-fw bx-exit text-pink"></i>
                                </span>
                                <a class="nav-link-title text-pink fw-bold cursor-pointer text-decoration-none"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Keluar
                                </a>
                            </form>
                        </li>
                    @else
                        <li class="nav-item mb-2 px-3">
                            <a class="nav-link {{ request()->is('perusahaan/lowongan*') ? 'bg-dark rounded-2' : '' }}"
                                href="{{ route('lowongan.index') }}">
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <i class="bx bx-fw bx-category"></i>
                                </span>
                                <span class="nav-link-title">
                                    Lowongan
                                </span>
                            </a>
                        </li>
                        <li class="nav-item mb-2 px-3">
                            <form class="nav-link" id="formLogout" method="post" action="{{ route('logout') }}">
                                @csrf
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <i class="bx bx-fw bx-exit text-pink"></i>
                                </span>
                                <a class="nav-link-title text-pink fw-bold cursor-pointer text-decoration-none"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Keluar
                                </a>
                            </form>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </aside>
    <div class="page-wrapper">
        @yield('content')
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="{{ asset('assets/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('build/assets/app.4759e0cd.js') }}"></script>
    @yield('js')
</body>

</html>
