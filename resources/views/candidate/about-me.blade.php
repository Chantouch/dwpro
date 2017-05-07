<form method="POST" enctype="multipart/form-data" v-else-if="data.profile != null"
      v-on:submit.prevent="save_about">
    <div class="form-group col-md-12 col-sm-6">
        <textarea name="about_me" id="about_me" cols="30" rows="10"
                  class="form-control" v-model="fill_profile.about_me">
        </textarea>
        <span v-if="formErrors['about_me']" class="error text-danger">
            @{{ formErrors['about_me'] }}
        </span>
    </div>
    <div class="from- col-md-12">
        <div class="pull-right">
            <button type="submit" class="btn btn-success">
                <i class="glyphicon glyphicon-floppy-save"></i> Submit
            </button>
            <button type="button" class="btn btn-default" @click.prevent="editAboutMe('cancel')">
                <i class="glyphicon glyphicon-remove-circle"></i> Cancel
            </button>
        </div>
    </div>
</form>
<form method="POST" enctype="multipart/form-data" v-else=""
      v-on:submit.prevent="updateAboutMe('create_about_me')">
    <div class="form-group col-md-12 col-sm-6">
        <textarea name="about_me" id="about_me" cols="30" rows="10"
                  class="form-control" v-model="new_about_me.about_me" placeholder="Please enter your profile...">
        </textarea>
    </div>
    <div class="from- col-md-12">
        <div class="pull-right">
            <button type="submit" class="btn btn-success">
                <i class="glyphicon glyphicon-floppy-save"></i> Submit
            </button>
            <button type="button" class="btn btn-default" @click.prevent="editAboutMe('cancel')">
                <i class="glyphicon glyphicon-remove-circle"></i> Cancel
            </button>
        </div>
    </div>
</form>