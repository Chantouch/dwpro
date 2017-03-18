<div class="box box-primary" id="jobs">
    <div class="box-header with-border">
        <h3 class="box-title">Post Description</h3>
    </div>
    <div class="box-body">
        <div class="row">
            <!-- Post Name Field -->
            <div class="form-group col-sm-12">
                {!! Form::label('name', 'Post Title:') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'autofocus']) !!}
            </div>

            <!-- Responsible Description Field -->
            <div class="form-group col-sm-12 col-lg-12">
                {!! Form::label('job_description', 'Responsible Description:') !!}
                {!! Form::textarea('job_description', null, ['class' => 'form-control textarea', 'rows'=>'5']) !!}
            </div>

            <!-- Requirement Description Field -->
            <div class="form-group col-sm-12 col-lg-12">
                {!! Form::label('requirement_des', 'Requirement Description:') !!}
                {!! Form::textarea('requirement_des', null, ['class' => 'form-control textarea', 'rows'=>'5']) !!}
            </div>

            <div class="form-group col-sm-6">
                {!! Form::label('functions_id', 'Function:') !!}
                {!! Form::select('functions_id',$functions, null, ['class' => 'form-control','placeholder'=>'--Select function--']) !!}
            </div>

            <div class="form-group col-sm-6">
                {!! Form::label('contract_type_id', 'Contract Type:') !!}
                {!! Form::select('contract_type_id',$contract, null, ['class' => 'form-control','placeholder'=>'--Select contract type--']) !!}
            </div>

            <div class="form-group col-sm-6" id="salary">
                {!! Form::label('salary', 'Salary:') !!}
                {!! Form::text('salary', null, ['class' => 'form-control', 'id'=> 'salary']) !!}
            </div>

            <div class="form-group col-sm-6">
                {!! Form::label('is_negotiable', 'Negotiable:') !!}
                <label class="checkbox-inline">
                    {!! Form::hidden('is_negotiable', '0', false) !!}
                    {!! Form::checkbox('is_negotiable', '1', null, ['class'=> 'icheck', 'id'=> 'is_negotiable', 'onchange'=> 'checkbox(this)']) !!}
                    1
                </label>
            </div>

            <div class="form-group col-sm-6">
                {!! Form::label('hire_number', 'Number of Hiring:') !!}
                {!! Form::text('hire_number', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group col-sm-6">
                {!! Form::label('closing_date', 'Closing Date:') !!}
                {!! Form::text('closing_date', null, ['class' => 'form-control', 'placeholder'=>'yyyy-m-d']) !!}
            </div>

            <div class="form-group col-sm-6">
                {!! Form::label('city_id', 'City:') !!}
                {!! Form::select('city_id',$cities , null, ['class' => 'form-control','placeholder'=>'--Choose City--']) !!}
            </div>

            <div class="form-group col-sm-6">
                {!! Form::label('industry_id', 'Industry:') !!}
                {!! Form::select('industry_id', $industries, null, array('class' => 'form-control','placeholder'=>'--Select Industry--')) !!}
            </div>
        </div>
    </div>
</div>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Candidate Requirements</h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="form-group col-sm-6">
                {!! Form::label('level_id', 'Level:') !!}
                {!! Form::select('level_id',$levels , null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group col-sm-6">
                {!! Form::label('qualification_id', 'Qualification:') !!}
                {!! Form::select('qualification_id', $qualifications, null, ['class' => 'form-control','placeholder'=>'--Select Qualification--']) !!}
            </div>

            <div class="form-group col-sm-6">
                {!! Form::label('year_experience', 'Year Experience:') !!}
                {!! Form::select('year_experience',$year_experience , null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group col-sm-6">
                {!! Form::label('language_id[]', 'Language:') !!}
                {!! Form::select('language_id[]', $languages, null, [
                'class' => 'selectpicker', 'multiple'=>'multiple', 'data-style' => 'btn-success btn-custom',
                'data-selected-text-format'=>'count > 3', 'data-live-search' => 'true'
                ]) !!}
            </div>

            <div class="form-group col-sm-6">
                {!! Form::label('field_of_study', 'Field of Study:') !!}
                {!! Form::text('field_of_study', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group col-sm-6">
                {!! Form::label('gender', 'Gender:') !!}
                {!! Form::select('gender', $gender , null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group col-sm-6">
                {!! Form::label('marital_status', 'Martial Status:') !!}
                {!! Form::select('marital_status', $marital_status , null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group col-sm-6">
                {!! Form::label('age_from', 'Age Min:') !!}
                {!! Form::text('age_from', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group col-sm-6">
                {!! Form::label('age_to', 'Age Max:') !!}
                {!! Form::text('age_to', null, ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>
</div>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Contact Information</h3>
    </div>
    <div class="box-body">
        <div class="row">
            {{--<fieldset {!! is_null($emp->contacts) ? ' disabled' : '' !!}>--}}
            {{--<!-- Contact Person Field -->--}}
            {{--<div class="form-group col-sm-12 col-lg-12">--}}
            {{--{!! Form::label('contact_person_id', 'Contact Person:') !!}--}}
            {{--@if(!is_null($emp->contacts))--}}
            {{--{!! Form::select('contact_person_id',$contact_person, null, ['class' => 'form-control']) !!}--}}
            {{--@else--}}
            {{--{!! Form::text('contact_name', $emp->contact_name, ['class' => 'form-control']) !!}--}}
            {{--@endif--}}
            {{--</div>--}}

            {{--<div class="col-md-6">--}}
            {{--<div class="form-group">--}}
            {{--{!! Form::label('phone_number', 'Phone Number:') !!}--}}
            {{--@if(!is_null($emp->contacts))--}}
            {{--{!! Form::text('phone_number', null, ['class' => 'form-control']) !!}--}}
            {{--@else--}}
            {{--{!! Form::text('phone_number', $emp->contact_mobile_no, ['class' => 'form-control']) !!}--}}
            {{--@endif--}}
            {{--</div>--}}
            {{--<div class="form-group">--}}
            {{--{!! Form::label('web_address', 'Website:') !!}--}}
            {{--{!! Form::text('web_address', $emp->web_address, ['class' => 'form-control']) !!}--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-md-6">--}}
            {{--<div class="form-group">--}}
            {{--{!! Form::label('department_id', 'Department Name:') !!}--}}
            {{--@if(!is_null($emp->contacts))--}}
            {{--{!! Form::text('department_id', null, ['class' => 'form-control']) !!}--}}
            {{--@else--}}
            {{--{!! Form::text('department_id', 'Administrator', ['class' => 'form-control']) !!}--}}
            {{--@endif--}}
            {{--</div>--}}
            {{--<div class="form-group">--}}
            {{--{!! Form::label('email', 'Email:') !!}--}}
            {{--@if(!is_null($emp->contacts))--}}
            {{--{!! Form::email('email', null, ['class' => 'form-control']) !!}--}}
            {{--@else--}}
            {{--{!! Form::email('email', $emp->email, ['class' => 'form-control']) !!}--}}
            {{--@endif--}}
            {{--</div>--}}
            {{--</div>--}}

            {{--<div class="form-group col-md-12">--}}
            {{--{!! Form::label('address', 'Address:') !!}--}}
            {{--{!! Form::text('address', $emp->address, ['class' => 'form-control']) !!}--}}
            {{--</div>--}}
            {{--</fieldset>--}}
        </div>
    </div>
    <div class="box-footer">
        <div class="row">
            <!-- Submit Field -->
            <div class="form-group col-sm-12">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="#" class="btn btn-default">Cancel</a>
            </div>
        </div>
    </div>
</div>
