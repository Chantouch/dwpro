@extends('layouts.employee')
@section('title', "$job->name")
@section('page_specific_css')
    <style>
        .view-job .spacer-1 {
            height: 15px;
        }

        .job-field {
            padding: 6px 0;
            background: #f6f6f6;
            margin-bottom: 4px;
            font-weight: bold;
        }

        h4 {
            padding: 15px 0;
            text-decoration: underline;
        }

        .project-add-info {
            font-family: Century Gothic, CenturyGothic, AppleGothic, sans-serif;
            font-size: 14px;
        }

        .project-add-info .label {
            font-size: 14px;
        }
    </style>
@stop
@section('content')
    <section class="content-header">
        <h1>
            {!! $job->name !!}
        </h1>
    </section>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                @include('employee.post.show_field')
            </div>
        </div>
    </div>
@endsection
