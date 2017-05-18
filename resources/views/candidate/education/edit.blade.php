@extends('layouts.front.default')

@section('page_specific_styles')
    <link rel="stylesheet" href="{!! asset('css/circle.css') !!}">
    <link rel="stylesheet" href="{!! asset('plugins/summernote/summernote.css') !!}">
    <style>
        .form-horizontal .form-group {
            margin-right: 0 !important;
        }

        [v-cloak] {
            display: none;
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

        .panel-title {
            margin-top: 6px;
            margin-bottom: 0;
            font-size: 22px;
            color: inherit;
        }

        .select2-container {
            display: block;
        }

        .select2-container-multi .select2-choices .select2-search-choice {
            margin: 7px 0 3px 5px;
        }

        .select2-container .select2-choice {
            display: block;
            height: 34px;
            padding: 3px 0 0 8px;
        }

        .select2-container .select2-choice .select2-arrow b {
            position: relative;
            top: 2px;
        }

    </style>
@stop
@section('main_page_container')
    {{--<div id="wait"--}}
    {{--style="display:none;width:69px;height:89px;border:1px solid black;position:absolute;top:50%;left:50%;padding:2px;">--}}
    {{--<img src='demo_wait.gif' width="64" height="64"/><br>Loading..--}}
    {{--</div>--}}
    <div class="row" id="user_profile">
        @include('candidate.profile-info')

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title pull-left">
                        About me
                    </h3>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    {!! Form::model($profile, ['route' => ['candidate.update'], 'method' => 'patch']) !!}
                    <div class="form-group col-md-12 col-sm-6">
                        {!! Form::textarea('about_me', null, ['class' => 'form-control summernote', 'autofocus']) !!}
                        <span class="error text-danger"></span>
                    </div>
                    <div class="from- col-md-12">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-success">
                                <i class="glyphicon glyphicon-floppy-save"></i> Submit
                            </button>
                            <button type="button" class="btn btn-default">
                                <i class="glyphicon glyphicon-remove-circle"></i> Cancel
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@stop

@section('page_specific_js')
    <script src="{!! asset('plugins/summernote/summernote.min.js') !!}"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 200,
            });
        });
    </script>
@stop