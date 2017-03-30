@extends('layouts.employee')
@section('title', 'Change current password')
@section('content')
    <div class="row" id="contacts">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="m-t-0 header-title"><b>Change password</b></h4>
                        <p class="text-muted font-13">
                            Please field in all required fill below to process your changing password.
                        </p>
                    </div>
                </div>
                <div class="row m-t-30">
                    {!! Form::open(['route' => 'employee.account-settings.change-password', 'class'=>'form-horizontal']) !!}
                    <div class="box-body">
                        <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                            <label for="current_password" class="col-md-2 control-label">Current password</label>
                            <div class="col-sm-10">
                                {{ Form::password('current_password', array('class' => 'form-control', 'placeholder'=>'Current password')) }}
                                @if ($errors->has('current_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {!! $errors->has('password') ? ' has-error' : '' !!}">
                            <label for="new_password" class="col-md-2 control-label">New Password</label>
                            <div class="col-sm-10">
                                {{ Form::password('password', array('class' => 'form-control', 'placeholder'=>'New password')) }}
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{!! $errors->has('confirm_new_password') ? ' has-error' : '' !!}">
                            <label for="confirm_new_password" class="col-md-2 control-label">Confirm New
                                Password</label>
                            <div class="col-sm-10">
                                {{ Form::password('confirm_new_password', array('class' => 'form-control', 'placeholder'=>'Confirm New password')) }}
                                @if ($errors->has('confirm_new_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('confirm_new_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox checkbox-primary">
                                    <input id="checkbox3" type="checkbox">
                                    <label for="checkbox3">
                                        Remind me change in 72 days
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <a href="#" class="btn btn-md btn-default">Cancel</a>
                                <button type="submit" class="btn btn-success waves-effect waves-light btn-md">
                                    Change now
                                </button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

