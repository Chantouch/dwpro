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
                <i class="fa fa-map-marker"></i>
                <a href="{!! route('jobs.view.by.city',[$post->city->slug]) !!}"
                   title="{!! Helper::relationship($post->city) !!}" target="_blank">
                    {!! str_limit(Helper::relationship($post->city),15) !!}
                </a>
            </h6>
        </div>
        <div class="job-list-type col-md-4 ">
            <h6>
                <i class="fa fa-user"></i>
                <a href="{!! route('jobs.view.by.contract_term',[$post->contract_type->slug]) !!}"
                   title="{!! Helper::relationship($post->contract_type) !!}" target="_blank">
                    {!! str_limit(Helper::relationship($post->contract_type),10) !!}
                </a>
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