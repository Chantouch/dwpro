@extends('layouts.admin')
@section('title', 'View employee\'s profile')
@section('styles')
    <link rel="stylesheet" href="{!! asset('css/apps.css') !!}">
@stop
@section('content')
    <section class="content-header">
        <h3 class="pull-left">Verification status
            <small> | @if($employee->verified_by === null) Not @endif Verified | Enrollment No:
                <strong>
                    @if($employee->company_profile->enroll_no === null)
                        {{ $employee->company_profile->temp_enroll_no }}
                    @else
                        {{ $employee->company_profile->enroll_no }}
                    @endif
                </strong>
            </small>
        </h3>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="#">Back</a>
        </h1>
    </section>
    <div class="row" id="verify_job_status">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="row">
                    @include('admin.employees.profile_view')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('src-scripts')
<script src="{!! asset('js/controller/admin/employee/verify-job.js') !!}"></script>
@endpush


