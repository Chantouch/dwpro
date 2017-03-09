<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{!! asset('assets/images/favicon_1.ico') !!}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" id="token">
    <title>{{ config('app.name', 'Digital Work Pro') }} | @yield('title')</title>
    <!-- Styles -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    <link href="{!! asset('assets/css/bootstrap.min.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('assets/css/core.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('assets/css/components.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('assets/css/icons.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('assets/css/pages.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('assets/css/responsive.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('assets/plugins/toastr/toastr.min.css') !!}" rel="stylesheet">

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    @yield('styles')
    <script src="{!! asset('assets/js/modernizr.min.js') !!}"></script>

    {{--<script>--}}
    {{--(function (i, s, o, g, r, a, m) {--}}
    {{--i['GoogleAnalyticsObject'] = r;--}}
    {{--i[r] = i[r] || function () {--}}
    {{--(i[r].q = i[r].q || []).push(arguments)--}}
    {{--}, i[r].l = 1 * new Date();--}}
    {{--a = s.createElement(o),--}}
    {{--m = s.getElementsByTagName(o)[0];--}}
    {{--a.async = 1;--}}
    {{--a.src = g;--}}
    {{--m.parentNode.insertBefore(a, m)--}}
    {{--})(window, document, 'script', '../../../www.google-analytics.com/analytics.js', 'ga');--}}

    {{--ga('create', 'UA-69506598-1', 'auto');--}}
    {{--ga('send', 'pageview');--}}
    {{--</script>--}}

    {{--<link href="{!! asset('css/app.css') !!}" rel="stylesheet" type="text/css"/>--}}

</head>

<body class="fixed-left">
<div id="app">

{{--<div class="animationload">--}}
{{--<div class="loader"></div>--}}
{{--</div>--}}

