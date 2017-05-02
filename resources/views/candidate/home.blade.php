@extends('layouts.front.default')

@section('page_specific_styles')
    <link rel="stylesheet" href="{!! asset('css/circle.css') !!}">
    <style>
        .form-horizontal .form-group {
            margin-right: 0 !important;
        }

        a.tryitbtn, a.tryitbtn:link, a.tryitbtn:visited, a.showbtn, a.showbtn:link, a.showbtn:visited {
            font-family: Verdana, Geneva, Tahoma, Arial, Helvetica, sans-serif;
            display: inline-block;
            color: #FFFFFF;
            background-color: #8AC007;
            font-size: 15px;
            text-align: center;
            padding: 5px 16px;
            text-decoration: none;
            margin-left: 0;
            margin-top: 0px;
            margin-bottom: 5px;
            border: 1px solid #8AC007;
            white-space: nowrap;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        }

        a.tryitbtn:hover, a.tryitbtn:active, a.showbtn:hover, a.showbtn:active {
            background-color: #4A99CE;
            color: #FFFFFF;
            border: 1px solid #3C9FE2;
        }

        /* .info-box
        =================================================================== */
        .info-box {
            min-height: 140px;
            margin-bottom: 30px;
            padding: 20px;
            color: white;
            -webkit-box-shadow: inset 0 0 1px 1px rgba(255, 255, 255, 0.35), 0 3px 1px -1px rgba(0, 0, 0, 0.1);
            -moz-box-shadow: inset 0 0 1px 1px rgba(255, 255, 255, 0.35), 0 3px 1px -1px rgba(0, 0, 0, 0.1);
            box-shadow: inset 0 0 1px 1px rgba(255, 255, 255, 0.35), 0 3px 1px -1px rgba(0, 0, 0, 0.1);
        }

        .info-box i {
            display: block;
            height: 100px;
            font-size: 60px;
            line-height: 100px;
            width: 99px;
            float: left;
            text-align: center;
            margin-right: 0px;
            padding-right: 0px;
            color: rgba(255, 255, 255, 0.75);
        }

        .info-box .count {
            margin-top: 20px;
            font-size: 18px;
            font-weight: 700;
        }

        .info-box .title {
            font-size: 12px;
            text-transform: uppercase;
            font-weight: 600;
        }

        .info-box .desc {
            margin-top: 10px;
            font-size: 12px;
        }

        .info-box.danger {
            background: #ff5454;
            border: 1px solid #ff2121;
        }

        .info-box.warning {
            background: #fabb3d;
            border: 1px solid #f9aa0b;
        }

        .info-box.primary {
            background: #20a8d8;
            border: 1px solid #1985ac;
        }

        .info-box.info {
            background: #67c2ef;
            border: 1px solid #39afea;
        }

        .info-box.success {
            background: #79c447;
            border: 1px solid #61a434;
        }

        /*----------------  color------------------------*/
        .dark-heading-bg {
            background: #4c4f53;
            border: 1px solid #4c4f53;
        }

        .main-bg {
            background: #e6e8ea;
        }

        .white-bg {
            color: #768399;
            background: #fff;
        }

        .red-bg {
            color: #fff;
            background: #d95043;
        }

        .blue-bg {
            color: #fff;
            background: #57889c;
        }

        .green-bg {
            color: #fff;
            background: #26c281;
        }

        .greenLight-bg {
            color: #71843f;
            background: #71843f;
        }

        .yellow-bg {
            color: #fff;
            background: #fc6;
        }

        .orange-bg {
            color: #fff;
            background: #f4b162;
        }

        .purple-bg {
            color: #fff;
            background: #af91e1;
        }

        .pink-bg {
            color: #fff;
            background: #f78db8;
        }

        .lime-bg {
            color: #fff;
            background: #a8db43;
        }

        .magenta-bg {
            color: #fff;
            background: #e65097;
        }

        .teal-bg {
            color: #fff;
            background: #97d3c5;
        }

        .brown-bg {
            color: #fff;
            background: #d1b993;
        }

        .gray-bg {
            color: #768399;
            background: #e4e9eb;
        }

        .dark-bg {
            color: #fff;
            background: #1a2732;
        }

        .facebook-bg {
            color: #fff;
            background: #3b5998;
        }

        .twitter-bg {
            color: #fff;
            background: #00aced;
        }

        .linkedin-bg {
            color: #fff;
            background: #4875b4;
        }

        .text-right {
            text-align: right;
        }

        .aug_legend {
            transition: background-color 0.5s ease;
        }

        .aug_legend:hover {
            background-color: #119138;
            color: #fff;
        }

        #image-preview {
            width: 200px;
            height: 184px;
            position: relative;
            overflow: hidden;
            background-color: #ffffff;
            color: #ecf0f1;
            border: 1px solid #d6d6e0;
        }

        #image-preview input {
            line-height: 199px;
            font-size: 200px;
            position: absolute;
            opacity: 0;
            z-index: 10;
        }

        #image-preview label {
            position: absolute;
            z-index: 5;
            opacity: 0.8;
            cursor: pointer;
            background-color: #bdc3c7;
            width: 100%;
            height: 50px;
            font-size: 20px;
            line-height: 50px;
            text-transform: uppercase;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            text-align: center;
        }

    </style>
