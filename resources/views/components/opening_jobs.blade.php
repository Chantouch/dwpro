{{--@if(Request::segment(2) == "search")--}}
{{--<div id="job-opening">--}}
{{--<div class="job-opening-top"><!-- job opening carousel nav -->--}}
{{--<div class="job-oppening-title">TOP JOB OPENING</div>--}}
{{--<div class="job-opening-nav">--}}
{{--<a class="btn prev"></a>--}}
{{--<a class="btn next"></a>--}}
{{--<div class="clearfix"></div>--}}
{{--</div>--}}
{{--</div><!-- job opening carousel nav -->--}}
{{--<div class="clearfix"></div>--}}
{{--<br/>--}}
{{--<div id="job-listing-carousel" class="owl-carousel"><!-- job opening carousel item -->--}}
{{--@foreach($top_jobs as $post)--}}
{{--<div class="item-listing">--}}
{{--<div class="job-opening">--}}
{{--<a href="{!! route('jobs.view.by.company', [$post->employer->slug]) !!}"--}}
{{--title="{!! $post->employer->organization_name !!}" target="_blank">--}}
{{--@if($post->employer->photo == 'default.jpg')--}}
{{--<img src="{!!asset('uploads/employers/'.$post->employer->photo)!!}"--}}
{{--class="img-responsive"--}}
{{--alt="{!! $post->employer->organization_name !!}"/>--}}
{{--@else--}}
{{--<img src="{!!asset($post->employer->path.$post->employer->photo)!!}"--}}
{{--class="img-responsive"--}}
{{--alt="{!! $post->employer->organization_name !!}"/>--}}
{{--@endif--}}
{{--</a>--}}
{{--<div class="job-opening-content">--}}
{{--<a href="{!! route('jobs.view.name', [$post->employer->slug, $post->industry->slug , $post->id,$post->slug]) !!}"--}}
{{--target="_blank"--}}
{{--title="{!! $post->post_name!!} at {!! $post->employer->organization_name !!}">{!! $post->post_name!!}</a>--}}
{{--<p>--}}
{{--{!! \Illuminate\Support\Str::limit($post->description, 100) !!}--}}
{{--</p>--}}
{{--</div>--}}
{{--<div class="job-opening-meta clearfix">--}}
{{--<div class="meta-job-location meta-block">--}}
{{--<i class="fa fa-map-marker"></i>--}}
{{--<a href="{!! route('jobs.view.by.city', [$post->city->slug]) !!}"--}}
{{--title="{!!$post->city->name !!}" target="_blank">{!!$post->city->name !!}</a>--}}
{{--</div>--}}
{{--<div class="meta-job-type meta-block">--}}
{{--<i class="fa fa-user"></i> {!!$post->job_type!!}--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--@endforeach--}}
{{--</div><!-- job opening carousel item -->--}}
{{--</div>--}}
{{--@else--}}
{{----}}
{{--@endif--}}

<div id="job-opening">
    <div class="job-opening-top">
        <div class="job-oppening-title">Top Job Opening</div>
        <div class="job-opening-nav">
            <a class="btn prev"></a>
            <a class="btn next"></a>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="clearfix"></div>
    <br/>
    <div id="job-opening-carousel" class="owl-carousel">
        @foreach ($feature_posts as $post)
            <div class="item-home">
                <div class="job-opening">
                    <a href="#" title="#" target="_blank">
                        @if($post->employee->company_profile->logo_photo != null)
                            <img src="{!! asset( $post->employee->company_profile->photo_path.'800x385/'.$post->employee->company_profile->logo_photo ) !!}"
                                 class="img-responsive"
                                 alt="{!! $post->employee->company_profile->name !!}"/>
                        @else
                            <img src="{!!asset('images/upload/dummy-job-open-1.png')!!}"
                                 class="img-responsive" alt="Default alternative"/>
                        @endif
                    </a>
                    <div class="job-opening-content">
                        <a href="{!! route('home.view.job',[$post->hashid,$post->employee->company_profile->slug,$post->industry->slug,$post->slug]) !!}"
                           target="_blank"
                           title="{!! $post->name !!} at {!! Helper::relationship($post->employee->company_profile) !!}">
                            {!! $post->name !!}
                        </a>
                        <p>
                            {!! str_limit($post->job_description, 120) !!}
                        </p>
                    </div>
                    <div class="job-opening-meta clearfix">
                        <div class="meta-job-location meta-block">
                            <i class="fa fa-map-marker"></i>
                            <a href="{!! route('jobs.view.by.city',[$post->city->slug]) !!}" title="{!! Helper::relationship($post->city) !!}" target="_blank">
                                {!! Helper::relationship($post->city) !!}
                            </a>
                        </div>
                        <div class="meta-job-type meta-block">
                            <i class="fa fa-user"></i>
                            {!! Helper::relationship($post->contract_type) !!} </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>