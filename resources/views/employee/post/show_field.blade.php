<table class="table table-bordered">
    <tbody>
    <tr>
        <td class="bg-color-table">Year Of Exp</td>
        <td>{!! $job->year_experience !!} Year (s)</td>
        <td class="bg-color-table">Term</td>
        <td>{!! $job->contract_type->name !!}</td>
    </tr>
    <tr>
        <td class="bg-color-table">Hiring</td>
        <td>{!! $job->hire_number !!} Post(s)</td>
        <td class="bg-color-table">
            Function
        </td>
        <td>{!! $job->functions->name !!}</td>
    </tr>
    <tr>
        <td class="bg-color-table">Salary</td>
        <td>{{ $job->salary }}</td>
        <td class="bg-color-table">
            Industry
        </td>
        <td>{!! $job->industry->name !!}</td>
    </tr>
    <tr>
        <td class="bg-color-table">Gender</td>
        <td>{!! $job->gender !!}</td>
        <td class="bg-color-table">
            Qualification
        </td>
        <td>{!! $job->qualification->name !!}</td>
    </tr>
    <tr>
        <td class="bg-color-table">Age</td>
        <td>{!! $job->age_from !!} Years
            ~ {!! $job->age_to !!} Years
        </td>
        <td class="bg-color-table">
            Language
        </td>
        <td>
            @foreach($job->languages as $language)
                <span class="label label-success">
                    {!! $language->name !!}
                </span>
            @endforeach
        </td>
    </tr>
    <tr>
        <td class="bg-color-table">Published Date</td>
        <td>{!! \Carbon\Carbon::parse($job->published_date)->format('D-d-M-Y H:i A') !!}</td>
        <td class="bg-color-table">
            Closing Date
        </td>
        <td>{!! Carbon\Carbon::parse($job->closing_date)->format('D-d-M-Y H:i A') !!}</td>

    </tr>

    </tbody>
</table>
<div class="col-md-12">
    <h4><i class="fa fa-file-text-o m-r-5"></i>Responsibilities:</h4>
    <hr>
    <div class="minimize">
        <p>
            {!! $job->job_description !!}
        </p>
    </div>
    <h4><i class="fa fa-file-text-o m-r-5"></i>Requirements:</h4>
    <hr>
    <div class="minimize">
        <p>{!! $job->requirement_des !!}</p>
    </div>
</div>

<div class="row" style="margin-top:10px;">
    <div class="col-md-12 project-add-info">
        <a href="{!! route('employee.posts.index') !!}" class="btn btn-primary btn-sm"><span
                    class="glyphicon glyphicon-chevron-left"></span> BACK</a>
        <a href="{!! route('employee.posts.edit', [$job->hashid]) !!}" class="btn btn-success btn-sm"><span
                    class="glyphicon glyphicon-edit"></span> EDIT</a>
        @if($job->status==1)
            <a href="{!! route('employee.update_job.status_filled_up', [$job->hashid]) !!}"
               class="btn bg-orange btn-flat btn-sm">
                <i class="fa fa-archive"></i> &nbsp;Marked Status as Filled Up</a>
        @elseif($job->status==0 || $job->status==2)
            <a href="{!! route('employee.update_job.status_active', [$job->hashid]) !!}"
               class="btn bg-olive btn-flat btn-sm">
                <i class="fa fa-archive"></i> &nbsp;Marked Status as Active</a>
        @endif
        @if($job->status!=0)
            <a href="{!! route('employee.update_job.status_disabled', [$job->hashid]) !!}"
               class="btn btn-danger btn-flat btn-sm">
                <i class="fa fa-archive"></i> &nbsp;Marked Status as Disabled</a>
        @endif
    </div>
</div>

<div class="row" style="margin-top:20px">
    <div class="col-md-8 project-add-info col-md-offset-2">
        <i class="fa fa-bullseye"></i> Job Status {!! Helper::status($job->status) !!} | <i
                class="fa fa-calendar-check-o"></i> Job created at
        <strong>{{ date('d-m-Y h:i A', strtotime($job->created_at)) }}</strong> | <i
                class="fa fa-get-pocket"></i> Employer
        <strong>{{ $job->employee->company_profile->name }} </strong>
    </div>
</div>
