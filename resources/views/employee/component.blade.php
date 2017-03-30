<div class="modal fade" id="edit-quick-facts" tabindex="-1" role="dialog"
     aria-labelledby="myQuickFactsLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myQuickFactsLabel">Edit Quick Facts</h4>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data"
                      v-on:submit.prevent="updateProfile('quick_facts')">
                    <div class="form-group">
                        <label for="name">Industry:</label>
                        <select v-model="fill_profile.industry_id" name="industry_id"
                                class="form-control">
                            <option v-for="obj in industry" v-bind:value="obj.id">@{{obj.name}}</option>
                            {{--v-bind::selected="obj.id=={{json_encode($profile->industry)}}?true : false"--}}
                        </select>
                        <span v-if="formErrorsUpdate['industry_id']" class="error text-danger">
                            @{{ formErrorsUpdate['industry_id'] }}
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="description">Business Type:</label>
                        <select name="business_type_id" id="business_tpe_id"
                                v-model="fill_profile.business_type_id" class="form-control">
                            <option v-for="obj in business_type"
                                    v-bind:value="obj.id">@{{ obj.name }}</option>
                        </select>
                        <span v-if="formErrorsUpdate['business_type_id']" class="error text-danger">
                            @{{ formErrorsUpdate['business_type_id'] }}
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="number_employee">Staff</label>
                        <input type="text" name="number_employee" class="form-control"
                               v-model="fill_profile.number_employee">
                    </div>
                    <div class="form-group pull-right">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-about-us" tabindex="-1" role="dialog"
     aria-labelledby="myAboutUs">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myAboutUs">Edit About Us</h4>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data"
                      v-on:submit.prevent="updateProfile('about_us')">
                    <div class="form-group">
                        <label for="about_us">About Us:</label>
                        <textarea name="about_us" id="about_us" cols="30" rows="10" class="form-control"
                                  v-model="fill_profile.about_us"></textarea>
                        {{--<span v-if="formErrorsUpdate['industry_id']" class="error text-danger">--}}
                        {{--@{{ formErrorsUpdate['industry_id'] }}--}}
                        {{--</span>--}}
                    </div>
                    <div class="form-group pull-right">
                        <button type="submit" class="btn btn-success"><i class="ti-save m-r-5"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-how-we-work" tabindex="-1" role="dialog"
     aria-labelledby="myHowWeWorkLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myHowWeWorkLabel">Edit How We Work</h4>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data"
                      v-on:submit.prevent="updateProfile('how_we_work')">
                    <div class="form-group">
                        <label for="about_us">How We Work:</label>
                        <textarea name="how_we_work" id="how_we_work" cols="30" rows="10" class="form-control"
                                  v-model="fill_profile.how_we_work"></textarea>
                        {{--<span v-if="formErrorsUpdate['industry_id']" class="error text-danger">--}}
                        {{--@{{ formErrorsUpdate['industry_id'] }}--}}
                        {{--</span>--}}
                    </div>
                    <div class="form-group pull-right">
                        <button type="submit" class="btn btn-success"><i class="ti-save m-r-5"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-looking-for" tabindex="-1" role="dialog"
     aria-labelledby="myLookingForLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myLookingForLabel">Edit Who we looking for?</h4>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data"
                      v-on:submit.prevent="updateProfile('looking_for')">
                    <div class="form-group">
                        <label for="about_us">Who we looking for:</label>
                        <textarea name="looking_for" id="looking_for" cols="30" rows="10" class="form-control"
                                  v-model="fill_profile.looking_for"></textarea>
                        {{--<span v-if="formErrorsUpdate['industry_id']" class="error text-danger">--}}
                        {{--@{{ formErrorsUpdate['industry_id'] }}--}}
                        {{--</span>--}}
                    </div>
                    <div class="form-group pull-right">
                        <button type="submit" class="btn btn-success"><i class="ti-save m-r-5"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{--Google Map--}}
<div class="modal fade" id="edit-google-maps" tabindex="-1" role="dialog"
     aria-labelledby="myGoogleMapsLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myGoogleMapsLabel">Edit Google map?</h4>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data"
                      v-on:submit.prevent="updateProfile('google_maps')">
                    <div class="form-group">
                        <label for="longitude">Longitude:</label>
                        <input type="text" class="form-control" name="longitude" v-model="fill_profile.longitude">
                        {{--<span v-if="formErrorsUpdate['industry_id']" class="error text-danger">--}}
                        {{--@{{ formErrorsUpdate['industry_id'] }}--}}
                        {{--</span>--}}
                    </div>

                    <div class="form-group">
                        <label for="latitude">Latitude:</label>
                        <input type="text" class="form-control" name="latitude" v-model="fill_profile.latitude">
                        {{--<span v-if="formErrorsUpdate['industry_id']" class="error text-danger">--}}
                        {{--@{{ formErrorsUpdate['industry_id'] }}--}}
                        {{--</span>--}}
                    </div>

                    <div class="form-group pull-right">
                        <button type="submit" class="btn btn-success"><i class="ti-save m-r-5"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{--Company Profile--}}
<div class="modal fade" id="edit-company-information" tabindex="-1" role="dialog"
     aria-labelledby="myCompanyProfileLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myCompanyProfileLabel">Company Information</h4>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data"
                      v-on:submit.prevent="updateProfile('company_information')">
                    <div class="form-group">
                        <label for="name">Company Name:</label>
                        <input type="text" class="form-control" name="name" v-model="fill_profile.name" id="name">
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Mobile:</label>
                        <input type="text" class="form-control" name="phone_number" v-model="fill_profile.phone_number"
                               id="phone_number">
                    </div>
                    <div class="form-group">
                        <label for="company_email">Email:</label>
                        <input type="text" class="form-control" name="company_email"
                               v-model="fill_profile.company_email" id="company_email">
                    </div>
                    <div class="form-group">
                        <label for="address">Location:</label>
                        <input type="text" class="form-control" name="address" v-model="fill_profile.address"
                               id="address">
                    </div>
                    <div class="form-group pull-right">
                        <button type="submit" class="btn btn-success"><i class="ti-save m-r-5"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>