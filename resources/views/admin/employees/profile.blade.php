@extends('layouts.admin')
@section('title', 'View employee\'s profile')
@section('styles')
    <link rel="stylesheet" href="{!! asset('css/apps.css') !!}">
@stop
@section('content')
    <section class="content-header">
        <h1 class="pull-left">Verification status
            <small> | @if($employee->verified_by == null) Not @endif Verified | Enrollment No:
                <strong> {{ $employee->company_profile->enroll_no }} </strong></small>
        </h1>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="#">Back</a>
        </h1>
    </section>
    <div class="row" id="business">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="row">
                    @include('admin.employees.profile_view')
                </div>
            </div>
        </div>
    </div>
@endsection