<!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        <div class="topbar">

            <!-- LOGO -->
            <div class="topbar-left">
                <div class="text-center">
                    <a href="index-2.html" class="logo"><i class="icon-magnet icon-c-logo"></i><span>Ub<i
                                    class="md md-album"></i>ld</span></a>
                </div>
            </div>

            <!-- Button mobile view to collapse sidebar menu -->
            <div class="navbar navbar-default" role="navigation">
                <div class="container">
                    <div class="">
                        <div class="pull-left">
                            <button class="button-menu-mobile open-left">
                                <i class="ion-navicon"></i>
                            </button>
                            <span class="clearfix"></span>
                        </div>

                        <form role="search" class="navbar-left app-search pull-left hidden-xs">
                            <input type="text" placeholder="Search..." class="form-control">
                            <a href="#"><i class="fa fa-search"></i></a>
                        </form>


                        <ul class="nav navbar-nav navbar-right pull-right">
                            <li class="dropdown hidden-xs">
                                <a href="#" data-target="#" class="dropdown-toggle waves-effect" data-toggle="dropdown"
                                   aria-expanded="true">
                                    <i class="icon-bell"></i> <span class="badge badge-xs badge-danger">3</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-lg">
                                    <li class="notifi-title"><span class="label label-default pull-right">New 3</span>Notification
                                    </li>
                                    <li class="list-group nicescroll notification-list">
                                        <!-- list item-->
                                        <a href="javascript:void(0);" class="list-group-item">
                                            <div class="media">
                                                <div class="pull-left p-r-10">
                                                    <em class="fa fa-diamond fa-2x text-primary"></em>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="media-heading">A new order has been placed A new order
                                                        has
                                                        been placed</h5>
                                                    <p class="m-0">
                                                        <small>There are new settings available</small>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>

                                        <!-- list item-->
                                        <a href="javascript:void(0);" class="list-group-item">
                                            <div class="media">
                                                <div class="pull-left p-r-10">
                                                    <em class="fa fa-cog fa-2x text-custom"></em>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="media-heading">New settings</h5>
                                                    <p class="m-0">
                                                        <small>There are new settings available</small>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>

                                        <!-- list item-->
                                        <a href="javascript:void(0);" class="list-group-item">
                                            <div class="media">
                                                <div class="pull-left p-r-10">
                                                    <em class="fa fa-bell-o fa-2x text-danger"></em>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="media-heading">Updates</h5>
                                                    <p class="m-0">
                                                        <small>There are <span class="text-primary font-600">2</span>
                                                            new
                                                            updates available
                                                        </small>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>

                                        <!-- list item-->
                                        <a href="javascript:void(0);" class="list-group-item">
                                            <div class="media">
                                                <div class="pull-left p-r-10">
                                                    <em class="fa fa-user-plus fa-2x text-info"></em>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="media-heading">New user registered</h5>
                                                    <p class="m-0">
                                                        <small>You have 10 unread messages</small>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>

                                        <!-- list item-->
                                        <a href="javascript:void(0);" class="list-group-item">
                                            <div class="media">
                                                <div class="pull-left p-r-10">
                                                    <em class="fa fa-diamond fa-2x text-primary"></em>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="media-heading">A new order has been placed A new order
                                                        has
                                                        been placed</h5>
                                                    <p class="m-0">
                                                        <small>There are new settings available</small>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>

                                        <!-- list item-->
                                        <a href="javascript:void(0);" class="list-group-item">
                                            <div class="media">
                                                <div class="pull-left p-r-10">
                                                    <em class="fa fa-cog fa-2x text-custom"></em>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="media-heading">New settings</h5>
                                                    <p class="m-0">
                                                        <small>There are new settings available</small>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="list-group-item text-right">
                                            <small class="font-600">See all notifications</small>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="hidden-xs">
                                <a href="#" id="btn-fullscreen" class="waves-effect"><i
                                            class="icon-size-fullscreen"></i></a>
                            </li>
                            <li class="hidden-xs">
                                <a href="#" class="right-bar-toggle waves-effect"><i class="icon-settings"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle profile waves-effect" data-toggle="dropdown"
                                   aria-expanded="true"><img src="{!! asset('assets/images/users/avatar-1.jpg') !!}"
                                                             alt="user-img"
                                                             class="img-circle"> </a>
                                <ul class="dropdown-menu">
                                    <li><a href="javascript:void(0)"><i class="ti-user m-r-5"></i> Profile</a></li>
                                    <li><a href="javascript:void(0)"><i class="ti-settings m-r-5"></i> Settings</a></li>
                                    <li><a href="javascript:void(0)"><i class="ti-lock m-r-5"></i> Lock screen</a></li>
                                    <li>
                                        @if(Auth::guard('admin')->check())
                                            <a href="{{ route('admin.logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                <i class="ti-power-off m-r-5"></i> Logout
                                            </a>
                                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                                  style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        @endif
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <!-- Top Bar End -->


        <!-- ========== Left Sidebar Start ========== -->

        <div class="left side-menu">
            <div class="sidebar-inner slimscrollleft">
                <!--- Divider -->
                <div id="sidebar-menu">
                    @include('layouts.admin_menu')
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">
                    <!-- Page-Title -->
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="page-title">Blank Page</h4>
                            <ol class="breadcrumb">
                                <li>
                                    <a href="#">Ubold</a>
                                </li>
                                <li>
                                    <a href="#">Pages</a>
                                </li>
                                <li class="active">
                                    Blank Page
                                </li>
                            </ol>
                        </div>
                        <div class="col-sm-12">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </div>
                        @yield('content')
                    </div>
                </div> <!-- container -->

            </div> <!-- content -->

            <footer class="footer">
                2015 © Ubold.
            </footer>

        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->


        <!-- Right Sidebar -->
    {{--<div class="side-bar right-bar nicescroll">--}}
    {{--<h4 class="text-center">Chat</h4>--}}
    {{--<div class="contact-list nicescroll">--}}
    {{--<ul class="list-group contacts-list">--}}
    {{--<li class="list-group-item">--}}
    {{--<a href="#">--}}
    {{--<div class="avatar">--}}
    {{--<img src="assets/images/users/avatar-1.jpg" alt="">--}}
    {{--</div>--}}
    {{--<span class="name">Chadengle</span>--}}
    {{--<i class="fa fa-circle online"></i>--}}
    {{--</a>--}}
    {{--<span class="clearfix"></span>--}}
    {{--</li>--}}
    {{--<li class="list-group-item">--}}
    {{--<a href="#">--}}
    {{--<div class="avatar">--}}
    {{--<img src="assets/images/users/avatar-2.jpg" alt="">--}}
    {{--</div>--}}
    {{--<span class="name">Tomaslau</span>--}}
    {{--<i class="fa fa-circle online"></i>--}}
    {{--</a>--}}
    {{--<span class="clearfix"></span>--}}
    {{--</li>--}}
    {{--<li class="list-group-item">--}}
    {{--<a href="#">--}}
    {{--<div class="avatar">--}}
    {{--<img src="assets/images/users/avatar-3.jpg" alt="">--}}
    {{--</div>--}}
    {{--<span class="name">Stillnotdavid</span>--}}
    {{--<i class="fa fa-circle online"></i>--}}
    {{--</a>--}}
    {{--<span class="clearfix"></span>--}}
    {{--</li>--}}
    {{--<li class="list-group-item">--}}
    {{--<a href="#">--}}
    {{--<div class="avatar">--}}
    {{--<img src="assets/images/users/avatar-4.jpg" alt="">--}}
    {{--</div>--}}
    {{--<span class="name">Kurafire</span>--}}
    {{--<i class="fa fa-circle online"></i>--}}
    {{--</a>--}}
    {{--<span class="clearfix"></span>--}}
    {{--</li>--}}
    {{--<li class="list-group-item">--}}
    {{--<a href="#">--}}
    {{--<div class="avatar">--}}
    {{--<img src="assets/images/users/avatar-5.jpg" alt="">--}}
    {{--</div>--}}
    {{--<span class="name">Shahedk</span>--}}
    {{--<i class="fa fa-circle away"></i>--}}
    {{--</a>--}}
    {{--<span class="clearfix"></span>--}}
    {{--</li>--}}
    {{--<li class="list-group-item">--}}
    {{--<a href="#">--}}
    {{--<div class="avatar">--}}
    {{--<img src="assets/images/users/avatar-6.jpg" alt="">--}}
    {{--</div>--}}
    {{--<span class="name">Adhamdannaway</span>--}}
    {{--<i class="fa fa-circle away"></i>--}}
    {{--</a>--}}
    {{--<span class="clearfix"></span>--}}
    {{--</li>--}}
    {{--<li class="list-group-item">--}}
    {{--<a href="#">--}}
    {{--<div class="avatar">--}}
    {{--<img src="assets/images/users/avatar-7.jpg" alt="">--}}
    {{--</div>--}}
    {{--<span class="name">Ok</span>--}}
    {{--<i class="fa fa-circle away"></i>--}}
    {{--</a>--}}
    {{--<span class="clearfix"></span>--}}
    {{--</li>--}}
    {{--<li class="list-group-item">--}}
    {{--<a href="#">--}}
    {{--<div class="avatar">--}}
    {{--<img src="assets/images/users/avatar-8.jpg" alt="">--}}
    {{--</div>--}}
    {{--<span class="name">Arashasghari</span>--}}
    {{--<i class="fa fa-circle offline"></i>--}}
    {{--</a>--}}
    {{--<span class="clearfix"></span>--}}
    {{--</li>--}}
    {{--<li class="list-group-item">--}}
    {{--<a href="#">--}}
    {{--<div class="avatar">--}}
    {{--<img src="assets/images/users/avatar-9.jpg" alt="">--}}
    {{--</div>--}}
    {{--<span class="name">Joshaustin</span>--}}
    {{--<i class="fa fa-circle offline"></i>--}}
    {{--</a>--}}
    {{--<span class="clearfix"></span>--}}
    {{--</li>--}}
    {{--<li class="list-group-item">--}}
    {{--<a href="#">--}}
    {{--<div class="avatar">--}}
    {{--<img src="assets/images/users/avatar-10.jpg" alt="">--}}
    {{--</div>--}}
    {{--<span class="name">Sortino</span>--}}
    {{--<i class="fa fa-circle offline"></i>--}}
    {{--</a>--}}
    {{--<span class="clearfix"></span>--}}
    {{--</li>--}}
    {{--</ul>--}}
    {{--</div>--}}
    {{--</div>--}}
    <!-- /Right-bar -->
    </div>
    <!-- END wrapper -->
