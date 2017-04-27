<div class="item-listing">
    <div class="job-opening">
        @if($post->employee->company_profile->logo_photo != null)
            <img src="{!! asset( $post->employee->company_profile->photo_path.'800x385/'.$post->employee->company_profile->logo_photo ) !!}"
                 class="img-responsive"
                 alt="{!! $post->employee->company_profile->name !!}"/>
        @else
            <img src="{!! asset('images/upload/dummy-job-open-2.png') !!}"
                 class="img-responsive" alt="Default alternative"/>
        @endif
        <div class="job-opening-content">
            <h6>
                <a target="_blank" href="{!! route('home.view.job',[$post->hashid,$post->employee->company_profile->slug,$post->industry->slug,$post->slug]) !!}">
                    {!! $post->name !!}
                </a>
            </h6>
            <p>
                {!! str_limit($post->job_description, 130) !!}
            </p>
        </div>
        <div class="job-opening-meta clearfix">
            <div class="meta-job-location meta-block">
                <i class="fa fa-map-marker"></i>
                <a href="{!! route('jobs.view.by.city',[$post->city->slug]) !!}"
                   title="{!! Helper::relationship($post->city) !!}" target="_blank">
                    {!! str_limit(Helper::relationship($post->city),15) !!}
                </a>
            </div>
            <div class="meta-job-type meta-block">
                <i class="fa fa-user"></i>
                <a href="{!! route('jobs.view.by.contract_term',[$post->contract_type->slug]) !!}"
                   title="{!! Helper::relationship($post->contract_type) !!}" target="_blank">
                    {!! str_limit(Helper::relationship($post->contract_type),10) !!}
                </a>
            </div>
        </div>
    </div>
</div><!-- job opening carousel item -->