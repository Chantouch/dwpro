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
<div class="wrapper-page">
    <div class=" card-box">
        <div class="panel-heading">
            <h3 class="text-center"> Sign In to .
                <strong class="text-custom">{{ config('app.name', 'Laravel') }}</strong>
            </h3>
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
        <div class="panel-body">
            <form class="form-horizontal m-t-20" role="form" method="POST" action="{{ route('employee.login.post') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label"></label>
                    <div class="col-md-12">
                        <input id="email" type="email" class="form-control" name="email"
                               value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="control-label"></label>
                    <div class="col-md-12">
                        <input id="password" type="password" class="form-control" name="password" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group ">
                    <div class="col-xs-12">
                        <div class="checkbox checkbox-primary">
                            <input id="checkbox-signup" type="checkbox"
                                   name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="checkbox-signup">
                                Remember me
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="submit">Log
                            In
                        </button>
                    </div>
                </div>

                <div class="form-group m-t-20 m-b-0">
                    <div class="col-sm-12">
                        <a href="{{ route('password.request') }}" class="text-dark">
                            <i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                    </div>
                </div>

                <div class="form-group m-t-20 m-b-0">
                    <div class="col-sm-12 text-center">
                        <h4><b>Sign in with</b></h4>
                    </div>
                </div>

                <div class="form-group m-b-0 text-center">
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-facebook waves-effect waves-light m-t-20">
                            <i class="fa fa-facebook m-r-5"></i> Facebook
                        </button>

                        <button type="button" class="btn btn-twitter waves-effect waves-light m-t-20">
                            <i class="fa fa-twitter m-r-5"></i> Twitter
                        </button>

                        <button type="button" class="btn btn-googleplus waves-effect waves-light m-t-20">
                            <i class="fa fa-google-plus m-r-5"></i> Google+
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 text-center">
            <p>Don't have an account? <a href="{!! route('employee.register') !!}" class="text-primary m-l-5"><b>Sign Up</b></a></p>
        </div>
    </div>
</div>
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
</body>
</html>