<form role="form">
    <div class="form-group col-md-6 col-sm-6">
        <label for="status">School/University</label>
        {!! Form::text('school_name', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-md-6 col-sm-6">
        <label for="degree_level">Degree Level</label>
        {!! Form::select('level', $contract_type, null,['class' => 'select2']) !!}
    </div>
    <div class="form-group col-md-6 col-sm-6">
        <label for="start_date">Start date</label>
        {!! Form::text('start_date', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-md-6 col-sm-6">
        <label for="end_date">End date</label>
        {!! Form::text('end_date', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-md-6 col-sm-6">
        <label for="job_location">Country</label>
        {!! Form::select('city_id', $cities, null,['class' => 'select2', 'id'=>'cities']) !!}
    </div>

    <div class="form-group col-md-6 col-sm-6">
        <label for="field_of_study">Field of study</label>
        {!! Form::text('field_of_study', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-md-6 col-sm-6">
        <label for="grade">Grade</label>
        {!! Form::text('grade', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-md-12 col-sm-12">
        <label for="description">Description</label>
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    </div>
    <div class="from- col-md-12">
        <div class="pull-right">
            <button type="submit" class="btn btn-success"><i
                        class="glyphicon glyphicon-floppy-save"></i> Submit
            </button>
            <button type="button" class="btn btn-default"><i
                        class="glyphicon glyphicon-remove-circle"></i> Cancel
            </button>
        </div>
    </div>
</form>