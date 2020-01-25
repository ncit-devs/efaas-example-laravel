@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-4">
                            <div class="list-group" id="list-tab" role="tablist">
                                <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Home</a>
                                <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Profile</a>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">Welcome to efaas</div>
                                <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">Name: {{ Auth::user()->name }}</li>
                                        <li class="list-group-item">Given Name: {{ Auth::user()->given_name }}</li>
                                        <li class="list-group-item">Family Name: {{ Auth::user()->family_name }}</li>
                                        <li class="list-group-item">Middle Name: {{ Auth::user()->middle_name }}</li>
                                        <li class="list-group-item">Gender: {{ Auth::user()->gender }}</li>
                                        <li class="list-group-item">NID: {{ Auth::user()->idnumber }}</li>
                                        <li class="list-group-item">Email: {{ Auth::user()->email }}</li>
                                        <li class="list-group-item">Phone Number: {{ Auth::user()->phone_number }}</li>
                                        <li class="list-group-item">Address: {{ Auth::user()->address }}</li>
                                        <li class="list-group-item">First Name Dhivehi: {{ Auth::user()->fname_dhivehi }}</li>
                                        <li class="list-group-item">Middle Name Dhivehi: {{ Auth::user()->mname_dhivehi }}</li>
                                        <li class="list-group-item">Last Name Dhivehi: {{ Auth::user()->lname_dhivehi }}</li>
                                        <li class="list-group-item">User Type: {{ Auth::user()->user_type }}</li>
                                        <li class="list-group-item">Verification Level: {{ Auth::user()->verification_level }}</li>
                                        <li class="list-group-item">User State: {{ Auth::user()->user_state }}</li>
                                        <li class="list-group-item">Birth Date: {{ Auth::user()->birthdate }}</li>
                                        <li class="list-group-item">Passport Number: {{ Auth::user()->passport_number }}</li>
                                        <li class="list-group-item">Work Permit Active: {{ Auth::user()->is_workpermit_active }}</li>
                                        <li class="list-group-item">Efaas Updated At: {{ Auth::user()->efaas_updated_at }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection