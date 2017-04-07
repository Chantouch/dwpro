@extends('layouts.front.default')
@section('title', $post->name)
@section('page_specific_styles')
    <link href="{{ asset('assets/plugins/animate.less/animate.min.css') }}" rel="stylesheet" type="text/css"/>
    <style>
        .box {
            position: relative;
            border-radius: 3px;
            background: #ffffff;
            border-top: 1px solid #d2d6de;
            margin-bottom: 20px;
            width: 100%;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        }

        .table-bordered tbody tr td {
            text-align: left;
            background: #ffffff none repeat;
            width: 80px;
        }

        .job-detail h6 {
            background: #8cddcd none repeat scroll 0 0;
            padding: 10px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        }

        .job-detail p {
            padding-left: 10px;
            line-height: 2;
        }

        .main-page-title {
            background: #f6f6f6 none repeat scroll 0 0;
        }

        .bg-color-table {
            background: #f3f3f3 none repeat !important;
            width: 15% !important;
        }

        .table > thead > tr > th.no-border {
            border-bottom: none;
        }

        table.contact-information > tbody > tr > td, table.contact-information > tbody > tr > th,
        table.contact-information > tfoot > tr > td, table.contact-information > tfoot > tr > th,
        table.contact-information > thead > tr > td, table.contact-information > thead > tr > th {
            padding: 15px;
        }

        table.contact-information > tbody > tr:last-child, table.contact-information > tbody > tr:last-child,
        table.contact-information > tfoot > tr:last-child, table.contact-information > tfoot > tr:last-child,
        table.contact-information > thead > tr:last-child, table.contact-information > thead > tr:last-child {
            border-bottom: 1px solid #ddd;
        }

        td .label {
            font-size: 14px !important;
            padding: 0 3px 0 5px !important;
            margin: 0.15em !important;
        }

        .contact {
            margin: 15px 0 0 0;
        }

        .social-buttons a i.fa-facebook-official:hover {
            color: #3b5998;
            text-decoration: none;
        }

        .social-buttons a i.fa-twitter-square:hover {
            color: #4099ff;
            text-decoration: none;
        }

        .social-buttons a i.fa-google-plus-square:hover {
            color: #d34836;
            text-decoration: none;
        }

        .social-buttons a i.fa-pinterest-square:hover {
            color: #cb2027;
            text-decoration: none;
        }

    </style>
@stop

