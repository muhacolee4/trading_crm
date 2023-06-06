@extends('layouts.guest')
@section('title', 'Manager Login')
@section('styles')
@parent
@endsection

@section('content')
<section class=" auth">
        <div class="container">
            <div class="pb-3 row justify-content-center">

                <div class="col-12 col-md-6 col-lg-6 col-sm-10 col-xl-6">
                    <div class="text-center">
                       <a href="/"><img src="{{ asset('storage/app/public/'.$settings->logo)}}" alt="" class="mb-3 img-fluid auth__logo"></a> 
                    </div>
                    <x-danger-alert/>
                    <x-success-alert/>
                        
                    
                    <div class="bg-white shadow card login-page roundedd border-1 ">
                        <div class="card-body">
                            <h4 class="text-center card-title">Manager Login</h4>
                            <form method="POST" action="{{ route('adminlogin') }}"  class="mt-4 login-form">
                                 @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        @error('email')
                                        <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Your Email <span class="text-danger">*</span></label>
                                            <div class="position-relative">
                                                <i data-feather="mail" class="fea icon-sm icons"></i>
                                                <input type="email" class="pl-5 form-control" name ="email" value="{{ old('email') }}" id="email" placeholder="name@example.com" required>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Password <span class="text-danger">*</span></label>
                                            <div class="position-relative">
                                                <i data-feather="key" class="fea icon-sm icons"></i>
                                                <input type="password" class="pl-5 form-control" name="password" id="password" placeholder="Enter Password" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between">
                                            <div class="form-group">
                                                
                                            </div>
                                            <p class="mb-0 forgot-pass"><a href="{{ route('admin.forgetpassword') }}"
                                                    class="text-dark font-weight-bold">Forgot password ?</a></p>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="mb-0 col-lg-12">
                                        <button class="btn btn-primary btn-block pad" type="submit">Sign in</button>
                                    </div>
                                    <!--end col-->
                                    
                                    <div class="text-center col-12">
                                        <p class="mt-4 mb-0"><small class="mr-2 text-dark">&copy; Copyright  {{date('Y')}} &nbsp; {{$settings->site_name}} &nbsp; All Rights Reserved.</small>
                                        </p>
                                    </div>
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                    </div>
                    <!---->
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!--end section-->



@endsection

@section('scripts')
@parent

@endsection