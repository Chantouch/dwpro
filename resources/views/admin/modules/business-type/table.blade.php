<div class="row" id="business_types">
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
                    <div class="p-20">
                        <table class="table table-bordered m-0">
                            <thead>
                            <tr>
                                <th @click.prevent="toggleOrder('id')">
                                    <a href="javascript:void (0)">
                                        <span>#</span>
                                        <span v-if="'id' === query.column">
                                            <span v-if="query.direction === 'desc'">&darr;</span>
                                            <span v-else="">&uarr;</span>
                                        </span>
                                    </a>
                                </th>
                                <th @click.prevent="toggleOrder('name')">
                                    <a href="javascript:void (0)">
                                        <span>Name</span>
                                        <span v-if="'name' === query.column">
                                            <span v-if="query.direction === 'desc'">&darr;</span>
                                            <span v-else="">&uarr;</span>
                                        </span>
                                    </a>
                                </th>
                                <th>Description</th>
                                <th>Status</th>
                                <th width="90">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="item in model.data">
                                <td scope="row">@{{ item.id }}</td>
                                <td>@{{ item.name }}</td>
                                <td>@{{ item.description }}</td>
                                <td>@{{ item.status }}</td>
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
                            </tbody>
                        </table>
                        <div class="row m-t-10">
                            <div class="col-sm-6">
                                <div class="footer-item">
                                    <span>Displaying @{{model.from}} - @{{model.to}} of @{{model.total}} rows</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="pull-right">
                                            <span>Rows per page</span>
                                            <input type="text" v-model="query.per_page" @keyup.enter="fetchIndexData()">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <button @click.prevent="prev()">&laquo;</button>
                                        <input type="text" v-model="query.page" @keyup.enter="fetchIndexData()">
                                        <button @click.prevent="next()">&raquo;</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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