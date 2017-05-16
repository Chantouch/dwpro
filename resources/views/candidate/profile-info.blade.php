<div class="col-md-7">
    <div class="clearfix complete-bar-width complete-bar">
        <div class="complete-bar-center">
            <h3 class="profile-completion-header">Profile Info</h3>
            <div class="row">
                <div class="col-md-4">
                    <div id="image-preview" style="background-image: url('{!! $auth->avatar_path !!}')">
                        <label for="image-upload" id="image-label">Choose File</label>
                        {!! Form::file('logo_photo',['id'=>'image-upload']) !!}
                    </div>
                    @if ($errors->has('logo_photo'))
                        <span class="help-block">
                                    <strong>{{ $errors->first('logo_photo') }}</strong>
                                </span>
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="profile-info">
                        <p>Lives in: {!! Helper::relationship($auth->city) !!}</p>
                        <p>Email: {!! $auth->email !!}</p>
                        <p>Phone: {!! $auth->phone_number !!}</p>
                        <p>Gender: {!! Helper::show_gender($auth->gender) !!}</p>
                        <p>Address: @if($auth->profile != null) {!! $auth->profile->address !!} @else @endif</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Profile completion -->
<div class="col-md-5">
    <div class="clearfix complete-bar-width complete-bar">
        <div class="complete-bar-center">
            <h3 class="profile-completion-header">Profile Completion</h3>
            <div class="c100 p{!! $progress !!} green">
                <span>{!! $progress !!}%</span>
                <div class="slice">
                    <div class="bar"></div>
                    <div class="fill"></div>
                </div>
            </div>
        </div>
        <h4 class="profile-completion-level">Beginner</h4>
        <div class="profile-completion-tip">
            <div class="profile-completion-tip-header">Tip:</div>
            <div class="profile-completion-tip">Add your Work Experience and gain 30 points</div>
        </div>
    </div>
</div>