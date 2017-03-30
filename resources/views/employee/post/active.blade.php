@extends('layouts.employee')
@section('title', 'Post in active list')
@section('styles')
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
@stop
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="m-t-0 header-title"><b>All Active Jobs</b></h4>
                        <p class="text-muted font-13">
                            All active jobs will be visible here.
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div class="pull-right">
                            <a href="{!! route('employee.posts.create') !!}" class="btn btn-primary">
                                <i class="ti-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-12">
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
                                        <td>{!! $post->salary !!}</td>
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
                                    <span>There is no active job that can be publish for now.</span>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="{!! asset('assets/plugins/notifyjs/dist/notify.min.js') !!}"></script>
    <script src="{!! asset('assets/plugins/notifications/notify-metro.js') !!}"></script>
@stop