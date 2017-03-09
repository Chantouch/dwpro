<div class="col-md-5">
    <!-- Widget: user widget style 1 -->
    <div class="box box-widget widget-user-2">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-aqua-active">
            <div class="widget-user-image">
                {{--@if($employee->photo == 'default.jpg')--}}
                {{--<img class="" src="{!! asset('uploads/employers/' . $employee->photo)!!}"--}}
                {{--alt="{!! $employee->first_name !!}">--}}
                {{--@else--}}
                {{--<img class="" src="{!! asset('uploads/employers/avatar/'. $employee->id .'/'. $employee->photo)!!}"--}}
                {{--alt="{!! $employee->contact_name !!}">--}}
                {{--@endif--}}
                <img class="img-responsive" src="{!! asset('uploads/employees/default.jpg')!!}"
                     alt="{!! $employee->first_name !!}">
            </div>
            <!-- /.widget-user-image -->
            <h3 class="widget-user-username">{!! $employee->company_profile->name !!}</h3>
            <h5 class="widget-user-desc"> {!! $employee->company_profile->business_type->name !!}
                / {!! $employee->company_profile->industry->name!!}
            </h5>
        </div>
        <div class="box-footer no-padding">
            <ul class="nav nav-stacked">
                <li><a href="#">Total no of Jobs Posted <span
                                class="pull-right badge bg-blue">{!! count($employee->posts) !!}</span></a></li>
                <li><a href="#">Jobs Not Verified yet<span
                                class="pull-right badge bg-red">{!! count($jobs_need_verify) !!}</span></a></li>
                <li><a href="#">Jobs Filled up <span
                                class="pull-right badge bg-green">{!! count($jobs_filled_up) !!}</span></a></li>
                <li><a href="#">Jobs Available now<span
                                class="pull-right badge bg-aqua">{!! count($jobs_available) !!}</span></a></li>

                @if($employee->verified_by == null)
                    <li class="approve_employer text-center">
                        <a title="By clicking approve the Employer profile will be marked as verified and the Employer can use all the features of this portal"
                           href="{!! route('admin.employees.verify-employee', $employee->hashid) !!}"
                           onclick="return confirm('Are you sure to approve this employer?')"
                           class="show_confirm"> <i class="ti-check"></i>&nbsp; Approve Employer
                        </a>
                    </li>
                @else
                    <li class="text-center">
                        <p style="position: relative;display: block;padding: 10px 15px;background: yellowgreen;">
                            Profile Approved
                        </p>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    <!-- /.widget-user -->
