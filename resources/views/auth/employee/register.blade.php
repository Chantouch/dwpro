@extends('auth.employee.layout')
@section('styles')
    <style>
        .wrapper-page {
            width: 50%;
        }

        @media only screen and (max-width: 768px) {
            .wrapper-page {
                width: 90%;
            }
        }

        @media only screen and (min-width: 768px) {
            .wrapper-page {
                width: 70%;
            }
        }
    </style>
@stop
@section('contents')
    <div class="wrapper-page">
        <div class=" card-box">
            <div class="panel-heading">
                <h3 class="text-center"> Sign Up to
                    <strong class="text-custom">{{ config('app.name', 'Laravel') }}</strong>
                </h3>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            <div class="panel-body">
                <form role="form" method="POST" action="{{ route('employee.register.account') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label for="first_name" class="control-label"></label>
                                {!! Form::text('first_name', null, ['class' => 'form-control','placeholder'=>'First name']) !!}
                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="control-label"></label>
                                {!! Form::text('email', null, ['class' => 'form-control','placeholder'=>'Email address']) !!}
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="control-label"></label>
                                {!! Form::password('password', ['class' => 'form-control','placeholder'=>'Password']) !!}
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <label for="last_name" class="control-label"></label>
                                {!! Form::text('last_name', null, ['class' => 'form-control','placeholder'=>'Last name']) !!}
                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                <label for="phone_number" class="control-label"></label>
                                {!! Form::text('phone_number', null, ['class' => 'form-control','placeholder'=>'Phone number']) !!}
                                @if ($errors->has('phone_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password_confirmation" class="control-label"></label>
                                {!! Form::password('password_confirmation', ['class' => 'form-control','placeholder'=>'Password confirmation']) !!}
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="form-group{{ $errors->has('terms') ? ' has-error' : '' }}">
                        <div class="checkbox checkbox-primary">
                            <input id="checkbox-signup" type="checkbox" checked="checked" name="terms">
                            <label for="checkbox-signup">I accept <a href="#">Terms and Conditions</a></label>
                        </div>
                        @if ($errors->has('terms'))
                            <span class="help-block">
                                <strong>{{ $errors->first('terms') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group text-center m-t-40">
                        <div class="col-xs-12">
                            <button class="btn btn-pink btn-block text-uppercase waves-effect waves-light"
                                    type="submit">
                                Register
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 text-center">
                Already have account?<a href="{!! route('employee.login') !!}" class="text-primary m-l-5"><b>Sign In</b></a>
            </div>
        </div>
    </div>
@stop