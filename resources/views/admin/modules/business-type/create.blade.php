@extends('layouts.admin')
@section('styles')
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
@stop
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="row">
                    {{--<create-business-type></create-business-type>--}}
                    {!! Form::open(array('route' => 'admin.modules.business-types.store','method'=>'POST','class'=>'','role'=>'form')) !!}

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group{!! $errors->has('name') ? ' has-error' : '' !!}">
                            <label for="name" class="control-label"><strong>Name:</strong></label>
                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                            @if($errors->has('name'))
                                <span class="help-block">
                                    <strong>{!! $errors->first('name') !!}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group {!! $errors->has('description')? ' has-error' : '' !!}">
                            <label for="description" class="control-label"><strong>Description:</strong></label>
                            {!! Form::textarea('description', null, array('placeholder' => 'Description','class' => 'form-control description','id'=>'description')) !!}
                            <span class="help-block">
                                <strong>{!! $errors->first('description') !!}</strong>
                            </span>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="checkbox checkbox-primary">
                                {!! Form::hidden('status', '0',false) !!}
                                {!! Form::checkbox('status', '1', null) !!}
                                {!! Form::label('status', 'Status') !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary waves-effect"><i class="ti-save"></i> Submit
                            </button>
                            <a class="btn btn-primary waves-effect"
                               href="{{ route('admin.modules.business-types.index') }}"> Back</a>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{!! asset('assets/plugins/notifyjs/dist/notify.min.js') !!}"></script>
    <script src="{!! asset('assets/plugins/notifications/notify-metro.js') !!}"></script>
@stop