@extends('layouts.backend.app')

@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>SETTINGS</h2>
    </div>
    <!-- Widgets -->

    <div class="row clearfix">
        <div class="col-xs-12 col-sm-3">
            <div class="card profile-card">
                <div class="profile-header">&nbsp;</div>
                <div class="profile-body">
                    <div class="image-area">
                        <img src="{{ Storage::disk('public')->url('profile/'.Auth::user()->image)}}" alt="{{ Auth::user()->name }}">
                    </div>
                    <div class="content-area">
                        <h3>{{ Auth::user()->name }}</h3>
                        <p>Web Software Developer</p>
                        <p>Administrator</p>
                    </div>
                </div>
                <div class="profile-footer">
                    <ul>
                        <li>
                            <span>Followers</span>
                            <span>1.234</span>
                        </li>
                        <li>
                            <span>Following</span>
                            <span>1.201</span>
                        </li>
                        <li>
                            <span>Friends</span>
                            <span>14.252</span>
                        </li>
                    </ul>
                    <button class="btn btn-primary btn-lg waves-effect btn-block">FOLLOW</button>
                </div>
            </div>

            <div class="card card-about-me">
                <div class="header">
                    <h2>ABOUT ME</h2>
                </div>
                <div class="body">
                    <ul>
                        <li>
                            <div class="title">
                                <i class="material-icons">library_books</i>
                                Education
                            </div>
                            <div class="content">
                                B.S. in Computer Science from the Green University of Bangladesh
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <i class="material-icons">location_on</i>
                                Location
                            </div>
                            <div class="content">
                                Dhaka, Bangladesh
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <i class="material-icons">edit</i>
                                Skills
                            </div>
                            <div class="content">
                                <span class="label bg-amber">Python</span>
                                <span class="label bg-red">UI Design</span>
                                <span class="label bg-teal">JavaScript</span>
                                <span class="label bg-amber">Node.js</span>
                                <span class="label bg-blue">PHP</span>
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <i class="material-icons">notes</i>
                                Description
                            </div>
                            <div class="content">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-9">
            <div class="card">
                <div class="body">
                    <div>
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#profile_settings" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="true">Profile Settings</a></li>
                            <li role="presentation" class=""><a href="#change_password_settings" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="false">Change Password</a></li>
                        </ul>

                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="profile_settings">
                                <form class="form-horizontal" method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">Full Name</label>
                                        <div class="col-sm-10">
                                            <div class="form-line focused">
                                                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" placeholder="Full Name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10">
                                            <div class="form-line focused">
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ Auth::user()->email }}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="image" class="col-sm-2 control-label">Image</label>

                                        <div class="col-sm-10">
                                            <div class="form-line">
                                                <input type="file" class="form-control" name="image" id="image" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="about" class="col-sm-2 control-label">About</label>

                                        <div class="col-sm-10">
                                            <div class="form-line">
                                                <textarea class="form-control" id="InputExperience" name="about" rows="3" placeholder="About">{{ Auth::user()->about }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="InputSkills" class="col-sm-2 control-label">Skills</label>

                                        <div class="col-sm-10">
                                            <div class="form-line">
                                                <input type="text" class="form-control" id="InputSkills" name="InputSkills" placeholder="Skills">
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <input type="checkbox" id="terms_condition_check" class="chk-col-red filled-in">
                                            <label for="terms_condition_check">I agree to the <a href="#">terms and conditions</a></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger">SUBMIT</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="change_password_settings">
                                <form class="form-horizontal" action="{{ route('admin.password.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="old_password" class="col-sm-3 control-label">Old Password</label>
                                        <div class="col-sm-9">
                                            <div class="form-line">
                                                <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Old Password" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="col-sm-3 control-label">New Password</label>
                                        <div class="col-sm-9">
                                            <div class="form-line">
                                                <input type="password" class="form-control" id="password" name="password" placeholder="New Password" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmed" class="col-sm-3 control-label">New Password (Confirm)</label>
                                        <div class="col-sm-9">
                                            <div class="form-line">
                                                <input type="password" class="form-control" id="password_confirmed" name="password_confirmation" placeholder="New Password (Confirm)" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <button type="submit" class="btn btn-danger">SUBMIT</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('js')
<!-- Jquery CountTo Plugin Js -->
<script src="{{ asset('backend/plugins/jquery-countto/jquery.countTo.js') }}"></script>
<!-- Morris Plugin Js -->
<script src="{{ asset('backend/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('backend/plugins/morrisjs/morris.js') }}"></script>
<!-- ChartJs -->
<script src="{{ asset('backend/plugins/chartjs/Chart.bundle.js') }}"></script>
<!-- Flot Charts Plugin Js -->
<script src="{{ asset('backend/plugins/flot-charts/jquery.flot.js') }}"></script>
<script src="{{ asset('backend/plugins/flot-charts/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('backend/plugins/flot-charts/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('backend/plugins/flot-charts/jquery.flot.categories.js') }}"></script>
<script src="{{ asset('backend/plugins/flot-charts/jquery.flot.time.js') }}"></script>
<!-- Sparkline Chart Plugin Js -->
<script src="{{ asset('backend/plugins/jquery-sparkline/jquery.sparkline.js') }}"></script>
<!-- Custom Js -->
<script src="{{ asset('backend/js/admin.js') }}"></script>
<script src="{{ asset('backend/js/pages/index.js') }}"></script>
@endpush
