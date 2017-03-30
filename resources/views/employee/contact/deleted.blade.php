@extends('layouts.employee')
@section('title', 'Contacts List')
@section('styles')
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
@stop
@section('content')
    <div class="row" id="contacts">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="m-t-0 header-title"><b>All Deleted Contacts</b></h4>
                        <p class="text-muted font-13">
                            Included all jobs will be visible here.
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div class="pull-right">
                            <a href="#" class="btn btn-primary">
                                <i class="ti-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <table class="table table-bordered m-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>Position</th>
                                <th>Department</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(value, key, index) in contacts_deleted.data">
                                <td scope="row">@{{ key + 1 }}</td>
                                <td>@{{ value.name }}</td>
                                <td>@{{ value.phone_number }}</td>
                                <td>
                                    <span v-if="value.position">@{{ value.position.name }}</span>
                                </td>
                                <td>
                                    <span v-if="value.department">@{{ value.department.name }}</span>
                                </td>
                                <td>
                                    <span class="label label-danger">
                                        Deleted
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        {{--<a href="#" class="btn btn-default btn-xs waves-effect waves-light">--}}
                                            {{--<i class="glyphicon glyphicon-eye-open"></i></a>--}}
                                        {{--<a @click.prevent="editContact(value)"--}}
                                           {{--class="btn btn-default btn-xs waves-effect waves-light">--}}
                                            {{--<i class="glyphicon glyphicon-edit"></i></a>--}}
                                        <button type="submit" @click.prevent="restoreContact(value)"
                                                class="btn btn-danger btn-xs waves-effect waves-light">
                                            <i class="glyphicon glyphicon-refresh"></i></button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('employee.contact.edit')
    </div>
@stop

@section('scripts')
    <script src="{!! asset('assets/plugins/notifyjs/dist/notify.min.js') !!}"></script>
    <script src="{!! asset('assets/plugins/notifications/notify-metro.js') !!}"></script>
    <script src="{!! asset('js/controller/employees/contact.js') !!}"></script>
@stop