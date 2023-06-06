@extends('layouts.guest')

@section('title', 'Create an Account')

@section('content')
    <section style="height: auto;" class="d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row p-md-5 py-5">
                <div class="col-lg-12">
                    <div class="card rounded login-page">
                        <div class="card-body">
                            <div class="row pl-md-3">
                                <div
                                    class="col-md-5 d-none d-lg-flex align-items-center justify-content-center bg-primary rounded">
                                    <div class="text-center">
                                        <h2 class="text-white mb-0">Let's get you set up</h2>
                                        <p class="text-white p-2">It should only take a couple of minute to create your
                                            account.</p>
                                        <img src="{{ asset('dash2/img/account.webp') }}" alt="" class="w-75">
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="text-center">
                                        <a href="/">
                                            <img src="{{ asset('storage/app/public/' . $settings->logo) }}" alt="Logo"
                                                class="w-50">
                                        </a>
                                    </div>
                                    <div>
                                        @if (Session::has('status'))
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                {{ session('status') }}
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif

                                    </div>
                                    <form method="POST" action="{{ route('register') }}" class="mt-4 login-form">
                                        @csrf
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Username <span class="text-danger">*</span></label>
                                                    <div class="position-relative">
                                                        <i data-feather="user" class="fea icon-sm icons"></i>
                                                        <input type="text" id="input1" class="pl-5 form-control"
                                                            name="username" id="input1"
                                                            placeholder="Enter Unique Username" required>
                                                        @if ($errors->has('username'))
                                                            <small
                                                                class="text-danger">{{ $errors->first('username') }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Full Name <span class="text-danger">*</span></label>
                                                    <div class="position-relative">
                                                        <i data-feather="user-check" class="fea icon-sm icons"></i>
                                                        <input type="text" class="pl-5 form-control" name="name"
                                                            value="{{ old('name') }}" id="f_name"
                                                            placeholder="Enter FullName" required>

                                                        @if ($errors->has('name'))
                                                            <small class="text-danger">{{ $errors->first('name') }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email Address <span class="text-danger">*</span></label>
                                                    <div class="position-relative">
                                                        <i data-feather="mail" class="fea icon-sm icons"></i>
                                                        <input type="email" class="pl-5 form-control" name="email"
                                                            value="{{ old('email') }}" id="email"
                                                            placeholder="name@example.com" required>
                                                        @if ($errors->has('email'))
                                                            <small class="text-danger">{{ $errors->first('email') }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone Number <span class="text-danger">*</span></label>
                                                    <div class="position-relative">
                                                        <i data-feather="phone" class="fea icon-sm icons"></i>
                                                        <input type="phone" class="pl-5 form-control" name="phone"
                                                            value="{{ old('phone') }}" id="phone"
                                                            placeholder="Enter Phone number" required>
                                                        @if ($errors->has('phone'))
                                                            <small
                                                                class="text-danger">{{ $errors->first('phone') }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Password <span class="text-danger">*</span></label>
                                                    <div class="position-relative">
                                                        <i data-feather="key" class="fea icon-sm icons"></i>
                                                        <input type="password" class="pl-5 form-control" name="password"
                                                            id="password" placeholder="Enter Password" required>
                                                        @if ($errors->has('password'))
                                                            <small
                                                                class="text-danger">{{ $errors->first('password') }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Confirm Password <span class="text-danger">*</span></label>
                                                    <div class="position-relative">
                                                        <i data-feather="key" class="fea icon-sm icons"></i>
                                                        <input type="password" class="pl-5 form-control"
                                                            name="password_confirmation"
                                                            value="{{ old('password_confirmation') }}"
                                                            id="confirm-password" placeholder="Confirm Password" required>
                                                        @if ($errors->has('password'))
                                                            <small
                                                                class="text-danger">{{ $errors->first('password') }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Country <span class="text-danger">*</span></label>
                                                    <div class="position-relative">
                                                        <i data-feather="map-pin" class="fea icon-sm icons"></i>
                                                        <select
                                                            class="pl-5 d-block w-100 px-2 py-2 border border-light rounded-right"
                                                            name="country" id="country" required>
                                                            <option selected disabled>Choose Country</option>
                                                            @include('auth.countries')
                                                        </select>
                                                    </div>
                                                    @if ($errors->has('country'))
                                                        <small class="text-danger">{{ $errors->first('country') }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                            @if (Session::has('ref_by'))
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Referral ID <span class="text-danger">*</span></label>
                                                        <div class="position-relative">
                                                            <i data-feather="user" class="fea icon-sm icons"></i>
                                                            <input type="text" class="pl-5 form-control"
                                                                value="{{ session('ref_by') }}" name="ref_by"
                                                                placeholder="Optional referral id" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Referral ID</label>
                                                        <div class="position-relative">
                                                            <i data-feather="user" class="fea icon-sm icons"></i>
                                                            <input type="text" class="pl-5 form-control"
                                                                name="ref_by" placeholder="Optional referral id">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($settings->captcha == 'true')
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <div
                                                            class="{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                                            <label>Captcha<span class="text-danger">*</span></label>
                                                            <div class="position-relative">
                                                                {!! NoCaptcha::display() !!}
                                                                @if ($errors->has('g-recaptcha-response'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($terms->useterms == 'yes')
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input"
                                                                id="customCheck1" required>
                                                            <label class="custom-control-label" for="customCheck1">I
                                                                Accept the <a href="{{ route('privacy') }}"
                                                                    class="text-primary">Terms And Privacy Policy</a>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            <!--end col-->

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <button class="btn btn-primary btn-block pad"
                                                        type="submit">Register</button>
                                                </div>
                                            </div>
                                            @if ($settings->enable_social_login == 'yes')
                                                <div class="my-2 text-center col-lg-12">

                                                    <small>Or</small>
                                                    <div class="row">
                                                        <!--end col-->
                                                        <div class="col-12 my-3">
                                                            <a href="{{ route('social.redirect', ['social' => 'google']) }}"
                                                                class="login-with-google-btn">
                                                                <i class="mdi mdi-google text-danger"></i> Sign in with
                                                                Google</a>
                                                        </div>
                                                        <!--end col-->
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="text-center col-12">
                                                <p class="mb-0"><small class="mr-2 text-dark">Already have an account
                                                    </small> <a href="{{ route('login') }}"
                                                        class="text-dark font-weight-bold">Login</a></p>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
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
    <!--end section-->
@endsection

@section('scripts')
    @parent
    <script>
        $('#input1').on('keypress', function(e) {
            return e.which !== 32;
        });
    </script>
@endsection
