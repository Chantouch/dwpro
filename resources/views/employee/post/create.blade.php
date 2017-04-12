@extends('layouts.employee')
@section('title', 'Posts List')
@section('css-plugins')
    <!-- Plugins css-->
    {{--<link href="{!! asset('assets/plugins/summernote/dist/summernote.css') !!}" rel="stylesheet"/>--}}
    <link href="{!! asset('assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') !!}" rel="stylesheet"/>
    <link href="{!! asset('assets/plugins/switchery/dist/switchery.min.css') !!}" rel="stylesheet"/>
    <link href="{!! asset('assets/plugins/multiselect/css/multi-select.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('assets/plugins/select2/select2.css') !!}" rel="stylesheet" type="text/css"/>
    <link href="{!! asset('assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css') !!}" rel="stylesheet"/>
    <link href="{!! asset('assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') !!}"
          rel="stylesheet"/>
@stop
@section('styles')
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <link href="{!! asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') !!}"
          rel="stylesheet"/>
@stop
@section('content')
    <div class="col-sm-12" id="create-post">
        <div class="card-box">
            <div class="row">
                {!! Form::open(array('route' => 'employee.posts.store','method'=>'POST', 'class'=> '', 'role'=> 'form')) !!}
                @include('employee.post.field')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="{!! asset('assets/plugins/notifyjs/dist/notify.min.js') !!}"></script>
    <script src="{!! asset('assets/plugins/notifications/notify-metro.js') !!}"></script>
    <script src="{!! asset('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') !!}"></script>
    <script src="{!! asset('js/controller/employees/post.js') !!}"></script>
    <script src="{!! asset('assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') !!}"></script>
    <script src="{!! asset('assets/plugins/switchery/dist/switchery.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('assets/plugins/multiselect/js/jquery.multi-select.js') !!}"></script>
    <script type="text/javascript"
            src="{!! asset('assets/plugins/jquery-quicksearch/jquery.quicksearch.js') !!}"></script>
    <script src="{!! asset('assets/plugins/select2/select2.min.js') !!}" type="text/javascript"></script>
    <script src="{!! asset('assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js') !!}"
            type="text/javascript"></script>
    <script src="{!! asset('assets/plugins/bootstrap-filestyle/src/bootstrap-filestyle.min.js') !!}"
            type="text/javascript"></script>
    <script src="{!! asset('assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') !!}"
            type="text/javascript"></script>
    <script src="{!! asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') !!}"
            type="text/javascript"></script>
    {{--<script src="{!! asset('assets/plugins/summernote/dist/summernote.min.js') !!}"></script>--}}
    <script>
        $(".date").datepicker();
        $("#language_id").select2({
            placeholder: "Choose...",
            allowClear: true
        });
        jQuery(document).ready(function () {

            $('.summernote').summernote({
                height: 200,                 // set editor height
                minHeight: null,             // set minimum height of editor
                maxHeight: null,             // set maximum height of editor
                focus: false                 // set focus to editable area after initializing summernote
            });
        });
    </script>
@stop