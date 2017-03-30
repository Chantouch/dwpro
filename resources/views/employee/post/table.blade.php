<table class="table table-bordered m-0">
    @if(count($posts))
        <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Level</th>
            <th>No.Of.Post</th>
            <th>Industry</th>
            <th>Qualification</th>
            <th>Salary</th>
            <th>Posted</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td scope="row">
                    <a href="{!! route('employee.posts.edit', [$post->hashid]) !!}">#{!! $post->post_id !!}</a>
                </td>
                <td>{!! $post->name !!}</td>
                <td>{!! $post->level->name !!}</td>
                <td>{!! $post->hire_number !!}</td>
                <td>{!! Helper::relationship($post->industry) !!}</td>
                <td>{!! Helper::relationship($post->qualification) !!}</td>
                <td>{!! Helper::show_salary($post->salary) !!}</td>
                <td>{!! $post->created_at->diffForHumans() !!}</td>
                <td>{!! Helper::status($post->status) !!}</td>
                <td>
                    {!! Form::open(['route' => ['employee.posts.destroy', $post->hashid], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('employee.posts.show', [$post->hashid]) !!}"
                           title="View job" class='btn btn-default btn-xs'>
                            <i class="glyphicon glyphicon-eye-open"></i></a>
                        @if($post->status == 1)
                            <a href="{!! route('employee.posts.edit', [$post->hashid]) !!}"
                               class='btn btn-default btn-xs'>
                                <i class="glyphicon glyphicon-edit"></i></a>
                        @endif
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    @else
        <tr>
            <span>There is no job that can be publish for now.</span>
        </tr>
    @endif
</table>