@extends('layouts.front.default')
@section('title', 'Jobs Result of Searching')
@section('page_specific_styles')
    <link href="{{ asset('plugins/animate/animate.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{!! asset('plugins/ion-range-slider/css/ion.rangeSlider.css') !!}">
    <link rel="stylesheet" href="{!! asset('plugins/ion-range-slider/css/ion.rangeSlider.skinFlat.css') !!}">
@stop
@section('contents')
    <!-- start job finder -->
    @include('components.search')
    <!-- end job finder -->
    <div class="recent-job">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h4>
                        <i class="glyphicon glyphicon-briefcase"></i>
                        We found {!! count($jobs) !!} Job(s)
                    </h4>
                    <div id="tab-container" class='tab-container'><!-- Start Tabs -->
                        <ul class='etabs clearfix'>
                            <li class='tab'><a href="#all">All Jobs Matches</a></li>
                            {{--<li class='tab'><a href="#full">Full Time</a></li>--}}
                            {{--<li class='tab'><a href="#part_time">Part Time</a></li>--}}
                            {{--<li class='tab'><a href="#contract">Contract</a></li>--}}
                            {{--<li class='tab'><a href="#internship">Internship</a></li>--}}
                        </ul>
                        <div class='panel-container'>
                            <div id="all"><!-- Tabs section 1 -->
                                @if(count($jobs) >= 1)
                                    @foreach($jobs as $post)
                                        <div class="recent-job-list-home">
                                            <div class="job-list-logo col-md-1 ">
                                                @if($post->employee->company_profile->logo_photo != null)
                                                    <img src="{!! asset( $post->employee->company_profile->photo_path.'787x787/'.$post->employee->company_profile->logo_photo ) !!}"
                                                         class="img-responsive"
                                                         alt="{!! $post->employee->company_profile->name !!}"/>
                                                @else
                                                    <img src="{!! asset('uploads/employers/default.jpg') !!}"
                                                         class="img-responsive" alt="Default alternative"/>
                                                @endif
                                            </div>
                                            <div class="col-md-5 job-list-desc">
                                                <h6>{!! $post->name !!}</h6>
                                                <p>{!! str_limit($post->job_description, 40) !!}</p>
                                            </div>
                                            <div class="col-md-6 full">
                                                <div class="job-list-location col-md-5">
                                                    <h6>
                                                        <i class="fa fa-map-marker"></i>{!! str_limit(Helper::relationship($post->city), 15) !!}
                                                    </h6>
                                                </div>
                                                <div class="job-list-type col-md-4 ">
                                                    <h6>
                                                        <i class="fa fa-user"></i>{!! Helper::relationship($post->contract_type) !!}
                                                    </h6>
                                                </div>
                                                <div class="col-md-3 job-list-button">
                                                    <h6 class="pull-right">
                                                        <a href="{!! route('home.view.job',[$post->hashid,$post->employee->company_profile->slug,$post->industry->slug,$post->slug]) !!}"
                                                           class="btn-view-job">View</a>
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    @endforeach
                                @else
                                    <span>There is no job match</span>
                                @endif

                                {!! $jobs->render() !!}

                            </div><!-- Tabs section 1 -->

                            {{--<div id="contract"><!-- Tabs section 2 -->--}}
                            {{----}}
                            {{--</div><!-- Tabs section 2 -->--}}

                            {{--<div id="full"><!-- Tabs section 3 -->--}}
                            {{----}}
                            {{--</div><!-- Tabs section 3 -->--}}

                            {{--<div id="part_time"><!-- Tabs section 4 -->--}}
                            {{----}}
                            {{--</div><!-- Tabs section 4 -->--}}

                            {{--<div id="internship">
                            <!-- Tabs section 5 -->--}}
                            {{----}}
                            {{--</div><!-- Tabs section 5 -->--}}

                        </div>
                    </div><!-- end Tabs -->
                    <div class="spacer-2"></div>
                </div>
                {{--Top job opening--}}
                <div class="col-md-4">
                    @include('components.opening_jobs')
                    <div class="post-resume-title">Post Your Resume</div>
                    <div class="post-resume-container">
                        {{--<button type="button" class="post-resume-button">Upload Your Resume--}}
                        {{--<i class="icon-upload grey"></i></button>--}}
                        <a href="#" class="post-resume-button text-center">Upload Your Resume
                            <i class="icon-upload grey"></i></a>
                    </div>
                </div>
                {{--Top job opening--}}
            </div>
        </div>
    </div><!-- end Job -->

    <!-- Start page content -->
    @include('front.jobs.page-content')
    <!--End page content -->

    <!-- Feature Search -->
    @include('front.jobs.feature-search')
    <!--End Feature search -->

@stop



@section('page_specific_js')

    <script src="{{ asset('plugins/typeahead/bootstrap3-typeahead.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('plugins/wow/wow.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('plugins/ion-range-slider/js/ion.rangeSlider.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript">

    </script>
@stop

@section('page_specific_scripts')

    $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    {{--var path = "{!! route('job.search.name') !!}";--}}
    {{--var city_path = "{!! route('job.search.city') !!}";--}}
    $('#searchjob').typeahead({
    source: function (query, process) {
    return $.get(path, {query: query}, function (data) {
    return process(data);
    })
    }
    });

    $('#searchplace').typeahead({
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
    max: 5000,
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

@stop
