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
            @foreach($posts as $post)
                <div class="recent-job-list-home">
                    <div class="job-list-logo col-md-1 ">
                        <img src="{!! asset('images/upload/company-2-post.png') !!}"
                             class="img-responsive" alt="srjhfghdgh"/>
                    </div>
                    <div class="col-md-5 job-list-desc">
                        <h6>{!! $post->name !!}</h6>
                        <p>{!! $post->job_description !!}</p>
                    </div>
                    <div class="col-md-6 full">
                        <div class="job-list-location col-md-5">
                            <h6>
                                <i class="fa fa-map-marker"></i>{!! Helper::relationship($post->city) !!}
                            </h6>
                        </div>
                        <div class="job-list-type col-md-4 ">
                            <h6>
                                <i class="fa fa-user"></i>{!! Helper::relationship($post->contract_type) !!}
                            </h6>
                        </div>
                        <div class="col-md-3 job-list-button">
                            <h6 class="pull-right">
                                <a href="#" class="btn-view-job">View</a>
                            </h6>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            @endforeach
        </div>
        @foreach($contract_terms as $contract_term)
            <div id="{!! $contract_term->slug !!}">
                @foreach($full_time_posts as $post)
                    @if($post->contract_type_id == $contract_term->id)
                        <div class="recent-job-list-home">
                            <div class="job-list-logo col-md-1 ">
                                <img src="{!! asset('images/upload/company-2-post.png') !!}"
                                     class="img-responsive" alt="srjhfghdgh"/>
                            </div>
                            <div class="col-md-5 job-list-desc">
                                <h6>{!! $post->name !!}</h6>
                                <p>{!! $post->job_description !!}</p>
                            </div>
                            <div class="col-md-6 full">
                                <div class="job-list-location col-md-5">
                                    <h6>
                                        <i class="fa fa-map-marker"></i>{!! Helper::relationship($post->city) !!}
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
            </div>
        @endforeach
    </div>
</div>