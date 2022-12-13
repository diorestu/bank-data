<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Parkir, Aplikasi Parkir Online, parkir non-tunai, parkir mudah">
    <meta name="author" content="Asta Pijar Kreasi Teknologi">
    <meta name="description" content="APP PARKIR by Asta Pijar Kreasi Teknologi">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="manifest" href="{{ asset('build/manifest.json') }}">

    {{-- Icons --}}
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    {{-- Plugin Addon --}}
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/choices.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/datatables.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('build/assets/app.665f89a5.css') }}" />
    <style>
        .toast {
            opacity: 0 !important;
        }

        .navbar-dark .navbar-nav .active>.nav-link {
            color: #ffd60a !important;
            font-weight: bold !important;
        }

        .choices__input {
            max-height: 28px !important;
        }
    </style>

    <!-- Custom styles for the Page-->
    @yield('css')
</head>

<body class="theme-light">
    <div class="page">
        <header class="navbar navbar-expand-md navbar-dark navbar-overlap d-print-none">
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                    <a href="/">
                        <img src="{{ asset('assets/img/logo-dark.png') }}" alt="Tabler" class="navbar-brand-image">
                    </a>
                </h1>
                <div class="navbar-nav flex-row order-md-last">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                            aria-label="Open user menu">
                            <span class="avatar avatar-sm rounded-circle"
                                style="background-image: url(https://eu.ui-avatars.com/api/?background=ffd60a&color=333&name={{ urlencode(auth()->user()->name) }})"></span>
                            <div class="d-none d-xl-block ps-2">
                                <div>{{ auth()->user()->name }}</div>
                                <div class="mt-1 small text-muted">{{ ucwords(auth()->user()->roles[0]->name) }}</div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <a href="{{ route('profile.show') }}" class="dropdown-item"><i
                                    class='bx bxs-user me-2'></i>{{ __('Profil Saya') }}</a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" class="dropdown-item text-danger"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class='bx bxs-log-out-circle me-2 text-danger font-bold'></i>{{ __('Keluar') }}
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                        @include('layouts.navigation')
                    </div>
                </div>
            </div>
        </header>
        <div class="page-wrapper">

            @yield('content')

            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <div class="row text-center align-items-center flex-row-reverse">
                        <div class="col-lg-auto ms-lg-auto">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item"><a href="https://astagojob.com" target="_blank"
                                        class="link-secondary" rel="noopener">PT Asta Nadi Karya Utama</a></li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    &copy; {{ date('Y') }}
                                    <a href="{{ config('app.url') }}" class="link-secondary">Asta Pijar Kreasi
                                        Teknologi</a>
                                </li>
                                <li class="list-inline-item">
                                    V1.0.1
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    </div>

    <!-- Core plugin JavaScript-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="{{ asset('assets/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/choices.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('build/assets/app.4759e0cd.js') }}"></script>

    <!-- Page level custom scripts -->
    @yield('js')
    {{-- @vite('resources/js/app.js') --}}
    <script>
        @if (Session::has('success'))
            Swal.fire({
                title: 'Berhasil',
                text: "{{ session('success') }}",
                icon: 'success',
                timer: 1500,
            });
        @endif

        @if (Session::has('error'))
            Swal.fire({
                title: 'Gagal',
                text: "{{ session('error') }}",
                icon: 'error',
                timer: 1500,
            });
        @endif

        @if (Session::has('warning'))
            Swal.fire({
                title: 'Peringatan',
                text: "{{ session('warning') }}",
                icon: 'warning',
                timer: 1500,
            });
        @endif
    </script>


</body>

</html>
