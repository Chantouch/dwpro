<div class="form-group col-md-6 col-sm-6">
    <label for="language">First Name</label>
    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-md-6 col-sm-6">
    <label for="language">Last Name</label>
    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-md-6 col-sm-6">
    <label for="language">Company/Establishment/Experience</label>
    {!! Form::text('company_name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-md-6 col-sm-6">
    <label for="language">Position</label>
    {!! Form::text('position', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-md-6 col-sm-6">
    <label for="language">Phone Number</label>
    {!! Form::text('phone_number', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-md-6 col-sm-6">
    <label for="language">Email</label>
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
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
