@extends('layouts.admin')
@section('styles')
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
@stop
@section('content')
    <div class="row" id="business">
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
                        <div class="form-inline m-b-20">
                            <div class="row">
                                <div class="col-sm-6 text-xs-center">
                                    <div class="form-group">
                                        <label class="control-label m-r-5">Show</label>
                                        <select id="filter-status" class="form-control input-sm"
                                                v-model="filter-status">
                                            <option value="">All</option>
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="200">200</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 text-xs-center text-right">
                                    <div class="form-group">
                                        <input id="searchName" type="text" placeholder="Search"
                                               class="form-control input-sm" autocomplete="on" name="searchName"
                                               v-model="searchName">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered m-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th width="87">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="item in filterItem">
                                <td scope="row">@{{ item.id }}</td>
                                <td>@{{ item.name }}</td>
                                <td>@{{ item.description | truncate }}</td>
                                <td>@{{ item.status }}</td>
                                <td>@{{ item.created_at | dateshow }}</td>
                                <td>@{{ item.updated_at | dateshow }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-default btn-xs waves-effect waves-light">
                                            <i class="glyphicon glyphicon-eye-open"></i></button>
                                        <button class="btn btn-default btn-xs waves-effect waves-light"
                                                @click.prevent="editItem(item)">
                                            <i class="glyphicon glyphicon-edit"></i></button>
                                        <button type="submit" class="btn btn-danger btn-xs waves-effect waves-light"
                                                @click.prevent="deleteItem(item)">
                                            <i class="glyphicon glyphicon-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr v-if="!filterItem.length">
                                <th colspan="12">
                                    <span>No result was found for your search keyword!</span>
                                </th>
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
                                <li v-for="page in pagesNumber" v-bind:class="[ page == isActive ? 'active' : '']">
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
                                <h4 class="modal-title" id="myModalLabel">Edit Blog Post</h4>
                            </div>
                            <div class="modal-body">
                                <form method="POST" enctype="multipart/form-data"
                                      v-on:submit.prevent="updateItem(fillItem.id)">
                                    <div class="form-group">
                                        <label for="name">Title:</label>
                                        <input type="text" name="name" class="form-control" v-model="fillItem.name"/>
                                        <span v-if="formErrorsUpdate['name']" class="error text-danger">
                                          @{{ formErrorsUpdate['name'] }}
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description:</label>
                                        <textarea name="description" class="form-control"
                                                  v-model="fillItem.description">
                                        </textarea>
                                        <span v-if="formErrorsUpdate['description']" class="error text-danger">
                                          @{{ formErrorsUpdate['description'] }}
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
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="{!! asset('assets/plugins/notifyjs/dist/notify.min.js') !!}"></script>
    <script src="{!! asset('assets/plugins/notifications/notify-metro.js') !!}"></script>
    <script src="{!! asset('js/controller/modules/business.type.js') !!}"></script>
@stop

@push('plugins')
{{--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.js"></script>--}}
@endpush