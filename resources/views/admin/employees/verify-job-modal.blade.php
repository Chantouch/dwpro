<!--
 * Created by PhpStorm.
 * User: Chantouch
 * Date: 3/8/2017
 * Time: 9:04 AM
-->
<!-- Edit Item Modal -->
<div class="modal fade" id="verify-job" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Review and Verify Job #@{{ fillItem.post_id }}</h4>
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
                        <label>Hire Number</label>
                        <input type="text" class="form-control" v-model="fillItem.hire_number"/>
                    </div>

                    <div class="form-group">
                        <label>Salary</label>
                        <input type="text" class="form-control" v-model="fillItem.salary"/>
                    </div>

                    <div class="form-group">
                        <label>Job Description</label>
                        <textarea name="job_description" id="" cols="30" rows="10" class="form-control"
                                  v-model="fillItem.job_description"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Year Experience</label>
                        <input type="text" class="form-control" v-model="fillItem.year_experience"/>
                    </div>

                    <div class="form-group">
                        <label>Field Of Study</label>
                        <input type="text" class="form-control" v-model="fillItem.field_of_study"/>
                    </div>

                    <div class="form-group">
                        <label>Published Date</label>
                        <input type="text" class="form-control" v-model="fillItem.published_date"/>
                    </div>

                    <div class="form-group">
                        <label>Marital Status</label>
                        <input type="text" class="form-control" v-model="fillItem.marital_status"/>
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea name="job_description" class="form-control"
                                  v-model="fillItem.job_description"></textarea>
                        <span v-if="formErrorsUpdate['job_description']" class="error text-danger">
                            @{{ formErrorsUpdate['job_description'] }}
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
                        <div class="radio radio-warning radio-inline">
                            <input type="radio" id="status3" value="2" name="status" v-model="fillItem.status">
                            <label for="status3"> Warning </label>
                        </div>
                        <div class="radio radio-danger radio-inline">
                            <input type="radio" id="status4" value="3" name="status" v-model="fillItem.status">
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
