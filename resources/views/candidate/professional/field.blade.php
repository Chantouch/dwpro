<div class="form-group col-md-4 col-sm-6">
    <label for="language">Skill</label>
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-md-4 col-sm-6">
    <label for="level">Level</label>
    {!! Form::select('level',$professional_level, null, ['class' => 'select2']) !!}
</div>


<div class="form-group col-md-4 col-sm-6">
    <label for="language">Years of Experience</label>
    {!! Form::select('year_exp',$year_exp, null, ['class' => 'select2']) !!}
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
