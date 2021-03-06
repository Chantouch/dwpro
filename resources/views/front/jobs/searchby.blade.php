@extends('layouts.front.default')

@section('page_specific_styles')

@stop

@section('contents')
    <!-- start job finder -->
    @include('components.search')
    <!-- end job finder -->
    <div class="recent-job"><!-- Start Job -->
        <div class="container">
            <h4><i class="glyphicon glyphicon-briefcase"></i> JOBS</h4>
            <div id="tab-container" class='tab-container'>
                <ul class='etabs clearfix'>
                    <li class='tab'><a href="#all">All</a></li>
                    @foreach($contract_terms as $contract_term)
                        <li class='tab'>
                            <a href="#{!! $contract_term->slug !!}">{!! $contract_term->name !!}</a>
                        </li>
                    @endforeach
                </ul>
                <div class='panel-container'>
                    <div id="all">
                        @if(count($posts))
                            @foreach($posts as $post)
                                <div class="recent-job-list-home">
                                    <div class="job-list-logo col-md-1">
                                        <img src="{!! asset('images/upload/company-2-post.png') !!}"
                                             class="img-responsive" alt="srjhfghdgh"/>
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
                            <p>There is not post here.</p>
                        @endif
                    </div>
                    @foreach($contract_terms as $contract_term)
                        <div id="{!! $contract_term->slug !!}">
                            @if(count($posts))
                                @foreach($posts as $post)
                                    @if($post->contract_type_id == $contract_term->id)
                                        <div class="recent-job-list-home">
                                            <div class="job-list-logo col-md-1 ">
                                                <img src="{!! asset('images/upload/company-2-post.png') !!}"
                                                     class="img-responsive" alt="srjhfghdgh"/>
                                            </div>
                                            <div class="col-md-5 job-list-desc">
                                                <h6>{!! $post->name !!}</h6>
                                                <p>{!! str_limit($post->job_description,40) !!}</p>
                                            </div>
                                            <div class="col-md-6 full">
                                                <div class="job-list-location col-md-5">
                                                    <h6>
                                                        <i class="fa fa-map-marker"></i>{!! str_limit(Helper::relationship($post->city),15) !!}
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
                                    @endif
                                @endforeach
                            @else
                                <p>There is not post here.</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            <div id="job-opening">
                <div class="job-opening-top"><!-- job opening carousel nav -->
                    <div class="job-oppening-title">TOP JOB OPENING</div>
                    <div class="job-opening-nav">
                        <a class="btn prev"></a>
                        <a class="btn next"></a>
                        <div class="clearfix"></div>
                    </div>
                </div><!-- job opening carousel nav -->
                <div class="clearfix"></div>
                <br/>
                @if(isset($top_opening_jobs))
                    <div id="job-listing-carousel" class="owl-carousel"><!-- job opening carousel item -->
                        @foreach($top_opening_jobs as $post)
                            @include('front.jobs.top-opening-job')
                        @endforeach
                    </div>
                @endif
            </div>
        </div><!-- end Job -->
        <!-- Start page content -->
    @include('front.jobs.page-content')
    <!-- End page content -->
    </div>
@stop
@section('main_page_container')



@stop
@section('page_content')

@stop
@section('page_specific_js')
    <script type="text/javascript">


    </script>
@stop
@section('page_specific_scripts')

@stop
