@extends('layouts.employee')
@section('title', 'Company profile')
@section('styles')
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    {{--<link href="{!! asset('assets/plugins/custombox/dist/custombox.min.css') !!}" rel="stylesheet">--}}
@stop
@section('content')
    <div class="wraper container-fluid" id="company-profile">
        <div class="row">
            <div class="col-sm-12">
                <div class="bg-picture text-center">
                    <div class="bg-picture-overlay"></div>
                    <div class="profile-info-name">
                        <img src="{!! asset('assets/images/users/avatar-1.jpg') !!}"
                             class="thumb-lg img-circle img-thumbnail"
                             alt="profile-image">
                        {{--<h4 class="m-b-5"><b>{!! $profile->name !!}</b></h4>--}}
                        <h4 class="m-b-5"><b v-if="profile.name != null">@{{ profile.name }}</b></h4>
                        {{--<p class="text-muted" v-if="profile.address != null"><i class="fa fa-map-marker"></i> {!! $profile->address !!}</p>--}}
                        <p class="text-muted" v-if="profile.address != null">
                            <i class="fa fa-map-marker"></i> @{{ profile.address }}</p>
                    </div>
                </div>
                <!--/ meta -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card-box m-t-20">
                    <div class="row">
                        <div class="col-sm-10">
                            <h4 class="m-t-0 header-title"><b>Quick Facts</b></h4>
                        </div>
                        <div class="col-sm-2">
                            <a @click.prevent="editProfile('quick_facts')"
                               class="btn btn-success btn-sm pull-right waves-effect waves-light">
                                <i class="md md-mode-edit"></i></a>
                        </div>
                    </div>
                    <div class="p-20">
                        <div class="about-info-p">
                            <strong>Industry</strong>
                            <br>
                            {{--<p class="text-muted">{{ Helper::relationship($profile->industry) }}</p>--}}
                            <p class="text-muted" v-if="profile.industry != null">@{{ profile.industry.name  }}</p>
                            <p class="text-muted" v-else=""></p>
                        </div>
                        <div class="about-info-p">
                            <strong>Business Type</strong>
                            <br>
                            {{--<p class="text-muted">{!! Helper::relationship($profile->business_type) !!}</p>--}}
                            <p class="text-muted"
                               v-if="profile.business_type != null">@{{ profile.business_type.name }}</p>
                            <p class="text-muted" v-else=""></p>
                        </div>
                        <div class="about-info-p">
                            <strong>Staff</strong>
                            <br>
                            {{--<p class="text-muted">{!! $profile->number_employee !!}</p>--}}
                            <p class="text-muted">@{{ profile.number_employee }}</p>
                        </div>
                    </div>
                </div>

                <div class="card-box m-t-20">
                    <div class="row">
                        <div class="col-sm-10">
                            <h4 class="m-t-0 header-title"><b>About Us</b></h4>
                        </div>
                        <div class="col-sm-2">
                            <a @click.prevent="editProfile('about_us')"
                               class="btn btn-success btn-sm pull-right waves-effect waves-light">
                                <i class="md md-mode-edit"></i></a>
                        </div>
                    </div>
                    <div class="p-20">
                        {{--<p>{!! $profile->about_us !!}</p>--}}
                        <p v-if="profile.about_us">@{{ profile.about_us }}</p>
                        <p v-else=""></p>
                    </div>
                </div>

                <!-- Personal-Information -->
                <div class="card-box">
                    <div class="row">
                        <div class="col-sm-10">
                            <h4 class="m-t-0 header-title"><b>How We Work?</b></h4>
                        </div>
                        <div class="col-sm-2">
                            <a @click.prevent="editProfile('how_we_work')"
                               class="btn btn-success btn-sm pull-right waves-effect waves-light">
                                <i class="md md-mode-edit"></i></a>
                        </div>
                    </div>
                    <div class="p-20">
                        {{--<p>{!! $profile->how_we_work !!}</p>--}}
                        <p v-if="profile.how_we_work != null">@{{ profile.how_we_work }}</p>
                    </div>
                </div>
                <!-- Personal-Information -->

                <!-- Personal-Information -->
                <div class="card-box">
                    <div class="row">
                        <div class="col-sm-10">
                            <h4 class="m-t-0 header-title"><b>Who We Are Looking For?</b></h4>
                        </div>
                        <div class="col-sm-2">
                            <a @click.prevent="editProfile('looking_for')"
                               class="btn btn-success btn-sm pull-right waves-effect waves-light">
                                <i class="md md-mode-edit"></i></a>
                        </div>
                    </div>
                    <div class="p-20">
                        {{--<p>{!! $profile->looking_for !!}</p>--}}
                        <p v-if="profile.looking_for != null">@{{ profile.looking_for }}</p>
                    </div>
                </div>
                <!-- Personal-Information -->
                <div class="card-box">
                    <div class="row">
                        <div class="col-sm-10">
                            <h4 class="m-t-0 header-title"><b>Google Maps</b></h4>
                        </div>
                        <div class="col-sm-2">
                            <a @click.prevent="editProfile('google_maps')"
                               class="btn btn-success btn-sm pull-right waves-effect waves-light">
                                <i class="md md-mode-edit"></i></a>
                        </div>
                    </div>
                    <div class="p-20">
                        <div class="about-info-p">
                            <strong>Longitude</strong>
                            <br>
                            {{--<p class="text-muted">{!! $profile->longitude !!}</p>--}}
                            <p class="text-muted" v-if="profile.longitude">@{{ profile.longitude }}</p>
                        </div>
                        <div class="about-info-p">
                            <strong>Latitude</strong>
                            <br>
                            {{--<p class="text-muted">{!! $profile->latitude !!}</p>--}}
                            <p class="text-muted" v-if="profile.latitude">@{{ profile.latitude }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card-box m-t-20">
                    <div class="row">
                        <div class="col-sm-10">
                            <h4 class="m-t-0 header-title"><b>Company Information</b></h4>
                        </div>
                        <div class="col-sm-2">
                            <a @click.prevent="editProfile('company_information')"
                               class="btn btn-success btn-sm pull-right waves-effect waves-light">
                                <i class="md md-mode-edit"></i></a>
                        </div>
                    </div>
                    <div class="p-20">
                        <div class="about-info-p">
                            <strong>Name</strong>
                            <br>
                            {{--<p class="text-muted">{!! $profile->name !!}</p>--}}
                            <p class="text-muted" v-if="profile.name != null">@{{ profile.name }}</p>
                        </div>
                        <div class="about-info-p">
                            <strong>Mobile</strong>
                            <br>
                            {{--<p class="text-muted">{!! $profile->phone_number !!}</p>--}}
                            <p class="text-muted" v-if="profile.phone_number != null">@{{ profile.phone_number }}</p>
                        </div>
                        <div class="about-info-p">
                            <strong>Email</strong>
                            <br>
                            {{--<p class="text-muted">{!! $profile->company_email !!}</p>--}}
                            <p class="text-muted" v-if="profile.company_email != null">@{{ profile.company_email }}</p>
                        </div>
                        <div class="about-info-p m-b-0">
                            <strong>Location</strong>
                            <br>
                            {{--<p class="text-muted">{!! $profile->address !!}</p>--}}
                            <p class="text-muted" v-if="profile.address != null">@{{ profile.address }}</p>
                        </div>
                    </div>
                </div>

                <div class="card-box">
                    <h4 class="m-t-0 m-b-20 header-title"><b>My Office</b></h4>
                    {{--<div class="gmap">--}}
                    {{--<iframe height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"--}}
                    {{--src="http://maps.google.co.in/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Google+India+Bangalore,+Bennigana+Halli,+Bangalore,+Karnataka&amp;aq=0&amp;oq=google+&amp;sll=9.930582,78.12303&amp;sspn=0.192085,0.308647&amp;ie=UTF8&amp;hq=Google&amp;hnear=Bennigana+Halli,+Bangalore,+Bengaluru+Urban,+Karnataka&amp;t=m&amp;ll=12.993518,77.660294&amp;spn=0.012545,0.036006&amp;z=15&amp;output=embed"></iframe>--}}
                    {{--<iframe height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"--}}
                    {{--src="https://maps.google.com/maps?q='+{!! $profile->latitude  !!}+','+{!! $profile->longitude  !!}+'&hl=es;z=14&amp;output=embed"></iframe>--}}
                    {{--<br/>--}}
                    {{--</div>--}}
                    <br/>
                    <div class="gmap-info">
                        {{--<h4><b><a href="#" class="text-dark" v-if="profile.name">{!! $profile->name !!}</a></b></h4>--}}
                        <h4><b><a href="#" class="text-dark" v-if="profile.name">@{{ profile.name }}</a></b></h4>
                        {{--<p>{!! $profile->address !!}</p>--}}
                        <p v-if="profile.address">@{{ profile.address }}</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Modal -->
            @include('employee.component')
            {{-- Modal --}}
        </div>
    </div> <!-- container -->
@stop

@section('scripts')
    <script src="{!! asset('assets/plugins/notifyjs/dist/notify.min.js') !!}"></script>
    <script src="{!! asset('assets/plugins/notifications/notify-metro.js') !!}"></script>
    <!-- Modal-Effect -->
    {{--<script src="{!! asset('assets/plugins/custombox/dist/custombox.min.js') !!}"></script>--}}
    {{--<script src="{!! asset('assets/plugins/custombox/dist/custombox.legacy.min.js') !!}"></script>--}}
    <script src="{!! asset('js/controller/employees/company-profile.js') !!}"></script>
@stop