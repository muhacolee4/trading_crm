@extends('layouts.dash')
@section('title', $title)
@section('content')
    <!-- Page title -->
    <div class="page-title">
        <div class="row justify-content-between align-items-center">
            <div class="mb-3 col-md-6 mb-md-0">
                <h5 class="mb-0 text-white h3 font-weight-400">Account Settings</h5>
            </div>
        </div>
    </div>
    <x-danger-alert />
    <x-success-alert />
    <x-error-alert />
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row profile">
                        <div class="p-2 col-md-12 p-md-4">
                            <ul class="mb-4 nav nav-pills bg-light p-2">
                                <li class="nav-item">
                                    <a href="#per" class="nav-link active" data-toggle="tab">Personal Settings</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#set" class="nav-link" data-toggle="tab">Withdrawal Settings</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#pas" class="nav-link" data-toggle="tab">Password/Security</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#sec" class="nav-link" data-toggle="tab">Other Settings</a>
                                </li>
                            </ul>
                            <div class="tab-content p-2 p-md-4">
                                <div class="tab-pane fade show active" id="per">
                                    @include('profile.update-profile-information-form')
                                </div>
                                <div class="tab-pane fade" id="set">
                                    @include('profile.update-withdrawal-method')
                                </div>
                                <div class="tab-pane fade" id="pas">
                                    @include('profile.update-password-form')
                                </div>
                                <div class="tab-pane fade" id="sec">
                                    @include('profile.update-security-form')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
