<div class="box box-primary" id="jobs">
    <div class="col-sm-12">
        <div class="box-header with-border">
            <h3 class="box-title">Post Description</h3>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <!-- Post Name Field -->
                <div class="form-group col-sm-12 {{ $errors->has('name') ? ' has-error' : '' }}">
                    {!! Form::label('name', 'Post Title:') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'autofocus', 'v-model'=>'post.name']) !!}
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <!-- Responsible Description Field -->
                <div class="form-group col-sm-12 col-lg-12 {{ $errors->has('job_description') ? ' has-error' : '' }}">
                    {!! Form::label('job_description', 'Responsible Description:') !!}
                    {!! Form::textarea('job_description', null, ['class' => 'summernote', 'v-model'=>'post.job_description']) !!}
                    @if ($errors->has('job_description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('job_description') }}</strong>
                        </span>
                    @endif
                </div>

                <!-- Requirement Description Field -->
                <div class="form-group col-sm-12 col-lg-12">
                    {!! Form::label('requirement_des', 'Requirement Description:') !!}
                    {!! Form::textarea('requirement_des', null, ['class' => 'summernote', 'v-model'=>'post.requirement_des']) !!}
                </div>

                <div class="form-group col-sm-6 col-lg-4">
                    {!! Form::label('functions_id', 'Function:') !!}
                    {!! Form::select('functions_id',$functions, null, [
                    'class' => 'selectpicker', 'data-live-search' => 'true','data-style'=>'btn-white btn-md', 'v-model'=>'post.function_id'
                    ]) !!}
                </div>

                <div class="form-group col-sm-6 col-lg-4">
                    {!! Form::label('contract_type_id', 'Contract Type:') !!}
                    {!! Form::select('contract_type_id',$contract, null, [
                    'class' => 'selectpicker', 'data-live-search' => 'true', 'data-style'=>'btn-white btn-md', 'v-model'=>'post.contract_type_id'
                    ]) !!}
                </div>

                <div class="form-group col-sm-6 col-lg-4" id="salary">
                    {!! Form::label('salary', 'Salary:') !!}
                    {!! Form::select('salary',$salary , null, [
                    'class' => 'selectpicker', 'data-live-search' => 'true', 'data-style'=>'btn-white btn-md', 'v-model'=>'post.salary'
                    ]) !!}
                </div>

                <div class="form-group col-sm-6 col-lg-4 {{ $errors->has('hire_number') ? ' has-error' : '' }}">
                    {!! Form::label('hire_number', 'Number of Hiring:') !!}
                    {!! Form::text('hire_number', null, ['class' => 'form-control', 'v-model'=>'post.hire_number']) !!}
                    @if ($errors->has('hire_number'))
                        <span class="help-block">
                            <strong>{{ $errors->first('hire_number') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group col-sm-6 col-lg-4">
                    {!! Form::label('closed_date', 'Closing Date:') !!}
                    @if(!isset($job))
                        {!! Form::text('closed_date', $closing_date, ['class' => 'form-control', 'placeholder'=>'yyyy-m-d', 'v-model'=>'post.closing_date']) !!}
                    @else
                        {!! Form::text('closing_date', null, ['class' => 'form-control', 'placeholder'=>'yyyy-m-d']) !!}
                    @endif
                </div>

                <div class="form-group col-sm-6 col-lg-4">
                    {!! Form::label('city_id', 'City:') !!}
                    {!! Form::select('city_id',$cities , null, [
                    'class' => 'selectpicker', 'data-live-search' => 'true', 'data-style'=>'btn-white btn-md', 'v-model'=>'post.city_id'
                    ]) !!}
                </div>

                <div class="form-group col-sm-6 col-lg-4">
                    {!! Form::label('industry_id', 'Industry:') !!}
                    {!! Form::select('industry_id', $industries, null, [
                    'class' => 'selectpicker', 'data-live-search' => 'true','data-style'=>'btn-white btn-md', 'v-model'=>'post.industry_id'
                    ]) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="box box-primary">
    <div class="col-sm-12">
        <div class="box-header with-border">
            <h3 class="box-title">Candidate Requirements</h3>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group col-sm-6 col-lg-4">
                    {!! Form::label('level_id', 'Level:') !!}
                    {!! Form::select('level_id',$levels , null, [
                    'class' => 'selectpicker', 'data-live-search' => 'true',
                    'data-style'=>'btn-white btn-md', 'v-model'=>'post.level_id'
                    ]) !!}
                </div>

                <div class="form-group col-sm-6 col-lg-4">
                    {!! Form::label('qualification_id', 'Qualification:') !!}
                    {!! Form::select('qualification_id', $qualifications, null, [
                    'class' => 'selectpicker', 'data-live-search' => 'true', 'data-style'=>'btn-white btn-md', 'v-model'=>'post.qualification_id'
                    ]) !!}
                </div>

                <div class="form-group col-sm-6 col-lg-4">
                    {!! Form::label('year_experience', 'Year Experience:') !!}
                    {!! Form::select('year_experience',$year_experience , null, [
                    'class' => 'selectpicker', 'data-live-search' => 'true','data-style'=>'btn-white btn-md', 'v-model'=>'post.year_experience'
                    ]) !!}
                </div>

                <div class="form-group col-sm-6 col-lg-4">
                    {!! Form::label('field_of_study', 'Field of Study:') !!}
                    {!! Form::text('field_of_study', null, ['class' => 'form-control', 'v-model'=>'post.field_of_study']) !!}
                </div>

                <div class="form-group col-sm-6 col-lg-4">
                    {!! Form::label('gender', 'Gender:') !!}
                    {!! Form::select('gender', $gender , null, [
                    'class' => 'selectpicker', 'data-live-search' => 'true',
                    'data-style'=>'btn-white btn-md', 'v-model'=>'post.gender'
                    ]) !!}
                </div>
                <div class="form-group col-sm-6 col-lg-4">
                    {!! Form::label('marital_status', 'Martial Status:') !!}
                    {!! Form::select('marital_status', $marital_status , null, [
                    'class' => 'selectpicker', 'data-live-search' => 'true',
                    'data-style'=>'btn-white btn-md', 'v-model'=>'post.marital_status'
                    ]) !!}
                </div>

                <div class="form-group col-sm-6 col-lg-4 {{ $errors->has('age_from') ? ' has-error' : '' }}">
                    {!! Form::label('age_from', 'Age Min:') !!}
                    {!! Form::text('age_from', null, ['class' => 'form-control', 'v-model'=>'post.age_from']) !!}
                    @if ($errors->has('age_from'))
                        <span class="help-block">
                            <strong>{{ $errors->first('age_from') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group col-sm-6 col-lg-4 {{ $errors->has('age_to') ? ' has-error' : '' }}">
                    {!! Form::label('age_to', 'Age Max:') !!}
                    {!! Form::text('age_to', null, ['class' => 'form-control', 'v-model'=>'post.age_to']) !!}
                    @if ($errors->has('age_to'))
                        <span class="help-block">
                            <strong>{{ $errors->first('age_to') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group col-sm-12">
                    {!! Form::label('language_id[]', 'Language:') !!}
                    {{--{!! Form::select('language_id[]', $langs, null, [--}}
                    {{--'class' => 'selectpicker', 'data-live-search' => 'true', 'multiple'=>'multiple',--}}
                    {{--'data-selected-text-format'=>'count > 3','data-style'=>'btn-white btn-md'--}}
                    {{--]) !!}--}}
                    {!! Form::select('language_id[]', $langs, null, [
                    'class' => 'select2 select2-multiple', 'multiple'=>'true', 'id'=>'language_id'
                    ]) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="box box-primary">
    <div class="col-sm-12">
        <div class="box-header with-border">
            <h3 class="box-title">Contact Information</h3>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                {{--<fieldset {!! is_null($emp->contacts) ? ' disabled' : '' !!}>--}}
                {{--<!-- Contact Person Field -->--}}
                <div class="form-group col-sm-12 col-lg-12">
                    <select v-model="new_contact.contact_id" name="contact_id" @change.prevent="changeData()"
                            class="selectpicker" data-style="btn-white btn-md">
                        <option v-for="obj in contacts.data" v-bind:value="obj.id">@{{obj.name}}</option>
                    </select>
                </div>

                {{--<div class="form-group col-sm-6 col-lg-4">--}}
                {{--<label for="phone_number" class="control-label">--}}
                {{--Phone Number--}}
                {{--</label>--}}
                {{--<input type="text" class="form-control" name="phone_number" id="phone_number" v-model="new_contact.phone_number">--}}
                {{--</div>--}}
                {{--<div class="form-group col-sm-6 col-lg-4">--}}
                {{--<label for="department_id" class="control-label">--}}
                {{--Department--}}
                {{--</label>--}}
                {{--<input type="text" class="form-control" name="department_id" id="department_id">--}}
                {{--</div>--}}

            </div>
        </div>
    </div>
    <div class="box-footer">
        <div class="row">
            <div class="col-sm-12">
                <!-- Submit Field -->
                <div class="form-group col-sm-12">
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Preview + Post Job</button>
                    <button type="button" class="btn btn-primary waves-effect waves-light">
                        Save As Draft
                    </button>
                    <a href="{!! route('employee.posts.index') !!}" class="btn btn-default waves-effect waves-light">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>
