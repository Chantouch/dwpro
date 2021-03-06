@extends('layouts.app')
@section('content')
    <div class="form-group row add">
        <div class="col-md-12">
            <h1>Crud</h1>
        </div>
        <div class="col-md-12">
            <button type="button" data-toggle="modal" data-target="#create-item" class="btn btn-primary">
                Create New Post
            </button>
        </div>
    </div>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-borderless">
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
                <tr v-for="item in items">
                    <td>@{{ item.title }}</td>
                    <td>@{{ item.description }}</td>
                    <td>
                        <button class="edit-modal btn btn-warning" @click.prevent="editItem(item)">
                            <span class="glyphicon glyphicon-edit"></span> Edit
                        </button>
                        <button class="edit-modal btn btn-danger" @click.prevent="deleteItem(item)">
                            <span class="glyphicon glyphicon-trash"></span> Delete
                        </button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <nav>
        <ul class="pagination">
            <li v-if="pagination.current_page > 1">
                <a href="#" aria-label="Previous" @click.prevent="changePage(pagination.current_page - 1)">
                    <span aria-hidden="true">«</span>
                </a>
            </li>
            <li v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '']">
                <a href="#" @click.prevent="changePage(page)">
                    @{{ page }}
                </a>
            </li>
            <li v-if="pagination.current_page < pagination.last_page">
                <a href="#" aria-label="Next" @click.prevent="changePage(pagination.current_page + 1)">
                    <span aria-hidden="true">»</span>
                </a>
            </li>
        </ul>
    </nav>
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
                            <input type="text" name="title" class="form-control" v-model="newItem.title"/>
                            <span v-if="formErrors['title']" class="error text-danger">
                                @{{ formErrors['title'] }}
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
                    <form method="POST" enctype="multipart/form-data" v-on:submit.prevent="updateItem(fillItem.id)">
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" name="title" class="form-control" v-model="fillItem.title"/>
                            <span v-if="formErrorsUpdate['title']" class="error text-danger">
                              @{{ formErrorsUpdate['title'] }}
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="title">Description:</label>
                            <textarea name="description" class="form-control" v-model="fillItem.description">
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
@stop

@push('src-scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<script type="text/javascript" src="{!! asset('js/vuejs/vue.js') !!}"></script>
<script src="https://cdn.jsdelivr.net/vue.resource/1.2.1/vue-resource.min.js"></script>
<script src="{!! asset('js/post.js') !!}"></script>
@endpush