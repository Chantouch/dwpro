@extends('layouts.employee')
@section('title', 'Posts List')
@section('styles')
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
@stop
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="m-t-0 header-title"><b>All Posted Jobs</b></h4>
                        <p class="text-muted font-13">
                            Included all jobs will be visible here.
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div class="pull-right">
                            <a href="{!! route('employee.posts.create') !!}"
                               class="btn btn-primary waves-effect waves-light">
                                <i class="ti-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        @include('employee.post.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="{!! asset('assets/plugins/notifyjs/dist/notify.min.js') !!}"></script>
    <script src="{!! asset('assets/plugins/notifications/notify-metro.js') !!}"></script>
@stop