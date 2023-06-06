<?php
if (Auth('admin')->User()->dashboard_style == 'light') {
    $text = 'dark';
    $bg = 'light';
} else {
    $bg = 'dark';
    $text = 'light';
}
?>
@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel ">
        <div class="content ">
            <div class="page-inner">
                <p>
                    <a href="{{ route('kyc') }}">
                        <i class="p-2 rounded-lg fa fa-arrow-circle-left fa-2x bg-light"></i>
                    </a>
                </p>

                <div class="mt-2 mb-4 d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="title1 text-{{ $text }}">{{ $kyc->user->name }} KYC Application</h1>
                        @if ($kyc->status == 'Verified')
                            <span class="badge badge-success">Verified</span>
                        @else
                            <span class="badge badge-danger">{{ $kyc->status }}</span>
                        @endif
                    </div>
                    <a href="#" data-toggle="modal" data-target="#action" class="btn btn-primary btn-sm">Action</a>
                </div>
                <div id="action" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header ">
                                <h3 class="mb-2 d-inline text-{{ $text }}">Process KYC</h3>
                                <button type="button" class="close text-{{ $text }}" data-dismiss="modal"
                                    aria-h6="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body ">
                                <form action="{{ route('processkyc') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <select name="action" id="" class="form-control  text-{{ $text }}"
                                            required>
                                            <option value="Accept">Accept and verify user</option>
                                            <option value="Reject">Reject and remain unverified</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="message" placeholder="Enter Message " class="form-control  text-{{ $text }}" required>This is to inform you that following the documents you submited, your account have been verified. You can now enjoy all our services without restrictions. Cheers!!</textarea>
                                    </div>
                                    <div class="form-group">
                                        <h5 class="text-{{ $text }}">Email subject</h5>
                                        <input type="text" name="subject" id=""
                                            class="form-control  text-{{ $text }}"
                                            placeholder="Account is verified successfully" required>
                                    </div>
                                    <input type="hidden" name="kyc_id" value="{{ $kyc->id }}">
                                    <div class="form-group">
                                        <button type="submit" class="px-4 btn btn-primary"> Confirm </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /view KYC ID Modal -->
                <x-danger-alert />
                <x-success-alert />
                <div class="mb-5 row">
                    <div class="col-md-12">
                        <div class="card p-md-4 p-2 ">
                            <div class="card-body">
                                <div class="row">
                                    <div class="mb-3 col-md-12 border-bottom">
                                        <small class="text-primary">Personal Information</small>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <h2 class="text-{{ $text }}">{{ $kyc->first_name }}</h2>
                                        <small class="text-muted">First name</small>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <h2 class="text-{{ $text }}">{{ $kyc->last_name }}</h2>
                                        <small class="text-muted">Last name</small>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <h2 class="text-{{ $text }}">{{ $kyc->email }}</h2>
                                        <small class="text-muted">Email</small>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <h2 class="text-{{ $text }}">{{ $kyc->phone_number }}</h2>
                                        <small class="text-muted">Phone Number</small>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <h2 class="text-{{ $text }}">{{ $kyc->dob }}</h2>
                                        <small class="text-muted">Date of Birth</small>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <h2 class="text-{{ $text }}">{{ $kyc->social_media }}</h2>
                                        <small class="text-muted">Social Media username</small>
                                    </div>
                                    <div class="my-3 border-bottom col-md-12">
                                        <small class="text-primary">Address Information</small>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <h2 class="text-{{ $text }}">{{ $kyc->address }}</h2>
                                        <small class="text-muted">Address Line</small>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <h2 class="text-{{ $text }}">{{ $kyc->city }}</h2>
                                        <small class="text-muted">City</small>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <h2 class="text-{{ $text }}">{{ $kyc->state }}</h2>
                                        <small class="text-muted">State</small>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <h2 class="text-{{ $text }}">{{ $kyc->country }}</h2>
                                        <small class="text-muted">Nationality</small>
                                    </div>
                                    <div class="my-3 border-bottom col-md-12">
                                        <small class="text-primary">Document Information</small>
                                    </div>
                                    <div class="mb-5 col-md-12">
                                        <h2 class="text-{{ $text }}">{{ $kyc->document_type }}</h2>
                                        <small class="text-muted">Document type</small>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <img src="{{ asset('storage/app/public' . $kyc->frontimg) }}" alt=""
                                            class="w-50 img-fluid d-block">
                                        <small class="text-muted">Front View of Document</small>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <img src="{{ asset('storage/app/public' . $kyc->backimg) }}" alt=""
                                            class="w-50 img-fluid d-block">
                                        <small class="text-muted">Back View of Document</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
