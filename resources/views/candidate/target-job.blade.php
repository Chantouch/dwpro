<form role="form">
    <div class="form-group col-md-4 col-sm-6">
        <label for="status">Employment Status</label>
        {!! Form::select('status',$cd_status, null, ['class' => 'select2']) !!}
    </div>
    <div class="form-group col-md-4 col-sm-6">
        <label for="contract_type">Contract Type</label>
        {!! Form::select('contract_type_id', $contract_type, null,['class' => '', 'id'=>'contract_type']) !!}
    </div>
    <div class="form-group col-md-4 col-sm-6">
        <label for="desired_salary">Desire Salary</label>
        {!! Form::select('desired_salary', $desired_salary, null,['class' => 'select2', 'id'=>'desired_salary']) !!}
    </div>

    <div class="form-group col-md-6 col-sm-6">
        <label for="area_of_interest">Area of Interest</label>
        {!! Form::select('industry_id', $industries, null,['class' => 'select2', 'id'=>'industries']) !!}
    </div>
    <div class="form-group col-md-6 col-sm-6">
        <label for="job_location">Job Location</label>
        {!! Form::select('city_id', $cities, null,['class' => 'select2', 'id'=>'cities']) !!}
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