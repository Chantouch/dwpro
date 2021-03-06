<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" id="token">
    <title>@yield('title') &#8226; {{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <!-- Bootstrap 3.3.4 -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Main Style -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Main Style -->
    <!-- noty cross briser animate css -->
    <link href="{{ asset('assets/plugins/noty/animate.css') }}" rel="stylesheet" type="text/css"/>
    <!-- fonts -->
    <link href="{{ asset('font-awesome/4.4.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href='https://fonts.googleapis.com/css?family=Nunito:300,400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,300,500,600,700' rel='stylesheet' type='text/css'>
    <!-- fonts -->
    <!-- Owl Carousel -->
    <link href="{{ asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/owl-carousel/owl.theme.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/owl-carousel/owl.transitions.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Owl Carousel -->
    <!-- Form Slider -->
    <link href="{{ asset('assets/plugins/form-slider/jslider.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/form-slider/jslider.round.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Form Slider -->
    <link href="{{ asset('css/jcolabs.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{!! asset('css/select.css') !!}"/>
    <link rel="stylesheet" type="text/css" href="{!! asset('css/skin-elastic.css') !!}"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="{{ asset('assets/plugins/animate.less/animate.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Select2 -->
    <link rel="stylesheet" href="{!! asset('assets/plugins/select2/select2.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/plugins/ion-range-slider/css/ion.rangeSlider.css') !!}">
    <link rel="stylesheet" href="{!! asset('assets/plugins/ion-range-slider/css/ion.rangeSlider.skinFlat.css') !!}">
    @yield('page_specific_styles')
</head>
<body>
<div id="wrapper"><!-- start main wrapper -->
    <div id="header"><!-- start main header -->
        @include('layouts.front.header')
    </div><!-- end main header -->
    @yield('contents')
    <div class="main-page-title"><!-- start main page title -->
        <div class="container">
            @if (Session::has('alert'))
                <div class="alert alert-warning alert-dismissable job-alert alert-red">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        <i class="fa fa-times-circle"></i></button>
                    {!! Session::get('alert') !!}
                </div>
            @endif
            @yield('main_page_container')
        </div>
    </div><!-- end main page title -->
    <div id="page-content">
        @yield('page_content')
        <div class="content-about">
            <div id="cs">
                <div class="container">
                    <div class="spacer-1">&nbsp;</div>
                    <h1>Hey Friends Any Quries?</h1>
                    <p>
                        At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                        deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non
                        provident, similique sunt.
                    </p>
                    <h1 class="phone-cs">Call: 070 375 783</h1>
                </div>
            </div>
        </div>
    </div>
    <div id="footer"><!-- Footer -->
        @include('layouts.front.footer')
    </div><!-- Footer -->
</div><!-- end main wrapper -->
<!-- jQuery 2.1.4 -->
<script src="{{ asset('assets/js/jquery.min.js')}}" type="text/javascript"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
<!-- noty -->
<script type="text/javascript" src="{{ asset('assets/plugins/noty/packaged/jquery.noty.packaged.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/noty/themes/bootstrap.js')}}"></script>
<!-- Tabs -->
<script src="{{ asset('assets/plugins/easytabs/jquery.easytabs.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/easytabs/modernizr.custom.49511.js')}}" type="text/javascript"></script>
<!-- Tabs -->
<!-- Owl Carousel -->
<script src="{{ asset('assets/plugins/owl-carousel/owl.carousel.js')}}" type="text/javascript"></script>
<!-- Owl Carousel -->
<!-- Form Slider -->
<script src="{{ asset('assets/plugins/form-slider/jshashtable-2.1_src.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/form-slider/jquery.numberformatter-1.2.3.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/form-slider/tmpl.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/form-slider/jquery.dependClass-0.1.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/form-slider/draggable-0.1.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/form-slider/jquery.slider.js')}}" type="text/javascript"></script>
<!-- Form Slider -->
<!-- Map -->
<script src="https://maps.googleapis.com/maps/api/js"></script>
<!-- Map -->
<script src="{{ asset('js/dwpro.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/main.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/jcolabs.js')}}" type="text/javascript"></script>
<script src="{!! asset('js/classie.js') !!}"></script>
<script src="{!! asset('js/selectFx.js') !!}"></script>
<script type="text/javascript" src="{!! asset('js/vuejs/vue.js') !!}"></script>
<script src="{!! asset('js/vuejs/vue-resource.min.js') !!}"></script>
<script src="{!! asset('js/apps.js') !!}"></script>
@yield('page_specific_js')
<script src="{{ asset('assets/plugins/typeahead/bootstrap3-typeahead.min.js')}}" type="text/javascript"></script>
<!-- Select2 -->
<script src="{!! asset('assets/plugins/select2/select2.full.js') !!}"></script>
<script src="{{ asset('assets/plugins/wow/wow.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/ion-range-slider/js/ion.rangeSlider.min.js')}}"
        type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        @yield('page_specific_scripts')

        @if (Session::has('error'))
            notify('{!! Session::get('error')!!}', 'error', 'topCenter');
        @endif
        @if (Session::has('message') && !$errors->any())
            notify('{!! Session::get('message')!!}', 'success', 'topCenter');
                @endif
                @if ($errors->any())
                {!! implode('', $errors->all('notify(\':message\', \'warning\'); ')) !!}
                @endif

        var path = "";
        var city_path = "";
        $('#name').typeahead({
            source: function (query, process) {
                return $.get(path, {query: query}, function (data) {
                    return process(data);
                })
            }
        });

        $('#city').typeahead({
            source: function (query, process) {
                return $.get(city_path, {city: query}, function (data) {
                    return process(data);
                })
            }
        });

        $("#salary_search").ionRangeSlider({
            type: "single",
            grid: true,
            min: 0,
            max: 3000,
            prefix: "$",
            values: [0, 50, 100, 200, 300, 400, 500, 600, 700, 800, 900, 1000, 1500, 2000, 3000]
        });

        $("#experiences_search").ionRangeSlider({
            type: "single",
            grid: true,
            min: 0,
            max: 10,
            prefix: "Y",
            values: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
        });

        new WOW().init();
    });
</script>

<script src="https://apis.google.com/js/platform.js"></script>

<script>
    function onYtEvent(payload) {
        if (payload.eventType === "subscribe") {
            // Add code to handle subscribe event.
        } else if (payload.eventType === 'unsubscribe') {
            // Add code to handle unsubscribe event.
        }
        if (window.console) { // for debugging only
            window.console.log('YT event: ', payload);
        }
    }

    (function () {
        [].slice.call(document.querySelectorAll('select.cs-select')).forEach(function (el) {
            new SelectFx(el);
        });
    })();

</script>

</body>
</html>
