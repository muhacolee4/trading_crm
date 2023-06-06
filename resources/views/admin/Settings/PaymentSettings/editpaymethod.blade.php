<?php
if (Auth('admin')->User()->dashboard_style == 'light') {
    $text = 'dark';
    $bg = 'light';
} else {
    $text = 'light';
    $bg = 'dark';
}
?>
@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel ">
        <div class="content ">
            <div class="page-inner">
                <div class="mt-2 mb-4">
                    <h1 class="title1 d-inline ">Update Payment method</h1>
                    <div class="d-inline">
                        <div class="float-right btn-group">
                            <a class="btn btn-primary btn-sm" href="{{ route('paymentview') }}"> <i
                                    class="fa fa-arrow-left"></i> back</a>
                        </div>
                    </div>
                </div>
                <x-danger-alert />
                <x-success-alert />

                <div class="mb-5 row">
                    <div class="col-md-8 offset-md-2">
                        @if ($method->name == 'USDT')
                            <p class="text-{{ $text }}">
                                For your users to be able to withdraw via USDT when you use Binance as your merchant and you
                                set withdrawal to automatic, you need to whitelist their ip address, else they will not be
                                able to withdraw. To do that, check users login activities from manage users then collect
                                their IP address and whitelist it on your Binance merchant dashboard.
                            </p>
                        @endif
                        <form method="POST" action="{{ route('updatemethod') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <h6 class="">Name</h6>
                                    @if ($method->name == 'Bitcoin' or
                                        $method->name == 'Ethereum' or
                                        $method->name == 'Litecoin' or
                                        $method->name == 'Paypal' or
                                        $method->name == 'Bank Transfer' or
                                        $method->name == 'Credit Card' or
                                        $method->name == 'USDT' or
                                        $method->name == 'BUSD')
                                        <input type="text" class="form-control  " name="name"
                                            placeholder="Payment method name" value="{{ $method->name }}" readonly>
                                    @else
                                        <input type="text" class="form-control  " name="name"
                                            placeholder="Payment method name" value="{{ $method->name }}" required>
                                    @endif
                                    @if ($method->name == 'Credit Card')
                                        <small class="">Please ensure you have selected a credit card provider from
                                            the payment preference tab. Please delete paystack and stripe payment option as
                                            this method already makes use of them.</small>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <h6 class="">Minimum Amount</h6>
                                    <input type="number" value="{{ $method->minimum }}" class="form-control  "
                                        name="minimum" id="minamount" required>
                                    <small class="">Required but only applies to withdrawal</small>
                                </div>
                                <div class="form-group col-md-6">
                                    <h6 class="">Maximum Amount</h6>
                                    <input type="number" value="{{ $method->maximum }}" class="form-control  "
                                        name="maximum" id="maxamount" required>
                                    <small class="">Required but only applies to withdrawal</small>
                                </div>
                                <div class="form-group col-md-6">
                                    <h6 class="">Charges</h6>
                                    <input type="number" value="{{ $method->charges_amount }}" class="form-control  "
                                        name="charges" id="charges" required>
                                    <small class="">Required but only applies to withdrawal</small>
                                </div>
                                <div class="form-group col-md-6">
                                    <h6 class="">Charges Type</h6>
                                    <select name="chargetype" class="form-control  " required>
                                        <option value="{{ $method->charges_type }}">{{ $method->charges_type }}</option>
                                        <option value="percentage">Percentage(%)</option>
                                        <option value="fixed">Fixed({{ $settings->currency }})</option>
                                    </select>
                                    <small class="">Required but only applies to withdrawal</small>
                                </div>
                                <div class="form-group col-md-6">
                                    <h6 class="">Type</h6>
                                    <select name="methodtype" id="methodtype" class="form-control  " required>
                                        <option value="{{ $method->methodtype }}">{{ $method->methodtype }}</option>
                                        <option value="currency">Currency</option>
                                        <option value="crypto">Crypto</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <h6 class="">Image url</h6>
                                    <input type="text" value="{{ $method->img_url }}" class="form-control  "
                                        name="url" id="url">
                                </div>
                                {{-- Currency inputs --}}
                                <div class="form-group col-md-6 currency">
                                    <h6 class="">Bank Name</h6>
                                    <input type="text" value="{{ $method->bankname }}" class="form-control   currinput"
                                        name="bank" id="bank">
                                </div>
                                <div class="form-group col-md-6 currency">
                                    <h6 class="">Account Name</h6>
                                    <input type="text" value="{{ $method->account_name }}"
                                        class="form-control   currinput" name="account_name" id="acnt_name">
                                </div>
                                <div class="form-group col-md-6 currency">
                                    <h6 class="">Account Number</h6>
                                    <input type="number" value="{{ $method->account_number }}"
                                        class="form-control   currinput" name="account_number" id="acnt_number">
                                </div>
                                <div class="form-group col-md-6 currency">
                                    <h6 class="">Swift/Other Code</h6>
                                    <input type="text" value="{{ $method->swift_code }}"
                                        class="form-control   currinput" name="swift" id="swift">
                                </div>

                                {{-- Cryptocurrency Inputs --}}
                                <div class="form-group col-md-6 d-none crypto">
                                    <h6 class="">Wallet Address</h6>
                                    <input type="text" value="{{ $method->wallet_address }}"
                                        class="form-control   cryptoinput" name="walletaddress" id="walletaddress">
                                </div>
                                <div class="form-group col-md-6 d-none crypto">
                                    <h6 class="">Barcode</h6>
                                    <input type="file" name="barcode" id=""
                                        class="form-control   cryptoinput">
                                </div>
                                <div class="form-group col-md-6 d-none crypto">
                                    <h6 class="">Wallet Address Network Type</h6>
                                    <input type="text" value="{{ $method->network }}"
                                        class="form-control   cryptoinput" name="wallettype" id="wallettype">
                                    @if ($method->name == 'USDT' or $method->name == 'BUSD')
                                        <small class="text-{{ $text }}">Ensure your network for USDT payment is
                                            always TRC20 and BUSD payment is ERC20 if you set payment option to automatic
                                            and you are using coinpament option. If you want to use manual payment option,
                                            you can use whatever network you prefer.</small>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <h6 class="">Status</h6>
                                    <select name="status" id="status" class="form-control  " required>
                                        <option value="{{ $method->status }}">{{ $method->status }}</option>
                                        <option value="enabled">Enable</option>
                                        <option value="disabled">Disable</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <h6 class="">Type for</h6>
                                    <select name="typefor" id="status" class="form-control  " required>
                                        <option value="{{ $method->type }}">{{ $method->type }}</option>
                                        <option value="withdrawal">Withdrawal</option>
                                        <option value="deposit">Deposit</option>
                                        <option value="both">Both</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <h6 class="">Optional Note</h6>
                                    <input type="text" value="{{ $method->duration }}" class="form-control  "
                                        name="note" placeholder="Payment may take up to 24 hours">
                                </div>
                                <input type="hidden" name="id" value="{{ $method->id }}">
                                <div class="form-group col-md-12">
                                    <button type="submit" class="px-4 btn btn-primary">Save Changes</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            let methodtype = document.getElementById('methodtype');
            let currtype = document.querySelectorAll('.currency');
            let currinput = document.querySelectorAll('.currinput');
            let cryptotype = document.querySelectorAll('.crypto');
            let cryptoinput = document.querySelectorAll('.cryptoinput');

            currinput[0].setAttribute('required', '');
            currinput[1].setAttribute('required', '');
            currinput[2].setAttribute('required', '');
            methodtype.addEventListener('change', sortfields);

            if (methodtype.value == 'currency') {
                cryptotype.forEach(element => {
                    element.classList.add('d-none');
                });
                currinput[0].setAttribute('required', '');
                currinput[1].setAttribute('required', '');
                currinput[2].setAttribute('required', '');

                cryptoinput[0].removeAttribute('required', '');
                cryptoinput[2].removeAttribute('required', '');

                currtype.forEach(curr => {
                    curr.classList.remove('d-none');
                });

            } else {
                cryptoinput[0].setAttribute('required', '');
                cryptoinput[2].setAttribute('required', '');

                currinput[0].removeAttribute('required', '');
                currinput[1].removeAttribute('required', '');
                currinput[2].removeAttribute('required', '');

                cryptotype.forEach(element => {
                    element.classList.remove('d-none');
                });

                currtype.forEach(curr => {
                    curr.classList.add('d-none');
                });
            }

            function sortfields() {
                if (methodtype.value == 'currency') {
                    cryptotype.forEach(element => {
                        element.classList.add('d-none');
                    });
                    currinput[0].setAttribute('required', '');
                    currinput[1].setAttribute('required', '');
                    currinput[2].setAttribute('required', '');

                    cryptoinput[0].removeAttribute('required', '');
                    cryptoinput[2].removeAttribute('required', '');

                    currtype.forEach(curr => {
                        curr.classList.remove('d-none');
                    });

                } else {
                    cryptoinput[0].setAttribute('required', '');
                    cryptoinput[2].setAttribute('required', '');

                    currinput[0].removeAttribute('required', '');
                    currinput[1].removeAttribute('required', '');
                    currinput[2].removeAttribute('required', '');

                    cryptotype.forEach(element => {
                        element.classList.remove('d-none');
                    });

                    currtype.forEach(curr => {
                        curr.classList.add('d-none');
                    });
                }
            }
        </script>
    @endsection