@section('main_page_container')
    <div class="spacer-1">&nbsp;</div>
    <div class="col-md-12 text-center">
        <h1>{!! $post->name !!}</h1>
        <div class="spacer-1">&nbsp;</div>
    </div>
    <img src="{!! asset('images/upload/company-3-post.png') !!}" class="img-responsive job-detail-logo"
         alt="Posting new">
    {{--@if($post->employee->photo == 'default.jpg')--}}
    {{--<img src="{!!asset('uploads/employees/'.$post->employee->photo)!!}"--}}
    {{--class="img-responsive job-detail-logo"--}}
    {{--alt="{!! $related->name !!}"/>--}}
    {{--@else--}}
    {{--<img src="{!!asset('uploads/employees/small/'.$post->employee->id.'/'.$post->employee->photo)!!}"--}}
    {{--class="img-responsive job-detail-logo"--}}
    {{--alt="{!! $post->name !!}"/>--}}
    {{--@endif--}}
    <ul class="meta-job-detail">
        <li>
            <i class="fa fa-link"></i>
            <a href="{!! $post->employee->company_profile->website !!}" target="_blank"
               title="{!!  Helper::relationship($post->employee->company_profile) !!}">Website</a></li>
        <li>
            <i class="fa fa-twitter"></i>
            <a href="{!! $post->employee->twitter_url !!}" target="_blank"
               title="{!!  Helper::relationship($post->employee->company_profile) !!}">Twitter</a></li>
        <li>
            <i class="fa fa-facebook"></i>
            <a href="{!! $post->employee->fb_url !!}" target="_blank"
               title="{!!  Helper::relationship($post->employee->company_profile) !!}">Facebook</a>
        </li>
        <li>
            <i class="fa fa-google-plus"></i>
            <a href="{!! $post->employee->g_plus_url !!}" target="_blank"
               title="{!! Helper::relationship($post->employee->company_profile) !!}">Google+</a></li>
        <li class="sline">|</li>
        <li>
            <i class="fa fa-list"></i>
            <a href="#" title="View all job by {!! $post->employee->company_profile->name !!}">More Job</a></li>
        {{--<li><i class="fa fa-tag"></i><a href="">Store</a></li>--}}
        <li class="sline">|</li>
        <li>
            {{--<i class="fa fa-share-square-o"></i>--}}
            @include('components.share', ['url' =>  route('home.view.job',[$post->hashid,$post->employee->company_profile->slug,$post->industry->slug,$post->slug])])
            {{--<a href="">Share</a>--}}
        </li>
    </ul>

    <div class="recent-job-detail">
        <div class="col-md-5 job-detail-desc">
            <h5>{!! str_limit($post->name,15) !!}</h5>
            <p>{!! str_limit($post->job_description, 60) !!}</p>
        </div>
        <div class="col-md-2 job-detail-name">
            <h6>{!! str_limit(Helper::relationship($post->employee->company_profile),15) !!}</h6>
        </div>
        <div class="col-md-2 job-detail-location">
            <h6><i class="fa fa-map-marker"></i>{!! str_limit(Helper::relationship($post->city),15) !!}</h6>
        </div>
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-7 job-detail-type">
                    <h6><i class="fa fa-user"></i>{!! Helper::relationship($post->contract_type) !!}</h6>
                </div>
                <div class="col-md-5 job-detail-button">
                    <a href="#apply-job" class="btn-apply-job">APPLY</a>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td class="bg-color-table">Year Of Exp</td>
                            <td>{!! Helper::show_year_exp($post->year_experience) !!}</td>
                            <td class="bg-color-table">Term</td>
                            <td>{!! Helper::relationship($post->contract_type) !!}</td>
                        </tr>
                        <tr>
                            <td class="bg-color-table">Hiring</td>
                            <td>{!! $post->hire_number !!} Post(s)</td>
                            <td class="bg-color-table">
                                Function
                            </td>
                            <td>{!! Helper::relationship($post->industry) !!}</td>
                        </tr>
                        <tr>
                            <td class="bg-color-table">Salary</td>
                            <td>{!! Helper::show_salary($post->salary) !!}</td>
                            <td class="bg-color-table">
                                Industry
                            </td>
                            <td>{!! Helper::relationship($post->industry) !!}</td>
                        </tr>
                        <tr>
                            <td class="bg-color-table">Gender</td>
                            <td>{!! Helper::show_gender($post->gender) !!}</td>
                            <td class="bg-color-table">
                                Qualification
                            </td>
                            <td>{!! Helper::relationship($post->qualification) !!}</td>
                        </tr>
                        <tr>
                            <td class="bg-color-table">Age</td>
                            <td>{!! $post->age_from !!} Years ~ {!! $post->age_to !!} Years</td>
                            <td class="bg-color-table">
                                Language
                            </td>
                            <td>
                                @if(count($post->languages))
                                    @foreach($post->languages as $language)
                                        <span class="label label-success">
                                        {!! $language->name !!}
                                    </span>
                                    @endforeach
                                @else
                                    No language selected
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="bg-color-table">Published Date</td>
                            <td>{!! Helper::date_time_format($post->published_date) !!}</td>
                            <td class="bg-color-table">
                                Closing Date
                            </td>
                            <td>{!! Helper::date_time_format($post->closing_date) !!}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <div class="row  job-detail">
        <div class="col-md-8">
            <h6>Job Description</h6>
            <p>
                {!! $post->job_description !!}
            </p>
            <h6>Position Requirements </h6>
            <p>
                {!! $post->requirement_des !!}
            </p>
        </div>

        <div class="col-md-4">
            <h6>Related Jobs</h6>
            <div class="related-job">
                <div class="similar-jobs__content">
                    <div class="js-similar-jobs">
                        @if(count($related_jobs) != 0)
                            @foreach($related_jobs as $related)
                                <div class="similar-job js-similar-job">
                                    <div class="l-similar-job">
                                        <div class="l-similar-job__left">
                                            <a href="#"
                                               title="{!! Helper::relationship($related->employee->company_profile) !!}"
                                               target="_blank">
                                                @if($related->employee->photo == 'default.jpg')
                                                    <img src="{!!asset('uploads/employees/'.$related->employee->photo)!!}"
                                                         class="similar-job__company-img img-responsive"
                                                         alt="{!! $related->name !!}"/>
                                                @else
                                                    <img src="{!!asset($related->employee->path.$related->employee->photo)!!}"
                                                         class="similar-job__company-img img-responsive"
                                                         alt="{!! $related->name !!}"/>
                                                @endif
                                            </a>
                                        </div>
                                        <div class="l-similar-job__right ">
                                            <span class="js-similar-job-title">
                                                <a href="#"
                                                   class="similar-job__title"
                                                   title="{!! $related->name !!}">{!! $related->name !!}</a>
                                            </span>
                                            <a href="#"
                                               target="_blank"
                                               class="similar-job__location js-similar-job-location">{!! Helper::relationship($related->city) !!}
                                                , Cambodia</a>
                                            <span class="similar-job__date js-similar-job-expiration-date">{!! Helper::date_time_format($related->closing_date) !!}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p> No job</p>
                        @endif
                        {{--{!! Request::fullUrl() !!}--}}
                    </div>
                    <div class="similar-jobs__btn-wrapper">
                        <a href="#" class="btn btn-default">See more jobs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container job-detail">
        <h6>Contact Information</h6>
        <div class="row">
            <div class="col-md-12">
                <table class="table contact-information">
                    @if(!empty($post->employee->contact_id))
                        @foreach($post->employee->contacts as $contact)
                            <thead>
                            <tr>
                                <th class="col-md-2 col-xs-5 no-border">Contact Name:</th>
                                <td>{!! $contact->contact_name !!}</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th>Department:</th>
                                <td>{!! $contact->department->name !!}</td>
                            </tr>
                            <tr>
                                <th>Phone:</th>
                                <td>{!! $contact->phone_number !!}</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>
                                    <a href="mailto:{!! $contact->email !!}" target="_top">{!! $contact->email !!}</a>
                                </td>
                            </tr>
                            <tr>
                                <th>Website:</th>
                                <td><a href="{!! $post->employee->web_address !!}"
                                       target="_blank">{!! $post->employee->web_address !!}</a></td>
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td>{!! $post->employee->address !!}</td>
                            </tr>
                            </tbody>
                        @endforeach
                    @else
                        <thead>
                        <tr>
                            <th class="col-md-2 col-xs-5 no-border">Contact Name:</th>
                            <td>{!! $post->employee->contact_name !!}</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th>Phone:</th>
                            <td>{!! $post->employee->contact_mobile_no !!}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td><a href="mailto:{!! $post->employee->email !!}"
                                   target="_top">{!! $post->employee->email !!}</a>
                            </td>
                        </tr>
                        <tr>
                            <th>Website:</th>
                            <td>
                                @if(!empty($post->employee->web_address))
                                    <a href="{!! $post->employee->web_address !!}"
                                       target="_blank">{!! $post->employee->web_address !!}</a>
                                @else
                                    <a href="http://www.jcolabs.com"
                                       target="_blank">www.jcolabs.com</a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Address:</th>
                            <td>{!! $post->employee->address !!}</td>
                        </tr>
                        </tbody>
                    @endif
                </table>
            </div>
        </div>
        <div class="spacer-1">&nbsp;</div>
    </div>
    <div class="job-detail" id="apply-job">
        <div id="page-content">
            <div class="content-about">
                <div class="col-md-12">
                    <h6>Apply this job</h6>
                </div>
                <div class="container">
                    {!! Form::open(['route' => ['employee.update_profile', $post->id], 'role'=>'form', 'id'=>'apply-job', 'files'=>'true']) !!}
                    <div class="form-group col-md-6{!! $errors->has('name') ? ' has-error' : '' !!}">
                        <label for="name">Name:</label>
                        {!! Form::text('name', null, ['class' => 'form-control name', 'id'=>'name']) !!}
                        @if($errors->has('name'))
                            <span class="help-block">
                                <strong>{!! $errors->first('name') !!}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6{!! $errors->has('email') ? ' has-error' : '' !!}">
                        <label for="email">Email:</label>
                        {!! Form::text('email', null, ['class'=>'form-control email', 'id'=>'email']) !!}
                        @if($errors->has('email'))
                            <span class="help-block">
                                <strong>{!! $errors->first('email') !!}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6{!! $errors->has('phone') ? ' has-error' : '' !!}">
                        <label for="phone">Tel:</label>
                        {!! Form::text('phone', null, ['class' => 'form-control phone', 'id'=>'phone']) !!}
                        @if($errors->has('phone'))
                            <span class="help-block">
                                <strong>{!! $errors->first('phone') !!}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6{!! $errors->has('subject') ? ' has-error' : '' !!}">
                        <label for="subject">Subject:</label>
                        {!! Form::text('subject', null, ['class'=>'form-control subject', 'id'=>'subject']) !!}
                        @if($errors->has('subject'))
                            <span class="help-block">
                                <strong>{!! $errors->first('subject') !!}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-12{!! $errors->has('message') ? ' has-error' : '' !!}">
                        <label for="message">Message:</label>
                        {!! Form::textarea('message', null, ['class'=>'form-control message', 'id'=>'message', 'rows'=>'8'  ,'placeholder'=>'Describe about yourself that want to apply this position']) !!}
                        @if($errors->has('message'))
                            <span class="help-block">
                                <strong>{!! $errors->first('message') !!}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6{!! $errors->has('attachment') ? ' has-error' : '' !!}">
                        <label for="attachment">CV:</label>
                        {!! Form::file('attachment', null, ['id'=>'attachment']) !!}
                        @if($errors->has('attachment'))
                            <span class="help-block">
                                <strong>{!! $errors->first('attachment') !!}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <button class="btn btn-default btn-green" type="submit" name="submit" id="submit">APPLY
                        </button>
                    </div>
                    <div class="clearfix"></div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="spacer-1"></div>
    </div>

