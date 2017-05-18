
<div class="form-group col-md-6 col-sm-6">
    <label for="job_title">Job Title</label>
    {!! Form::text('job_title', null, ['class' => 'form-control']) !!}
    <span class="error text-danger">            </span>
</div>
<div class="form-group col-md-6 col-sm-6">
    <label for="company_name">Company</label>
    {!! Form::text('company_name', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-md-6 col-sm-6">
    <label for="start_date">Start date</label>
    {!! Form::text('start_date', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-md-6 col-sm-6">
    <label for="end_date">End date</label>
    {!! Form::text('end_date', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-md-4 col-sm-6">
    <label for="country">Country</label>
    {!! Form::select('city_id', $cities, null,['class' => 'form-control select2', 'id'=>'cities']) !!}
</div>
<div class="form-group col-md-4 col-sm-6">
    <label for="city">City</label>
    {!! Form::select('city_id', $cities, null,['class' => 'form-control select2', 'id'=>'cities']) !!}
</div>
<div class="form-group col-md-4 col-sm-6">
    <label for="contract_type">Contract Type</label>
    {!! Form::select('contract_type_id', $contract_type, null,['class' => 'form-control select2']) !!}
</div>
<div class="form-group col-md-4 col-sm-6">
    <label for="industry">Industry</label>
    {!! Form::select('industry_id', $industries, null,['class' => 'form-control select2']) !!}
</div>
<div class="form-group col-md-4 col-sm-6">
    <label for="job_role">Job Role</label>
    {!! Form::select('function_id', $job_roles, null,['class' => 'form-control select2']) !!}
</div>
<div class="form-group col-md-4 col-sm-6">
    <label for="job_role">Career Level</label>
    {!! Form::select('level_id', $levels, null,['class' => 'form-control select2']) !!}
</div>
<div class="form-group col-md-12 col-sm-12">
    <label for="end_date">Description</label>
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>
<div class="from- col-md-12">
    <div class="pull-right">
        <button type="submit" class="btn btn-success">
            <i class="glyphicon glyphicon-floppy-save"></i> Submit
        </button>
        <button type="button" class="btn btn-default">
            <i class="glyphicon glyphicon-remove-circle"></i> Cancel
        </button>
    </div>
</div>
