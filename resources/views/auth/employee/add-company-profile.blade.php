@extends('auth.employee.layout')
@section('styles')
    <link href="{!! asset('assets/plugins/summernote/dist/summernote.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('assets/plugins/select2/select2.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css') !!}" rel="stylesheet"/>
    <script src="{!! asset('assets/js/modernizr.min.js') !!}"></script>
    <style>
        .wrapper-page {
            width: 50%;
        }

        @media only screen and (max-width: 768px) {
            .wrapper-page {
                width: 90%;
            }
        }

        @media only screen and (min-width: 768px) {
            .wrapper-page {
                width: 70%;
            }
        }

        #image-preview {
            width: 100%;
            height: 184px;
            position: relative;
            overflow: hidden;
            background-color: #ffffff;
            color: #ecf0f1;
            border: 1px solid #d6d6e0;
        }

        #image-preview input {
            line-height: 200px;
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
@section('contents')
    <div class="wrapper-page">
        <div class=" card-box">
            <div class="panel-heading">
                <h3 class="text-center">
                    Please enter your company's name
                </h3>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            <div class="panel-body">
                <form class="form" role="form" method="POST"
                      action="{{ route('employee.register.add_company_profile.post') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <label for="name" class="control-label">Company name</label>
                                <input id="name" type="text" class="form-control" name="name"
                                       value="{{ old('name') }}" autofocus placeholder="Company name">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3 m-t-10">
                            <label for="image-label" class="control-label">Logo</label>
                            <div id="image-preview">
                                <label for="image-upload" id="image-label">Choose File</label>
                                <input type="file" name="logo_photo" id="image-upload"/>
                            </div>
                        </div>
                        <div class="col-md-9 m-t-10">
                            <div class="form-group{{ $errors->has('country_id') ? ' has-error' : '' }}">
                                <label for="country_id" class="control-label">Country</label>
                                {!! Form::select('country_id',$cities, null, [
                                    'class' => 'form-control selectpicker', 'data-live-search' => 'true', 'data-style'=>'btn-white btn-md'
                                ]) !!}
                                @if ($errors->has('country_id'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('country_id') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('city_id') ? ' has-error' : '' }}">
                                <label for="city_id" class="control-label">City</label>
                                {!! Form::select('city_id',$cities, null, [
                                    'class' => 'form-control selectpicker', 'data-live-search' => 'true', 'data-style'=>'btn-white btn-md'
                                ]) !!}
                                @if ($errors->has('city_id'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('city_id') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('number_employee') ? ' has-error' : '' }}">
                                <label for="number_employee" class="control-label">Number of Employees</label>
                                {!! Form::select('number_employee',$no_employee, null, [
                                    'class' => 'form-control selectpicker', 'data-live-search' => 'true', 'data-style'=>'btn-white btn-md'
                                ]) !!}
                                @if ($errors->has('number_employee'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('number_employee') }}</strong>
                                </span>
                                @endif
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('business_type_id') ? ' has-error' : '' }}">
                                <label for="business_type_id" class="control-label">Business type</label>
                                {!! Form::select('business_type_id',$business_type, null, [
                                    'class' => 'form-control selectpicker', 'data-live-search' => 'true', 'data-style'=>'btn-white btn-md'
                                ]) !!}
                                @if ($errors->has('business_type_id'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('business_type_id') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('industry_id') ? ' has-error' : '' }}">
                                <label for="industry_id" class="control-label">Industry</label>
                                {!! Form::select('industry_id',$industries, null, [
                                    'class' => 'form-control selectpicker', 'data-live-search' => 'true', 'data-style'=>'btn-white btn-md'
                                ]) !!}
                                @if ($errors->has('industry_id'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('industry_id') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('website') ? ' has-error' : '' }}">
                                <label for="website" class="control-label">Website</label>
                                {!! Form::text('website', null, ['class'=>'form-control','placeholder'=>'Website']) !!}
                                @if ($errors->has('website'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('website') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('about_us') ? ' has-error' : '' }}">
                                <label for="about_us" class="control-label">About company</label>
                                {!! Form::textarea('about_us', null, ['class'=>'form-control','placeholder'=>'About us','id'=>'about_us']) !!}
                                @if ($errors->has('about_us'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('about_us') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-pink btn-block text-uppercase waves-effect waves-light"
                                    type="submit">
                                Create Company Profile
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 text-center">
                <p>Don't have an account? <a href="{!! route('employee.register') !!}" class="text-primary m-l-5">
                        <b>Sign Up</b></a></p>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script src="{!! asset('assets/plugins/select2/select2.min.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js') !!}"
            type="text/javascript"></script>
    <script src="{!! asset('assets/plugins/summernote/dist/summernote.min.js') !!}"></script>
    <script type="text/javascript"
            src="{!! asset('assets/plugins/image-preview/jquery.uploadPreview.min.js') !!}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            $('#about_us').summernote({
                height: 200,                 // set editor height
                minHeight: null,             // set minimum height of editor
                maxHeight: null,             // set maximum height of editor
                focus: false                 // set focus to editable area after initializing summernote
            });

            $.uploadPreview({
                input_field: "#image-upload",
                preview_box: "#image-preview",
                label_field: "#image-label"
            });
        });
    </script>
@stop