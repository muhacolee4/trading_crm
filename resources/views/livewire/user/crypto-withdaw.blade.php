<div>
    @if (Session::has('status'))
        <div class="alert alert-group alert-info alert-icon alert-dismissible fade show" role="alert">
            <div class="alert-content">
                {{ Session::get('status') }}
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-group alert-danger alert-icon alert-dismissible fade show" role="alert">
            <div class="alert-content">
                {{ Session::get('error') }}
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="alert alert-group alert-warning alert-icon alert-dismissible fade show" role="alert">
        <div class="alert-content">
            Our automatic USDT payment is powered by Binance, in order for you to receive your funds, please make sure
            you have a binance account registered with the same email address on our platform. If you do not have a
            binance account please <a href="https://www.binance.com/en" target="_blank" class="btn-link">create an
                account.</a> <strong>NOTE: do not proceed with this request if you do not have a binance account or you
                have an account with a different email address so you don't lose your funds.</strong>
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form action="" method="post" wire:submit.prevent='withdraw'>
        <div class="form-group">
            <label class="">Enter Amount to withdraw({{ $settings->currency }})</label>
            <input class="form-control " placeholder="Enter Amount" type="number" wire:model='amount' name="amount"
                required>
        </div>
        <input value="{{ $payment_mode }}" type="hidden" name="method">
        @if (Auth::user()->sendotpemail == 'Yes')
            <div class="form-group">
                <label class="m-1 d-inline">Enter OTP</label> <br wire:loading wire:target="requestOtp">
                <div class="float-right m-1 btn-group d-inline">
                    <a class="btn btn-primary btn-sm" href="#" wire:click='requestOtp' wire:loading.remove
                        wire:target='requestOtp'> <i class="fa fa-envelope"></i> Request OTP</a>
                </div>
                <small class="text-primary" wire:loading wire:target="requestOtp">Sending OTP to your email, please
                    wait...</small>
                <input class="form-control" placeholder="Enter OTP" wire:model='otpCode' type="text" required>
                <small class="">OTP will be sent to your email when you request</small>
            </div>
        @endif
        <div class="form-group">
            <button class="btn btn-primary" wire:loading.attr='disabled' wire:target='withdraw' type='submit'>Complete
                Request</button>
        </div>
    </form>
</div>
