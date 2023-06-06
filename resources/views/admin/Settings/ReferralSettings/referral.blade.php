<div>
    <form method="post" action="javascript:void(0)" id="refform">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="mb-2 col-md-6">
                <h5 class="">Direct Referral Commission (%) </h5>
                <input type="text" class="form-control  " name="ref_commission"
                    value="{{ $settings->referral_commission }}" required>
            </div>
            <div class="mb-2 col-md-6">
                <h5 class="">Indirect Referral Commission 1 (%) </h5>
                <input type="text" class="form-control  " name="ref_commission1"
                    value="{{ $settings->referral_commission1 }}" required>
            </div>
            <div class="mb-2 col-md-6">
                <h5 class="">Indirect Referral Commission 2 (%) </h5>
                <input type="text" class="form-control  " name="ref_commission2"
                    value="{{ $settings->referral_commission2 }}" required>
            </div>
            <div class="mb-2 col-md-6">
                <h5 class="">Indirect Referral Commission 3 (%) </h5>
                <input type="text" class="form-control  " name="ref_commission3"
                    value="{{ $settings->referral_commission3 }}" required>
            </div>
            <div class="mb-2 col-md-6">
                <h5 class="">Indirect Referral Commission 4 (%) </h5>
                <input type="text" class="form-control  " name="ref_commission4"
                    value="{{ $settings->referral_commission4 }}" required>
            </div>
            <div class="mb-2 col-md-6">
                <h5 class="">Indirect Referral Commission 5 (%) </h5>
                <input type="text" class="form-control   " name="ref_commission5"
                    value="{{ $settings->referral_commission5 }}" required>
            </div>
            <div class="mb-2 col-md-12">
                <input type="submit" class="px-5 btn btn-primary btn-lg" value="Update">
                <input type="hidden" name="id" value="1">
            </div>
        </div>
    </form>
</div>
