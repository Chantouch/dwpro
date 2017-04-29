<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" id="token">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <link href="{!! asset('assets/css/bootstrap.min.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('assets/css/core.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('assets/css/components.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('assets/css/icons.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('assets/css/pages.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('assets/css/responsive.css') !!}" rel="stylesheet" type="text/css"/>
    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script src="{!! asset('assets/js/modernizr.min.js') !!}"></script>
    @yield('styles')
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>

<div class="animationload">
    <div class="loader"></div>
</div>

<div class="account-pages"></div>
<div class="clearfix"></div>
@yield('contents')
<script>
    let resizefunc = [];
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
<script src="{!! asset('assets/js/jquery.core.js') !!}"></script>
<script src="{!! asset('assets/js/jquery.app.js') !!}"></script>
@yield('scripts')
</body>
</html>