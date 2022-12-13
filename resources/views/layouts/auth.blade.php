<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="{{ asset('build/assets/app.665f89a5.css') }}" />
</head>

<body class="border-top-wide border-primary d-flex flex-column bg-default">
    <div class="page page-center">
        <div class="container-tight py-4">
            <div class="text-center mb-2">
                <a href="{{ config('app.url') }}" class="navbar-brand navbar-brand-autodark">
                    <img src="{{ asset('assets/img/logo-dark.png') }}" height="50" alt="" />
                </a>
            </div>
            @yield('content')
        </div>
    </div>
    @vite('resources/js/app.js')
</body>

</html>
