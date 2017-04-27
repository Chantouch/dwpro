<div id="tab-container" class='tab-container'>
    <ul class='etabs clearfix'>
        <li class='tab'><a href="#all">All</a></li>
        {{--General job section--}}
        @if(isset($contract_terms))
            @foreach($contract_terms as $contract_term)
                <li class='tab'>
                    @if(count($contract_term->posts))
                        <a href="#{!! $contract_term->slug !!}">{!! $contract_term->name !!}</a>
                    @endif
                </li>
            @endforeach
        @endif
        {{--Related job section--}}
        @if(isset($contract_types))
            @foreach($contract_types as $contract_term)
                <li class='tab'>
                    @if(count($contract_term->posts))
                        <a href="#{!! $contract_term->slug !!}">{!! $contract_term->name !!}</a>
                    @endif
                </li>
            @endforeach
        @endif
    </ul>
    <div class='panel-container'>
        <div id="all">
            @if(isset($posts))
                @foreach($posts as $post)
                    @include('front.jobs.recent-tab')
                @endforeach
            @endif
            @if(isset($related_jobs))
                @if(count($related_jobs))
                    @foreach($related_jobs as $post)
                        @include('front.jobs.recent-tab')
                    @endforeach
                @else
                    <div class="recent-job-list-home">
                        <p>There is no job related here.</p>
                    </div>
                @endif
            @endif
        </div>
        @if(isset($contract_terms))
            @foreach($contract_terms as $contract_term)
                <div id="{!! $contract_term->slug !!}">
                    @foreach($full_time_posts as $post)
                        @if($post->contract_type_id == $contract_term->id)
                            @include('front.jobs.recent-tab')
                        @endif
                    @endforeach
                </div>
            @endforeach
        @endif

        @if(isset($contract_types))
            @foreach($contract_types as $contract_term)
                <div id="{!! $contract_term->slug !!}">
                    @foreach($related_jobs as $post)
                        @if($post->contract_type_id == $contract_term->id)
                            @include('front.jobs.recent-tab')
                        @endif
                    @endforeach
                </div>
            @endforeach
        @endif
    </div>
</div>