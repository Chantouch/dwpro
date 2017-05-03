<form role="form">
    <div class="form-group col-md-4 col-sm-6">
        <label for="skill">Skill</label>
        {!! Form::text('skill', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-md-4 col-sm-6">
        <label for="level">Level</label>
        {!! Form::select('level',$skill_level, null, ['class' => 'select2']) !!}
    </div>
    <div class="form-group col-md-4 col-sm-6">
        <label for="level">Year of Experience</label>
        {!! Form::select('level',$skill_year, null, ['class' => 'select2']) !!}
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
</form>