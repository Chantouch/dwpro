<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>Job Title</th>
            <th>Company</th>
            <th>Term</th>
            <th>Start-End</th>
            <th>Location</th>
            <th>Industry</th>
            <th>Job Role</th>
            <th>Career Level</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($auth->work_experience as $experience)
            <tr>
                <td>{!! $experience->job_title !!}</td>
                <td>{!! $experience->company_name !!}</td>
                <td>{!! Helper::relationship($experience->contract_type) !!}</td>
                <td>{!! $experience->start_date .'-'.$experience->end_data !!}</td>
                <td>{!! Helper::relationship($experience->city) !!},Cambodia</td>
                <td>{!! Helper::relationship($experience->industry) !!}</td>
                <td>{!! Helper::relationship($experience->functions) !!}</td>
                <td>{!! Helper::relationship($experience->level) !!}</td>
                <td>{!! $experience->description !!}</td>
                <td>
                    {!! Form::open(['route' => ['candidate.experiences.destroy', $experience->hashid], 'method' => 'delete']) !!}
                    <a href="{!! route('candidate.experiences.edit', [$experience->hashid]) !!}"
                       class='btn btn-default btn-xs waves-effect waves-light'>
                        <i class="glyphicon glyphicon-edit"></i>
                    </a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs waves-effect waves-light', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>