</div>
<!-- /.col -->
<input type="hidden" value="{!! $employee->hashid !!}" name="hashid" id="hashid">
<div class="col-md-7 no-padding">
    <ul class="nav nav-tabs tabs">
        <li class="active tab">
            <a href="#contact_person_details" data-toggle="tab" aria-expanded="false">
                <span class="visible-xs"><i class="fa fa-home"></i></span>
                <span class="hidden-xs">Contact Person Details</span>
            </a>
        </li>
        <li class="tab">
            <a href="#company_details" data-toggle="tab" aria-expanded="false">
                <span class="visible-xs"><i class="fa fa-user"></i></span>
                <span class="hidden-xs">Company Details</span>
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="contact_person_details">
            <strong><i class="fa fa-user margin-r-5"></i> Name </strong>
            &nbsp;&nbsp;&nbsp;
            <span>
                {!! $employee->first_name,' ', $employee->last_name !!}
            </span>
            <hr>
            <strong><i class="fa fa-phone margin-r-5"></i> Phone</strong>
            &nbsp;&nbsp;&nbsp;
            <span>
                {!! $employee->phone_number !!}
            </span>
            <hr>
            <strong><i class="fa fa-envelope margin-r-5"></i> E-mail</strong>
            &nbsp;&nbsp;&nbsp;
            <span>
                <a href="mailto:{!!$employee->email!!}" target="_top">{!!$employee->email!!}</a>
            </span>
            <hr>
            <strong><i class="fa fa-file-text-o margin-r-5"></i> About</strong>
            <p>{!! $employee->company_profile->description !!}</p>
        </div>
        <div class="tab-pane" id="company_details">
            <table class="table table-striped table-condensed">
                <tbody>
                <tr>
                    <th>Enrollment No</th>
                    <td> {!! $employee->company_profile->enroll_no !!} </td>
                </tr>
                <tr>
                    <th>Name of the Organisation</th>
                    <td> {!! $employee->company_profile->name !!} </td>
                </tr>
                <tr>
                    <th>Organisation type</th>
                    <td> {!! $employee->company_profile->business_type->name !!} </td>
                </tr>
                <tr>
                    <th>Industry</th>
                    <td>
                        @if($employee->company_profile->industry_id == '' || $employee->company_profile->industry_id == null)
                            <span>No industry</span>
                        @else
                            {{ $employee->company_profile->industry->name }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>City, District</th>
                    <td>
                        @if($employee->company_profile->city_id == '' || $employee->company_profile->city_id == null)
                            <span>No city and district</span>
                        @else
                            {!! $employee->company_profile->city->name !!}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td> {!! $employee->company_profile->address !!} </td>
                </tr>
                <tr>
                    <th>Phone no</th>
                    <td> {!! $employee->company_profile->phone_number !!}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>
                        <a href="mailto:{!! $employee->company_profile->company_email!!}">{!! $employee->company_profile->company_email!!}</a>
                    </td>
                </tr>
                <tr>
                    <th>Web address (URL)</th>
                    <td><a href="{!! $employee->company_profile->website!!}"
                           target="_blank">{!! $employee->company_profile->website!!}</a></td>
                </tr>
                <tr>
                    <th>Verification status</th>
                    <td>
                        @if($employee->verified_by == null) {!! $employee->verification_status!!}
                        @else
                            <a href="#"> {!! $employee->verification_status!!} </a>
                        @endif
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div><!-- /.col -->
<div class="col-md-12">
    <ul class="nav nav-tabs tabs tabs-top">
        <li class="active tab">
            <a href="#all_jobs" data-toggle="tab" aria-expanded="false">
                <span class="visible-xs"><i class="fa fa-home"></i></span>
                <span class="hidden-xs">All Jobs</span>
            </a>
        </li>
        <li class="tab">
            <a href="#jobs_need_verification" data-toggle="tab" aria-expanded="false">
                <span class="visible-xs"><i class="fa fa-home"></i></span>
                <span class="hidden-xs">Jobs Need Verification</span>
            </a>
        </li>
        <li class="tab">
            <a href="#jobs_available_now" data-toggle="tab" aria-expanded="false">
                <span class="visible-xs"><i class="fa fa-user"></i></span>
                <span class="hidden-xs">Jobs Available Now</span>
            </a>
        </li>
        <li class="tab">
            <a href="#jobs_filled_up" data-toggle="tab" aria-expanded="true">
                <span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
                <span class="hidden-xs">Jobs Filled Up</span>
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="all_jobs">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Job ID</th>
                    <th>Title</th>
                    <th>Level</th>
                    <th>No. of pos.</th>
                    <th>Industry</th>
                    <th>Qualification</th>
                    <th>Salary</th>
                    <th>Created At</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="post in all_jobs">
                    <td>
                        <a href="#" @click.prevent="editItem(post)">
                            #@{{ post.post_id }}
                        </a>
                    </td>
                    <td>@{{ post.name }}</td>
                    <td>@{{ post.level.name }}</td>
                    <td>@{{ post.hire_number }}</td>
                    <td>@{{ post.industry.name }}</td>
                    <td>@{{ post.qualification.name }}</td>
                    <td>@{{ post.salary}}</td>
                    <td>@{{ post.created_at | dateshow }}</td>
                    <td>@{{ post.status | status}}</td>
                </tr>
                </tbody>
                {{--<tr v-if="!all_jobs.length">--}}
                    {{--<td colspan="12">--}}
                        {{--<p class="text-center" style="padding:10px;"> No records available.</p>--}}
                    {{--</td>--}}
                {{--</tr>--}}
            </table>
            @include('vendor.pagination.page-component')
        </div>
        <div class="tab-pane" id="jobs_need_verification">
            <table class="table table-bordered">
                <thead v-if="items.length">
                <tr>
                    <th>Job ID</th>
                    <th>Title</th>
                    <th>Level</th>
                    <th>No. of pos.</th>
                    <th>Industry</th>
                    <th>Qualification</th>
                    <th>Salary</th>
                    <th>Created At</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="post in items">
                    <td>
                        <a href="#" @click.prevent="editItem(post)">
                            #@{{ post.post_id }}
                        </a>
                    </td>
                    <td>@{{ post.name }}</td>
                    <td>@{{ post.level.name }}</td>
                    <td>@{{ post.hire_number }}</td>
                    <td>@{{ post.industry.name }}</td>
                    <td>@{{ post.qualification.name }}</td>
                    <td>@{{ post.salary}}</td>
                    <td>@{{ post.created_at | dateshow }}</td>
                    <td>@{{ post.status | status}}</td>
                </tr>
                </tbody>
                <tr v-if="!items.length">
                    <td colspan="12">
                        <p class="text-center" style="padding:10px;"> No records available.</p>
                    </td>
                </tr>
            </table>
        </div>
        <div class="tab-pane" id="jobs_available_now">
            <table class="table table-bordered">
                <thead v-if="jobs_available.length">
                <tr>
                    <th>Job ID</th>
                    <th>Title</th>
                    <th>Level</th>
                    <th>No. of pos.</th>
                    <th>Industry</th>
                    <th>Qualification</th>
                    <th>Salary</th>
                    <th>Created At</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="post in jobs_available">
                    <td>
                        <a href="#" @click.prevent="editItem(post)">
                            #@{{ post.post_id }}
                        </a>
                    </td>
                    <td>@{{ post.name }}</td>
                    <td>@{{ post.level.name }}</td>
                    <td>@{{ post.hire_number }}</td>
                    <td>@{{ post.industry.name }}</td>
                    <td>@{{ post.qualification.name }}</td>
                    <td>@{{ post.salary}}</td>
                    <td>@{{ post.created_at | dateshow }}</td>
                    <td>@{{ post.status | status}}</td>
                </tr>
                </tbody>
                <tr v-if="!jobs_available.length">
                    <td colspan="12">
                        <p class="text-center" style="padding:10px;"> No records available.</p>
                    </td>
                </tr>
            </table>
        </div>
        <div class="tab-pane" id="jobs_filled_up">
            <table class="table table-bordered">
                @if(count($jobs_filled_up_list))
                    <thead>
                    <tr>
                        <th>Job ID</th>
                        <th>Title</th>
                        <th>Level</th>
                        <th>No. of pos.</th>
                        <th>Industry</th>
                        <th>Qualification</th>
                        <th>Salary</th>
                        <th>Create At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($jobs_filled_up_list as $post)
                        <tr>
                            <td>
                                <a href="#">
                                    #{!! $post->post_id !!}
                                </a>
                            </td>
                            <td>{!! $post->name !!}</td>
                            <td>{!! $post->level->name !!}</td>
                            <td>{!! $post->hire_number !!}</td>
                            <td>{!! $post->industry->name !!}</td>
                            <td>{!! $post->qualification->name !!}</td>
                            <td>{!! $post->salary !!}</td>
                            <td>{!! $post->created_at !!}</td>
                        </tr>
                    </tbody>
                    @endforeach
                @else
                    <tr>
                        <td colspan="12">
                            <p class="text-center" style="padding:10px;"> No records available.</p>
                        </td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
</div><!-- /.col -->

@include('admin.employees.verify-job-modal')