@extends('layouts.guest')

@section('title', 'Account Login')
@section('content')
    <section style="height: 100vh;" class="d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card rounded border">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-7 d-none d-md-flex align-items-center justify-content-center">
                                    <div>
                                        <h2 class="mb-0">Welcome Back!</h2>
                                        <p class="">To keep you connected, please login with your personal info.</p>
                                        <img src="{{ asset('dash2/img/wave.gif') }}" alt="" class="w-100">
                                    </div>
                                </div>
                                <div class="col-md-5 pt-md-4">
                                    <div>
                                        <div class="text-center">
                                            <a href="/">
                                                <img src="{{ asset('storage/app/public/' . $settings->logo) }}"
                                                    alt="Logo" class="w-50">
                                            </a>
                                        </div>
                                        @if (Session::has('status'))
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                {{ session('status') }}
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <button type="button" class="text-white close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                    <h4 class="text-center card-title d-md-none d-block"> Log In</h4>
                                    <form method="POST" action="{{ route('login') }}" class="mt-4">
                                        @csrf
                                        <div class="form-group">
                                            <label>Your Email <span class="text-danger">*</span></label>
                                            <div class="position-relative">
                                                <i data-feather="mail" class="fea icon-sm icons"></i>
                                                <input type="email" class="pl-5 form-control" name="email"
                                                    value="{{ old('email') }}" id="email"
                                                    placeholder="name@example.com" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Password <span class="text-danger">*</span></label>
                                            <div class="position-relative">
                                                <i data-feather="key" class="fea icon-sm icons"></i>
                                                <input type="password" class="pl-5 form-control" name="password"
                                                    id="password" placeholder="Enter Password" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="d-flex justify-content-between">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck1"
                                                        name="remember">
                                                    <label class="custom-control-label" for="customCheck1">Remember
                                                        me</label>
                                                </div>
                                                <a href="{{ route('password.request') }}"
                                                    class="text-dark font-weight-bold">
                                                    <small>Forgot password ?</small>
                                                    
                                                </a>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-block pad" type="submit">Sign in</button>
                                        </div>
                                        @if ($settings->enable_social_login == 'yes')
                                        <div class="my-2 text-center col-lg-12">
                                           
                                                <small>Or</small>
                                                <div class="row">
                                                    <!--end col-->
                                                    <div class="col-12 my-3">
                                                        <a href="{{ route('social.redirect', ['social' => 'google']) }}" class="login-with-google-btn">
                                                            <i
                                                            class="mdi mdi-google text-danger"></i> Sign in with Google</a>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                        </div>
                                        @endif
                                        <div class="text-center form-group">
                                            <p class="mt-3 mb-0">
                                                <small class="mr-2 text-dark">Don't have an account?</small>
                                                <a href="{{ route('register') }}" class="text-dark font-weight-bold">Sign
                                                    Up</a>
                                            </p>
                                        </div>
                                    </form>
                                    <div class="text-center">
                                        <small class="text-dark" style="font-size: 11px">
                                            &copy; Copyright {{ date('Y') }} &nbsp; {{ $settings->site_name }}
                                            &nbsp;
                                            All Rights Reserved.
                                        </small>
                                    </div>
                                </div>
                            </div>

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

@endsection
