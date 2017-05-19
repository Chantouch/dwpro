<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>School</th>
            <th>Location</th>
            <th>Field of study</th>
            <th>Grad</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($auth->education as $edu)
            <tr>
                <td>{!! $edu->school_name !!}</td>
                <td>{!! Helper::relationship($edu->city) !!}, Cambodia</td>
                <td>{!! $edu->field_of_study !!}</td>
                <td>{!! $edu->grade !!}</td>
                <td>{!! $edu->description !!}</td>
                <td>
                    {!! Form::open(['route' => ['candidate.educations.destroy', $edu->hashid], 'method' => 'delete']) !!}
                    <a href="{!! route('candidate.educations.edit', [$edu->hashid]) !!}"
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