@stop

@section('page_content')
    <div class="spacer-1">&nbsp;</div>
    <div class="tab-container" id="tab-container"><!-- Start Recent Job -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4><i class="glyphicon glyphicon-briefcase"></i> RELATED JOBS</h4>

                    {{--Tab jos--}}
                    @include('components.tab_jobs')
                    {{--Tab jos--}}

                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    </div><!-- end Recent Job -->

    <!-- Start page content -->
    @include('front.jobs.page-content')
    <!--End page content -->

    <!-- ###################### Feature Search ##################### -->
    @include('front.jobs.feature-search')
    <!--End Feature search -->

@stop

@section('page_specific_js')
    <script src="{{ asset('assets/plugins/wow/wow.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        let popupSize = {
            width: 780,
            height: 550
        };
        $(document).on('click', '.social-buttons > a', function (e) {
            let verticalPos = Math.floor(($(window).width() - popupSize.width) / 2),
                horizontalPos = Math.floor(($(window).height() - popupSize.height) / 2);
            let popup = window.open($(this).prop('href'), 'social',
                'width=' + popupSize.width + ',height=' + popupSize.height +
                ',left=' + verticalPos + ',top=' + horizontalPos +
                ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');
            if (popup) {
                popup.focus();
                e.preventDefault();
            }
        });
    </script>
@stop
@section('page_specific_scripts')
    new WOW().init();
@stop
