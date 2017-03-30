<div class="modal fade" id="edit-contact" tabindex="-1" role="dialog"
     aria-labelledby="myContactLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myContactLabel">Update Contact Information</h4>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data"
                      v-on:submit.prevent="updateContact(fill_contact.id)">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" name="name" v-model="fill_contact.name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Mobile:</label>
                        <input type="text" class="form-control" name="phone_number" v-model="fill_contact.phone_number"
                               id="phone_number">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" name="email"
                               v-model="fill_contact.email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="department_id">Department:</label>
                        <select v-model="fill_contact.department_id" name="department_id"
                                class="form-control">
                            <option v-for="obj in department" v-bind:value="obj.id">@{{obj.name}}</option>
                            {{--v-bind::selected="obj.id=={{json_encode($profile->industry)}}?true : false"--}}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="position_id">Position:</label>
                        <select v-model="fill_contact.position_id" name="position_id"
                                class="form-control">
                            <option v-for="obj in position" v-bind:value="obj.id">@{{obj.name}}</option>
                            {{--v-bind::selected="obj.id=={{json_encode($profile->industry)}}?true : false"--}}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status" class="control-label">Status</label>
                        <input type="checkbox" id="status" v-model="fill_contact.status">
                    </div>
                    <div class="form-group pull-right">
                        <button type="button" class="btn btn-warning waves-effect waves-light" data-dismiss="modal"
                                aria-label="Close">
                            <i class="ti-back-left m-r-5"></i>Cancel
                        </button>
                        <button type="submit" class="btn btn-success waves-effect waves-light">
                            <i class="ti-save m-r-5"></i>Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>