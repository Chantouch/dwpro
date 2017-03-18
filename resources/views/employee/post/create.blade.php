@extends('layouts.employee')
@section('title', 'Posts List')
@section('styles')
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <link href="{!! asset('assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css') !!}" rel="stylesheet" />
@stop
@section('content')
    <div class="col-sm-12">
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
    <script src="{!! asset('assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js') !!}" type="text/javascript"></script>
@stop