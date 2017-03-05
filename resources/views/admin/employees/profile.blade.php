@extends('layouts.admin')
@section('title', 'View employee\'s profile')
@section('content')
    <section class="content-header">
        <h1 class="pull-left">Verification status
            <small> | @if($employer->verified_by==0) Not @endif Verified | Enrollment No:
                <strong> {{ $employer->employer_enrollment }} </strong></small>
        </h1>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="#">Back</a>
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                @include('admin.employees.profile_view')
            </div>
        </div>
    </div>
@endsection

