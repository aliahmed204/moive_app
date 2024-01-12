<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 5, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 5 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 5, SASS and PUG.js. It's fully customizable and modular.">
    <title>@yield('title','Admin')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{--meta csrf--}}
    <meta name="csrf-token" content="{{csrf_token()}}">

    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard')}}/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link rel="stylesheet" href="{{asset('dashboard')}}/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('dashboard')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('dashboard')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('dashboard')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset('dashboard')}}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('dashboard')}}/plugins/select2/css/select2.min.css">

    <!-- Magnific-Popup -->
    <link rel="stylesheet" href="{{asset('dashboard')}}/plugins/Magnific-Popup-master/dist/magnific-popup.css">

    <style>
        .loader {
            -webkit-animation: spin 2s linear infinite; /* Safari */
            animation: spin 2s linear infinite;
        }

        .loader-sm{
            border: 5px solid #f3f3f3;
            border-radius: 50%;
            border-top: 5px solid #009688;
            width: 40px;
            height: 40px;
        }

        .loader-md{
            border: 8px solid #f3f3f3;
            border-radius: 50%;
            border-top: 8px solid #009688;
            width: 90px;
            height: 90px;
        }
        /* Safari */
        @-webkit-keyframes spin {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        a{
            text-decoration:none;
        }

    </style>

    @stack('css')

</head>
<body class="app sidebar-mini">
