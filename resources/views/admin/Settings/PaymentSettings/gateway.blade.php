<div class="row">
    <div class="col-md-12">
        <form action="javascript:void(0)" method="POST" id="gatewayform">
            @csrf
            @method('PUT')
            <h4 class="text-primary"> <i class="fa fab-stripe"></i> Stripe:</h4>
            <div class="form-group">
                <h5 class="">Stripe secret key</h5>
                <input type="text" name="s_s_k" class="form-control  " value="{{ $settings->s_s_k }}">
            </div>
            <div class="form-group">
                <h5 class="">Stripe publishable key</h5>
                <input type="text" name="s_p_k" class="form-control  " value="{{ $settings->s_p_k }}">
            </div>
            <hr>
            <h4 class="text-primary"><i class="fa fab-paypal"></i> Paypal:</h4>
            <div class="form-group">
                <h4 class="">Paypal client ID</h4>
                <input type="text" name="pp_ci" class="form-control  " value="{{ $settings->pp_ci }}">
            </div>
            <div class="form-group">
                <h4 class="">Paypal client secret</h4>
                <input type="text" name="pp_cs" class="form-control  " value="{{ $settings->pp_cs }}">
            </div>
            <hr>
            <h4 class="text-primary"><i class="fa fab-paypal"></i> Paystack:</h4>
            <small class="text-{{ $text }}">Make sure to set in your paystack dashboard the Callback Url:
                <strong>{{ $settings->site_address }}/dashboard/paystackcallback</strong> </small>
            <div class="form-group">
                <h4 class="">Paystack Public Key</h4>
                <input type="text" name="paystack_public_key" class="form-control  "
                    value="{{ $paystack->paystack_public_key }}">
            </div>
            <div class="form-group">
                <h4 class="">Paystack Secret Key</h4>
                <input type="text" name="paystack_secret_key" class="form-control  "
                    value="{{ $paystack->paystack_secret_key }}">
            </div>
            <div class="form-group">
                <h4 class="">Paystack URL</h4>
                <input type="text" name="paystack_url" class="form-control  " value="{{ $paystack->paystack_url }}"
                    readonly>
            </div>
            <div class="form-group">
                <h4 class="">Paystack Email</h4>
                <input type="text" name="paystack_email" class="form-control  "
                    value="{{ $paystack->paystack_email }}">
            </div>
            <hr>
            <h4 class="text-primary">Flutterwave:</h4>
            <small class=""> from <a href="https://dashboard.flutterwave.com/login"
                    target="_blank">https://dashboard.flutterwave.com/login</a> </small>
            <div class="form-group">
                <h4 class="">Flutterwave Public Key</h4>
                <input type="text" name="flw_public_key" class="form-control  "
                    value="{{ $moresettings->flw_public_key }}">
            </div>
            <div class="form-group">
                <h4 class="">Flutterwave Secret Key</h4>
                <input type="text" name="flw_secret_key" class="form-control  "
                    value="{{ $moresettings->flw_secret_key }}">
            </div>
            <div class="form-group">
                <h4 class="">Flutterwave Secret Hash</h4>
                <input type="text" name="flw_secret_hash" class="form-control  "
                    value="{{ $moresettings->flw_secret_hash }}">
            </div>
            <hr>
            <h4 class="text-primary">Binance:</h4>
            <div class="form-group">
                <h4 class="">Binance API Key</h4>
                <input type="text" name="bnc_api_key" class="form-control  "
                    value="{{ $moresettings->bnc_api_key }}">
                <small class=""> from <a href="https://merchant.binance.com/en"
                        target="_blank">https://merchant.binance.com/en</a> </small>
            </div>
            <div class="form-group">
                <h4 class="">Binance Secret Key</h4>
                <input type="text" name="bnc_secret_key" class="form-control  "
                    value="{{ $moresettings->bnc_secret_key }}">
                <small class=""> from <a href="https://merchant.binance.com/en"
                        target="_blank">https://merchant.binance.com/en</a> </small>
            </div>

            <div class="form-group col-md-6">
                <button type="submit" class="px-4 btn btn-primary">Save Settings</button>
            </div>
        </form>
    </div>
</div>
