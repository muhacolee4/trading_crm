<div class="row">
    <div class="col-md-12">
        <form action="javascript:void(0)" method="POST" id="paypreform">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group col-md-6">
                    <h5 class=""> Deposit option:</h5>
                    <select name="deposit_option" class="form-control  ">
                        <option value="{{ $settings->deposit_option }}"> {{ $settings->deposit_option }}(Current)
                        </option>
                        <option value="manual">Manual</option>
                        <option value="auto">Automatic</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <h5 class=""> Withdrawal option:</h5>
                    <select name="withdrawal_option" class="form-control  ">
                        <option value="{{ $settings->withdrawal_option }}">{{ $settings->withdrawal_option }}(Current)
                        </option>
                        <option value="manual">Manual</option>
                        <option value="auto">Automatic</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <h5 class=""> Minimum Deposit Amount:</h5>
                    <input class="form-control  " type="text" name="minamt" value="{{ $moresettings->minamt }}"
                        required>
                    <small class="">This amount indicates the minimum amount a user can deposit</small>
                </div>
                <div class="form-group col-md-6">
                    <h5 class="">Merchant for automatic USDT Payment:</h5>
                    <select name="merchat" id="" class="form-control  ">
                        <option value="{{ $settings->auto_merchant_option }}">{{ $settings->auto_merchant_option }}
                        </option>
                        <option value="Coinpayment">Coinpayment</option>
                        <option value="Binance">Binance</option>
                    </select>
                    <small class="">
                        Please make sure you have entered your API keys for your selected USDT Merchant. Click the
                        Gateway/Coinpayment tab to confirm that. NOTE
                        <strong>Your website currency must be USD in order to use Binance.</strong>
                    </small>
                </div>
                <div class="form-group col-md-6">
                    <h5 class="">Withdrawal Deduction:</h5>
                    <select name="deduction_option" id="" class="form-control  ">
                        <option value="{{ $settings->deduction_option }}">
                            {{ $settings->deduction_option == 'userRequest' ? 'Deduct on user request' : 'Deduct when admin approves' }}
                        </option>
                        <option value="userRequest">Deduct on user request</option>
                        <option value="AdminApprove">Deduct when admin approves</option>
                    </select>
                    <small class="">
                        This speciifes if you want users account to be deducted immediately they place a withdrawal
                        request or when admin approves it.
                    </small>
                </div>
                <div class="form-group col-md-6">
                    <h5 class="">Credit Card Payment Provider:</h5>
                    <select name="credit_card_provider" id="" class="form-control  ">
                        <option>
                            {{ $settings->credit_card_provider }}
                        </option>
                        <option>Paystack</option>
                        <option>Flutterwave</option>
                        <option>Stripe</option>
                    </select>
                    <small class="">
                        Signifies the provder to be used when users choose to deposit with their credit/debit card for
                        credit card option. Ensure you have entered the correct API keys for you selected option.
                    </small>
                </div>
                <div class="form-group col-md-12">
                    <button type="submit" class="px-4 btn btn-primary">Save</button>
                </div>
            </div>

        </form>
    </div>
</div>