</div>

<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="{!! asset('assets/js/jquery.min.js') !!}"></script>
<script src="{!! asset('assets/js/bootstrap.min.js') !!}"></script>
<script src="{!! asset('assets/js/detect.js') !!}"></script>
<script src="{!! asset('assets/js/fastclick.js') !!}"></script>
<script src="{!! asset('assets/js/jquery.slimscroll.js') !!}"></script>
<script src="{!! asset('assets/js/jquery.blockUI.js') !!}"></script>
<script src="{!! asset('assets/js/waves.js') !!}"></script>
<script src="{!! asset('assets/js/wow.min.js') !!}"></script>
<script src="{!! asset('assets/js/jquery.nicescroll.js') !!}"></script>
<script src="{!! asset('assets/js/jquery.scrollTo.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('assets/plugins/toastr/toastr.min.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/vuejs/vue.js') !!}"></script>
<script src="{!! asset('js/vuejs/vue-resource.min.js') !!}"></script>
@stack('src-scripts')
<script src="{!! asset('js/vuejs/vue-axios.min.js') !!}"></script>
@yield('scripts')
<script src="{!! asset('assets/js/jquery.core.js') !!}"></script>
<script src="{!! asset('assets/js/jquery.app.js') !!}"></script>
<script src="{!! asset('js/apps.js') !!}"></script>
<script src="{!! asset('assets/plugins/moment/moment.min.js') !!}"></script>
@stack('plugins')
</body>
</html>