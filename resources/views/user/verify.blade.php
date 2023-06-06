
@extends('layouts.dash')
@section('title', $title)
@section('content')
    <!-- Page title -->
    <div class="page-title">
        <div class="row justify-content-between align-items-center">
            <div class="mb-3 col-md-6 mb-md-0">
                {{-- <h5 class="mb-0 text-white h3 font-weight-400">Account Verification</h5> --}}
            </div>
        </div>
    </div>
    <x-danger-alert/>
	<x-success-alert/>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-5 row">
                        <div class="col-lg-8 offset-lg-2">
                            <div class="p-3 text-center">
                                <h2 class="">KYC Verification</h2>
                                <p>To comply with regulation, each participant will have to go through indentity verification (KYC/AML) to prevent fraud causes.</p>
                            </div>
                            <div class="p-2 text-center shadow-lg p-md-5">
                                <i class="p-4 mb-3 fas fa-copy fa-4x bg-light rounded-pill"></i>
                                <p>You have not submitted your necessary documents to verify your identity. In order to enjoy our investment system, please verify your identity.</p>
                                
                                @if (Auth::user()->account_verify == 'Verified' or Auth::user()->account_verify == 'Under review')
                                    <button class="mt-2 btn btn-primary btn-sm" disabled>Click here to complete your KYC</button> <br>
                                    <small class="text-success">Your previous application is under review, please wait</small>
                                @else
                                <a href="{{ route('kycform') }}" class="mt-2 btn btn-primary btn-sm">Click here to complete your KYC</a>
                                @endif
                            </div>
                            <div class="p-2 mt-5 shadow-lg d-md-flex justify-content-between">
                                <div class="p-2">
                                    <i class="p-4 fas fa-envelope-open-text fa-4x bg-light rounded-pill"></i>
                                </div>
                                <div class="p-2">
                                    <h4>We’re here to help you!</h4>
                                    <p>Ask a question, manage request, report an issue. Our support team will get back to you by email.</p>
                                </div>
                                <div class="p-md-4">
                                    <a href="{{ route('support') }}" class="px-3 btn btn-outline-primary btn-sm">Get Support Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
@endsection
