<ul>
    <li class="text-muted menu-title">Navigation</li>
    <li class="has_sub">
        <a href="javascript:void (0)" class="waves-effect waves-light"><i class="ti-home"></i>
            <span> Dashboard </span>
        </a>
        <ul class="list-unstyled">
            <li><a href="#">Dashboard</a></li>
        </ul>
    </li>

    <li class="has_sub">
        <a href="javascript:void (0)"
           class="waves-effect waves-light {!! Request::is('employee/posts*') ? 'active' : '' !!}">
            <i class="ti-home"></i> <span>Posts</span>
        </a>
        <ul class="list-unstyled">
            <li class="{!! Request::is('employee/posts')? 'active' : '' !!}">
                <a href="{!! route('employee.posts.index') !!}">All Posts</a>
            </li>
        </ul>
    </li>
</ul>