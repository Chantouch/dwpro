@extends('layouts.admin')
@section('title', 'Employees management')
@section('styles')
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
@stop
@section('content')
    <div class="row" id="un_active">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="m-t-0 header-title"><b>Bordered table</b></h4>
                        <p class="text-muted font-13">
                            Add <code>.table-bordered</code> for borders on all sides of the table and cells.
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div class="pull-right">
                            <button type="button" data-toggle="modal" data-target="#create-item"
                                    class="btn btn-primary">
                                <i class="ti-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <table class="table table-bordered m-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Verified Status</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="candidate in candidates">
                                <td scope="row">@{{ candidate.id }}</td>
                                <td>
                                    <a :href="'/admin/candidates/un-active/' + candidate.hashid + '/show'">@{{ candidate.first_name + ' ' + candidate.last_name }}</a>
                                </td>
                                <td>@{{ candidate.email }}</td>
                                <td>@{{ candidate.phone_number }}</td>
                                <td v-if="candidate.verified_by == null">N/A</td>
                                <td v-else="candidate.verified_by != null">@{{ candidate.verified_by.name }}</td>
                                <td v-if="candidate.status == 1"><span class="label label-success">Active</span></td>
                                <td v-else="candidate.status != 1"><span class="label label-danger">UnActive</span></td>
                                <td>@{{ candidate.created_at | dateshow }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-default btn-xs waves-effect waves-light">
                                            <i class="glyphicon glyphicon-eye-open"></i></button>
                                        <button class="btn btn-default btn-xs waves-effect waves-light"
                                                @click.prevent="editItem(candidate)">
                                            <i class="glyphicon glyphicon-edit"></i></button>
                                        <button type="submit" class="btn btn-danger btn-xs waves-effect waves-light"
                                                @click.prevent="deleteItem(candidate)">
                                            <i class="glyphicon glyphicon-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination" v-if="pagination.total > pagination.per_page">
                                <li v-if="pagination.current_page > 1">
                                    <a href="#" aria-label="Previous"
                                       @click.prevent="changePage(pagination.current_page - 1)">
                                        <span aria-hidden="true">«</span>
                                    </a>
                                </li>
                                <li v-for="page in pagesNumber" :class="[ page == isActive ? 'active' : '']">
                                    <a href="#" @click.prevent="changePage(page)">
                                        @{{ page }}
                                    </a>
                                </li>
                                <li v-if="pagination.current_page < pagination.last_page">
                                    <a href="#" aria-label="Next"
                                       @click.prevent="changePage(pagination.current_page + 1)">
                                        <span aria-hidden="true">»</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Create Item Modal -->
                <div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <h4 class="modal-title" id="myModalLabel">Create New Post</h4>
                            </div>
                            <div class="modal-body">
                                <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="createItem">
                                    <div class="form-group">
                                        <label for="title">Title:</label>
                                        <input type="text" name="name" class="form-control" v-model="newItem.name"/>
                                        <span v-if="formErrors['name']" class="error text-danger">
                                            @{{ formErrors['name'] }}
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Description:</label>
                                        <textarea name="description" class="form-control" v-model="newItem.description">
                                        </textarea>
                                        <span v-if="formErrors['description']" class="error text-danger">
                                            @{{ formErrors['description'] }}
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Item Modal -->
                <div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <h4 class="modal-title" id="myModalLabel">Review and Verify Candidate
                                    #@{{ fillItem.id }}</h4>
                            </div>
                            <div class="modal-body">
                                <form method="POST" enctype="multipart/form-data"
                                      v-on:submit.prevent="updateItem(fillItem.id)">
                                    <div class="form-group">
                                        <label for="name">First Name:</label>
                                        <input type="text" name="name" class="form-control"
                                               v-model="fillItem.first_name"/>
                                        <span v-if="formErrorsUpdate['first_name']" class="error text-danger">
                                          @{{ formErrorsUpdate['first_name'] }}
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Last Name:</label>
                                        <input name="description" class="form-control"
                                               v-model="fillItem.last_name">
                                        <span v-if="formErrorsUpdate['last_name']" class="error text-danger">
                                          @{{ formErrorsUpdate['last_name'] }}
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Email:</label>
                                        <input name="description" class="form-control"
                                               v-model="fillItem.email">
                                        <span v-if="formErrorsUpdate['email']" class="error text-danger">
                                          @{{ formErrorsUpdate['email'] }}
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Phone Number:</label>
                                        <input name="description" class="form-control"
                                               v-model="fillItem.phone_number">
                                        <span v-if="formErrorsUpdate['phone_number']" class="error text-danger">
                                          @{{ formErrorsUpdate['phone_number'] }}
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Date Of Birth:</label>
                                        <input name="description" class="form-control"
                                               v-model="fillItem.data_of_birth">
                                        <span v-if="formErrorsUpdate['data_of_birth']" class="error text-danger">
                                          @{{ formErrorsUpdate['data_of_birth'] }}
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <div class="radio radio-success radio-inline">
                                            <input type="radio" id="status2" value="1" name="status" v-model="fillItem.status">
                                            <label for="status2"> Enable </label>
                                        </div>
                                        <div class="radio radio-inline">
                                            <input type="radio" id="status1" value="0" name="status" v-model="fillItem.status">
                                            <label for="status1"> Disabled </label>
                                        </div>
                                        <div class="radio radio-danger radio-inline">
                                            <input type="radio" id="status4" value="2" name="status" v-model="fillItem.status">
                                            <label for="status4"> Suspend </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="{!! asset('assets/plugins/notifyjs/dist/notify.min.js') !!}"></script>
    <script src="{!! asset('assets/plugins/notifications/notify-metro.js') !!}"></script>
    <script src="{!! asset('js/controller/admin/candidate/un-active.js') !!}"></script>
@stop