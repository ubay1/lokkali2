<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- For Google -->
    <link rel="author" href="https://plus.google.com/+Scoopthemes">
    <link rel="publisher" href="https://plus.google.com/+Scoopthemes">

    <!-- Canonical -->
    <link rel="canonical" href="">

    <title>Lokkali</title>

    <!-- Bootstrap-->
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/BS/css/bootstrap.min.css') }} ">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/mdi/css/mdi.css') }} ">

    <!-- JS -->
    <script type="text/javascript" src="{{ asset('assets/BS/js/jquery.min.js') }} "></script><script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('assets/BS/js/bootstrap.min.js') }} "></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    {{-- end --}}

</head>

<body>

    <div class="maincontainer">
        <div id="header">
            <div id="icon-hamburger">
                <div id="nav1"></div>
                <div id="nav2"></div>
                <div id="nav3"></div>
            </div>

            <a href="{{ url('/admin') }}" class="logo"><span>Lokkali <i class="mdi mdi-clipboard-check"></i></span></a>

            <a class="bg_logout" href="{{ url('admin/logout') }}"><span class="mdi mdi-power mdi-24px"></span></a>
        </div>

        <div id="drawer">
            <div id="bg-img-drawer">
                {{-- <img src="{{ asset('assets/img/login2.png') }}" alt="" id="img-drawer"> --}}
                <div class="bg-fotouser">
                    <img src="{{ asset('assets/img/team1.jpg') }}" alt="" id="fotouser">
                </div>
                <span id="txt_nama">({{Session::get('nama')}})</span>
            </div>
            <a href="{{ url('/admin/kelolaAbout') }}"><span
                    class="mdi mdi-account-multiple-plus mdi-24px icon_listmenu"></span>
                Kelola About Design </a>
            <a href="{{ url('/admin/kelolaVisiMisi') }}"><span
                    class="mdi mdi-checkbox-multiple-marked-circle mdi-24px icon_listmenu"></span>
                Kelola Visi Misi Design </a>

            <div class="dropup" style="margin:10px;">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mdi mdi-comment-check mdi-24px icon_listmenu"></span> Case Study
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a href="{{ url('/admin/kelolaCase') }}"><span class="mdi mdi-comment-check mdi-24px icon_listmenu"></span> Kelola Case Study Design </a>

                    <a href="{{ url('/admin/kelolaCasePopuler') }}"><span class="mdi mdi-comment-check mdi-24px icon_listmenu"></span> Kelola Case Study Design Populer </a>
                </div>
            </div>

            <div class="dropup" style="margin:10px;">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mdi mdi-comment-check mdi-24px icon_listmenu"></span> Blog
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a href="{{ url('/admin/kelolaBlog') }}"><span class="mdi mdi-comment-check mdi-24px icon_listmenu"></span> Kelola BLog Design </a>

                        <a href="{{ url('/admin/kelolaBlogPopuler') }}"><span class="mdi mdi-comment-check mdi-24px icon_listmenu"></span> Kelola BLog Design Populer </a>
                    </div>
            </div>

        </div>

        @yield('content')
    </div>

</body>

</html>
