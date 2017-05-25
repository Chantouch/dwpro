<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>Job Title</th>
            <th>Company</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($auth->language as $language)
            <tr>
                <td>{!! Helper::relationship($language->language) !!}</td>
                <td>{!! Helper::language_level_show($language->level) !!}</td>
                <td>
                    {!! Form::open(['route' => ['candidate.languages.destroy', $language->hashid], 'method' => 'delete']) !!}
                    <a href="{!! route('candidate.languages.edit', [$language->hashid]) !!}"
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