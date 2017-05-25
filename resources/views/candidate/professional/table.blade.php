<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Level</th>
            <th>Years</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($auth->professional as $professional)
            <tr>
                <td>{!! $professional->name !!}</td>
                <td>{!! Helper::professional_level_show($professional->level) !!}</td>
                <td>{!! Helper::year_exp_show($professional->year_exp) !!}</td>
                <td>
                    {!! Form::open(['route' => ['candidate.professionals.destroy', $professional->hashid], 'method' => 'delete']) !!}
                    <a href="{!! route('candidate.professionals.edit', [$professional->hashid]) !!}"
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