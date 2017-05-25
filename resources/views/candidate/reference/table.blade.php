<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Position</th>
            <th>Phone number</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($auth->reference as $reference)
            <tr>
                <td>{!! $reference->first_name !!}</td>
                <td>{!! $reference->last_name !!}</td>
                <td>{!! $reference->email !!}</td>
                <td>{!! $reference->position !!}</td>
                <td>{!! $reference->phone_number !!}</td>
                <td>
                    {!! Form::open(['route' => ['candidate.references.destroy', $reference->hashid], 'method' => 'delete']) !!}
                    <a href="{!! route('candidate.references.edit', [$reference->hashid]) !!}"
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