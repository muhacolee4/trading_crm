@extends('layouts.dash')
@section('title', $title)
@section('content')
    <!-- Page title -->
    <div class="page-title">
        <div class="row justify-content-between align-items-center">
            <div class="mb-3 col-md-6 mb-md-0">
                <h5 class="mb-0 text-white h3 font-weight-400">Fund your account balance</h5>
            </div>
        </div>
    </div>
    <x-danger-alert />
    <x-success-alert />
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <form action="javascript:;" method="post" id="submitpaymentform">
                                @csrf
                                <div class="row">
                                    <div class="mb-4 col-md-12">
                                        <h5 class="card-title ">Enter Amount</h5>
                                        <input class="form-control " placeholder="Enter Amount"
                                            min="{{ $moresettings->minamt }}" type="number" name="amount" required>
                                    </div>
                                    <div class="mb-4 col-md-12">
                                        <input type="hidden" name="payment_method" id="paymethod">
                                    </div>
                                    <div class="mt-2 mb-1 col-md-12">
                                        <h5 class="card-title ">Choose Payment Method from the list below</h5>
                                    </div>
                                    @forelse ($dmethods as $method)
                                        <div class="mb-2 col-md-6">
                                            <a style="cursor: pointer;" data-method="{{ $method->name }}"
                                                id="{{ $method->id }}" class="text-decoration-none"
                                                onclick="checkpamethd(this.id)">
                                                <div class="rounded border">
                                                    <div
                                                        class="card-body d-flex justify-content-between align-items-center">
                                                        <span class="">
                                                            @if (!empty($method->img_url))
                                                                <img src="{{ $method->img_url }}" alt=""
                                                                    class="" style="width: 25px;">
                                                            @endif
                                                            {{ $method->name }}
                                                        </span>
                                                        <span>
                                                            <input type="radio" id="{{ $method->id }}customCheck1"
                                                                readonly>
                                                        </span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @empty
                                        <div class="mb-1 col-md-12">
                                            <p class="">No Payment Method enabled at the moment, please check
                                                back later.</p>
                                        </div>
                                    @endforelse
                                    @if (count($dmethods) > 0)
                                        <div class="mt-2 mb-1 col-md-12">
                                            <input type="submit" class="px-5 btn btn-primary btn-lg"
                                                value="Procced to Payment">
                                        </div>
                                        <input type="hidden" id="lastchosen" value="0">
                                    @endif
                                </div>
                            </form>
                        </div>
                        <div class="mt-4 col-md-4">
                            <!-- Seller -->
                            <div class="card">

                                <div class="card-body">
                                    <div class="pb-4">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <h6 class="mb-0">Total Deposit</h6>
                                                <span class="text-sm text-muted">-</span>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="mb-1">
                                                    <b>{{ $settings->currency }}{{ number_format($deposited, 2, '.', ',') }}
                                                    </b>
                                                </h6>
                                                <span class="text-sm text-muted">Amount</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="actions d-flex justify-content-between">
                                        <a href="{{ route('accounthistory') }}" class="action-item">
                                            <span class="btn-inner--icon">View deposit history</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('scripts')
        @parent
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <!-- Bootstrap Notify -->
        <script src="{{ asset('dash2/libs/bootstrap-notify/bootstrap-notify.min.js') }} "></script>

        @include('user.script')

    @endsection
@endsection
