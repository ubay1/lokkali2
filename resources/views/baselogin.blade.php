<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">

    <title>Lokkali</title>

    <!-- Bootstrap-->
     <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/BS/css/bootstrap.min.css') }} ">

        <!-- JS -->
        <script type="text/javascript" src="{{ asset('assets/BS/js/jquery.min.js') }} "></script>
        <script type="text/javascript" src="{{ asset('assets/BS/js/popper.min.js') }} "></script>
        <script type="text/javascript" src="{{ asset('assets/BS/js/bootstrap.min.js') }} "></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        {{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script> --}}

    {{-- end --}}

        <!-- Main Styles CSS -->
        <style>
            html{
                padding: 0;
                margin: 0;
                background-image: url('../assets/img/login2.png');
                background-position: center;
                background-position-x: center;
                background-position-y: bottom;
                background-size: cover;
                height: 100%;
            }
            body{
                background: transparent;
            }
            .bg-form-login{
                margin: 120px auto;
                width: 30em;
                background: rgba(250,250,250,1);
                padding: 20px;
                border-radius: 10px;
            }

        </style>

</head>

<body>

    @yield('content') {{-- Semua file konten kita akan ada di bagian ini --}}

</body>

</html>
