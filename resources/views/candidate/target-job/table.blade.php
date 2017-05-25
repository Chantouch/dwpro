<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>Status</th>
            <th>Contract type</th>
            <th>Desired Salary</th>
            <th>Area of interest</th>
            <th>Job Location</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            @if(!empty($auth->target_job))
                <td>{!! Helper::candidate_status_show($auth->target_job->status) !!}</td>
                <td>{!! Helper::relationship($auth->target_job->contract_type) !!}</td>
                <td>{!! Helper::show_salary($auth->target_job->desired_salary) !!}</td>
                <td>{!! Helper::relationship($auth->target_job->industry) !!}</td>
                <td>{!! Helper::relationship($auth->target_job->city) !!},Cambodia</td>
                <td>
                    {!! Form::open(['route' => ['candidate.target-jobs.destroy', $auth->target_job->hashid], 'method' => 'delete']) !!}
                    <a href="{!! route('candidate.target-jobs.edit', [$auth->target_job->hashid]) !!}"
                       class='btn btn-default btn-xs waves-effect waves-light'>
                        <i class="glyphicon glyphicon-edit"></i>
                    </a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs waves-effect waves-light', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    {!! Form::close() !!}
                </td>
            @endif
        </tr>
        </tbody>
    </table>
</div>