<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ cb()->getAppName() }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name='generator' content='CRUDBooster'/>
    <meta name='robots' content='noindex,nofollow'/>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{cbAsset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Font Awesome Icons -->
    <link href="{{cbAsset("adminlte/bower_components/font-awesome/css/font-awesome.min.css")}}" rel="stylesheet" type="text/css"/>

    <!-- Theme style -->
    <link href="{{ cbAsset("adminlte/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{ cbAsset("adminlte/dist/css/skins/_all-skins.min.css")}}" rel="stylesheet" type="text/css"/>

    <link rel='stylesheet' href='{{cbAsset("css/main.css")}}'/>

    @stack('head')
</head>
<body class="skin-blue">
<div id='app' class="wrapper">

    <!-- Header -->
    @include('crudbooster::dev_layouts.header')

    <!-- Sidebar -->
    @include('crudbooster::dev_layouts.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                {{ $page_title }}
            </h1>

            <ol class="breadcrumb">
                <li><a href="{{ cb()->getDeveloperUrl() }}"><i class="fa fa-dashboard"></i> {{ __('crudbooster.home') }}</a></li>
                <li class="active">{{ $page_title }}</li>
            </ol>
        </section>


        <!-- Main content -->
        <section id='content_section' class="content">

            @if (session()->has('message'))
                <div class='alert alert-{{ session('message_type') }}'>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-info"></i> {{ trans("crudbooster.alert_".Session::get("message_type")) }}</h4>
                    {!! session('message') !!}
                </div>
            @endif


            <!-- Your Page Content Here -->
            @yield('content')
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <!-- Footer -->
    @include('crudbooster::layouts.footer')

</div><!-- ./wrapper -->

@include('crudbooster::layouts.javascripts')

@stack('bottom')
</body>
</html>
