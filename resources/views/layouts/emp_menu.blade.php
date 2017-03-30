<ul>
    <li class="text-muted menu-title">Navigation</li>
    <li>
        <a href="javascript:void (0)" class="waves-effect waves-light"><i class="ti-home"></i>
            <span> Dashboard </span>
        </a>
    </li>

    <li class="has_sub">
        <a href="javascript:void (0)"
           class="waves-effect waves-light {!! Request::is('employee/contact-list*') ? 'active' : '' !!}">
            <i class="ti-home"></i>
            <span> Contacts </span>
        </a>
        <ul class="list-unstyled">
            <li class="{!! Request::is('employee/contact-list')? 'active' : '' !!}">
                <a href="{!! route('employee.contacts_data') !!}">All</a>
            </li>
            <li class="{!! Request::is('employee/contact-list/deleted')? 'active' : '' !!}">
                <a href="{!! route('employee.get_contact_deleted_list') !!}">Deleted</a>
            </li>
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
            <li class="{!! Request::is('employee/posts/active')? 'active' : '' !!}">
                <a href="{!! route('employee.posts.active') !!}">Active</a>
            </li>
            <li class="{!! Request::is('employee/posts/drafts')? 'active' : '' !!}">
                <a href="{!! route('employee.posts.drafts') !!}">Drafts</a>
            </li>
            <li class="{!! Request::is('employee/posts/unpublished')? 'active' : '' !!}">
                <a href="{!! route('employee.posts.unpublished') !!}">Unpublished</a>
            </li>
            <li class="{!! Request::is('employee/posts/expired')? 'active' : '' !!}">
                <a href="{!! route('employee.posts.expired') !!}">Expired</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="javascript:void (0)" class="waves-effect waves-light"><i class="ti-home"></i>
            <span> CV Search </span>
        </a>
    </li>
    <li class="has_sub">
        <a href="javascript:void (0)"
           class="waves-effect waves-light {!! Request::is('employee/account-settings*') ? 'active' : '' !!}">
            <i class="ti-home"></i> <span>Account Settings</span>
        </a>
        <ul class="list-unstyled">
            <li class="{!! Request::is('employee/account-settings/company-profile') ? ' active' : '' !!}">
                <a href="{!! route('employee.company_profile') !!}" class="waves-effect waves-light">
                    Company Profile
                </a>
            </li>
            <li class="{!! Request::is('employee/account-settings/change-password') ? ' active' : '' !!}">
                <a class="waves-effect waves-light"
                   href="{!! route('employee.account-settings.show-change-password') !!}">
                    Change Password</a>
            </li>
        </ul>
    </li>
</ul>