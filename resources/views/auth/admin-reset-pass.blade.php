@extends('layouts.guest')
@section('title', 'Reset your password')
@section('content')
    <section class=" auth">
        <div class="container">
            <div class="pb-3 row justify-content-center">

                <div class="col-12 col-md-6 col-lg-6 col-sm-10 col-xl-6">

                    <div class="bg-white shadow card login-page roundedd border-1 ">
                        <div class="card-body">
                            <x-error-alert />
                            <x-danger-alert/>
                            <x-success-alert />
                            <div class="mb-2 row flex-between-center">
                                <div class="col-auto">
                                    <h5>Reset your account password?</h5>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('restpass') }}">
                                @csrf
                                <div class="mb-3">
                                    <input class="form-control" name="email" type="email" value="{{ $email }}"
                                        placeholder="Email address" readonly />
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input class="form-control" type="number" name="token" placeholder="Token" />
                                    @error('token')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input class="form-control" name="password" type="password"
                                        placeholder="New Password" />
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input class="form-control" name="password_confirmation" type="password"
                                        placeholder="New Password Confirmation" />
                                    @error('password_confirmation')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3"><button class="mt-3 btn btn-primary d-block w-100" type="submit"
                                        name="submit">Reset Password</button></div>
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
