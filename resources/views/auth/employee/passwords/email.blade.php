@extends('auth.employee.layout')

@section('styles')
    <style>
        .wrapper-page {
            width: 50%;
        }
    </style>
@stop

@section('contents')
    <div class="account-pages"></div>
    <div class="clearfix"></div>
    <div class="wrapper-page">
        <div class=" card-box">
            <div class="panel-heading">
                <h3 class="text-center"> Reset Password </h3>
            </div>
            <div class="panel-body">
                <form role="form" method="POST" action="{{ route('employee.password.email') }}">
                    {{ csrf_field() }}
                    @if (session('success'))
                        <div class="alert alert-info alert-dismissable text-center">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                ×
                            </button>
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissable text-center">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                ×
                            </button>
                            {{ session('error') }}
                        </div>
                    @endif
                    <p class="text-center">Enter your <b>Email</b> and instructions will be sent to you!</p>
                    <div class="form-group m-b-0{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="input-group">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                                   required>
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-pink w-sm waves-effect waves-light">
                                    Reset
                                </button>
                            </span>
                        </div>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group text-center">
                        <div class="col-md-12">
                            <a class="btn btn-link" href="{{ route('employee.login') }}">
                                Back to Login
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('scripts')

@stop