
@extends('layouts.dash')
@section('title', $title)
@section('content')
    <!-- Page title -->
    <div class="page-title">
        <div class="row justify-content-between align-items-center">
            <div class="mb-3 col-md-6 mb-md-0">
                <h5 class="mb-0 text-white h3 font-weight-400">Withdrawal Details</h5>
            </div>
        </div>
    </div>
    <div>
        @if (session('status'))
        <script type="text/javascript">
            swal({
                title: "Error!",
                text: "{{ session('status') }}",
                icon: "error",
                buttons: {
                    confirm: {
                        text: "Okay",
                        value: true,
                        visible: true,
                        className: "btn btn-danger",
                        closeModal: true
                    }
                }
            });
        </script>
        {{session()->forget('status')}}
        @endif
    </div>
    <x-danger-alert/>
	<x-success-alert/>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-5 row">
                        <div class="col-lg-8 offset-md-2">
                            <div class="p-2 rounded p-md-4 card ">
                                <div class="card-body">
                                    <div class="mb-3 alert alert-modern alert-success">
                                        <span class="text-center badge badge-success badge-pill">
                                            Your payment method
                                        </span>
                                        <span class="alert-content">{{ $payment_mode}}</span>
                                    </div>
                                    @if ($payment_mode == "USDT" and $settings->auto_merchant_option == 'Binance' and $settings->withdrawal_option == 'auto')
                                        <livewire:user.crypto-withdaw :payment_mode="$payment_mode"/>
                                    @else
                                    <form action="{{route('completewithdrawal')}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label class="">Enter Amount to withdraw({{$settings->currency}})</label>
                                            <input class="form-control " placeholder="Enter Amount" type="number" name="amount" required>
                                        </div>
                                        <input value="{{$payment_mode}}"  type="hidden" name="method">

                                        @if (Auth::user()->sendotpemail == 'Yes')
                                            <div class="form-group">
                                                <label class="m-1 d-inline">Enter OTP</label>
                                                <div class="float-right m-1 btn-group d-inline">
                                                    <a class="btn btn-primary btn-sm" href="{{route('getotp')}}"> <i class="fa fa-envelope"></i> Request OTP</a> 
                                                </div>
                                                <input class="form-control " placeholder="Enter OTP" type="text" name="otpcode" required>
                                                <small class="">OTP will be sent to your email when you request</small>
                                            </div> 
                                        @endif
                                        @if (!$default or $payment_mode == "BUSD")
                                            @if ($methodtype == 'crypto')
                                                <div class="form-group">
                                                    <h5 class="">Enter {{$payment_mode}} Address </h5>
                                                    <input class="form-control " placeholder="Enter {{$payment_mode}} Address" type="text" name="details" required>
                                                    <small class="">{{$payment_mode}} is not a default withdrawal option in your account, please enter the correct wallet address to recieve your funds.</small>
                                                </div>  
                                            @else
                                               <div class="form-group">
                                                    <label class="">Enter {{$payment_mode}} Details </label>
                                                    <textarea class="form-control " row="4" name="details" placeholder="BankName: Name, Account Number: Number, Account name: Name, Swift Code: Code" required>
                                                    
                                                    </textarea>
                                                    <small class="">{{$payment_mode}} is not a default withdrawal option in your account, please enter the correct bank details seperated by comma to recieve your funds.</small> <br/>
                                                    <span class="text-danger">BankName: Name, Account Number: Number, Account name: Name, Swift Code: Code</span>
                                                </div>  
                                            @endif
                                            
                                        @endif
                                        <div class="form-group">
                                            <button class="btn btn-primary" type='submit'>Complete Request</button>
                                        </div>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
					</div>
                </div>
            </div>
        </div>
	</div>
@endsection