@stop
@section('main_page_container')

    <div class="row">
        <!-- Profile info -->
        <div class="col-md-7">
            <div class="clearfix complete-bar-width complete-bar">
                <div class="complete-bar-center">
                    <h3 class="profile-completion-header">Profile Info</h3>
                    <div class="row">
                        <div class="col-md-4">
                            <div id="image-preview" style="background-image: url('{!! $auth->avatar_path !!}')">
                                <label for="image-upload" id="image-label">Choose File</label>
                                {!! Form::file('logo_photo',['id'=>'image-upload']) !!}
                            </div>
                            @if ($errors->has('logo_photo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('logo_photo') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="profile-info">
                                <p>Lives in: {!! $auth->profile_city !!}</p>
                                <p>Email: {!! $auth->email !!}</p>
                                <p>Phone: {!! $auth->phone_number !!}</p>
                                <p>Gender: {!! Helper::show_gender($auth->gender) !!}</p>
                                <p>Address: {!! $auth->profile_address !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile completion -->
        <div class="col-md-5">
            <div class="clearfix complete-bar-width complete-bar">
                <div class="complete-bar-center">
                    <h3 class="profile-completion-header">Profile Completion</h3>
                    <div class="c100 p{!! $progress !!} green">
                        <span>{!! $progress !!}%</span>
                        <div class="slice">
                            <div class="bar"></div>
                            <div class="fill"></div>
                        </div>
                    </div>
                </div>
                <h4 class="profile-completion-level">Beginner</h4>
                <div class="profile-completion-tip">
                    <div class="profile-completion-tip-header">Tip:</div>
                    <div class="profile-completion-tip">Add your Work Experience and gain 30 points</div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('contents')
    <div class="container" style="padding:20px 0">
        <div class="row">
            <div class="col-md-12 text-right">
                <a class="aug_legend rigt" href="#" target="_blank">
                    Views/Print Identity Card <i class="fa fa-external-link"></i>
                </a>&nbsp;
            </div>
        </div>
        <div class="row">
            <a href="#">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="info-box blue-bg">
                        <i class="fa fa-user"></i>
                        <div class="count">Bio/Personal Information</div>
                    </div><!--/.info-box-->
                </div><!--/.col-->
            </a>
            <a href="#">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="info-box facebook-bg">
                        <i class="fa fa-book"></i>
                        <div class="count">Education Details</div>
                    </div><!--/.info-box-->
                </div><!--/.col-->
            </a>
            <a href="#">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="info-box dark-bg">
                        <i class="fa fa-comments-o"></i>
                        <div class="count">Languages Known</div>
                    </div><!--/.info-box-->
                </div><!--/.col-->
            </a>
            <a href="#">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="info-box linkedin-bg">
                        <i class="fa fa-cubes"></i>
                        <div class="count">Experience</div>
                    </div><!--/.info-box-->
                </div><!--/.col-->
            </a>
            <a href="#">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="info-box pink-bg">
                        <i class="fa fa-cubes"></i>
                        <div class="count">Professional Skills</div>
                    </div><!--/.info-box-->
                </div><!--/.col-->
            </a>
            <a href="#">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="info-box dark-heading-bg">
                        <i class="fa fa-cubes"></i>
                        <div class="count">References</div>
                    </div><!--/.info-box-->
                </div><!--/.col-->
            </a>
            <a href="#">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="info-box brown-bg">
                        <i class="fa fa-cubes"></i>
                        <div class="count">Accomplish</div>
                    </div><!--/.info-box-->
                </div><!--/.col-->
            </a>
            <a href="#">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="info-box teal-bg">
                        <i class="fa fa-comments-o"></i>
                        <div class="count">Attachment</div>
                    </div><!--/.info-box-->
                </div><!--/.col-->
            </a>
        </div><!--/.row-->
    </div>
@stop
@section('page_content')
    <div class="content-about">
        <div id="cs">
            <div class="container">
                <div class="spacer-1">&nbsp;</div>
                <h1>Hey Friends Any Quries?</h1>
                <p>
                    At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum
                    deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non
                    provident, similique sunt.
                </p>
                <h1 class="phone-cs">Call: 1 800 000 500</h1>
            </div>
        </div>
    </div>
@stop
@section('page_specific_js')
    <script type="text/javascript"
            src="{!! asset('assets/plugins/image-preview/jquery.uploadPreview.min.js') !!}"></script>
@stop
@section('page_specific_scripts')
    $.uploadPreview({
    input_field: "#image-upload",
    preview_box: "#image-preview",
    label_field: "#image-label"
    });
@stop
