<div>
    <form method="post" action="javascript:void(0)" id="bonusform">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="mb-2 col-md-6">
                <h5 class="">Registration/Welcome Bonus({{ $settings->currency }})</h5>
                <input type="text" class="form-control  " name="signup_bonus" value="{{ $settings->signup_bonus }}"
                    required>
                <small class="">New registration bonus gets added to new users account.</small>
            </div>
            <div class="mb-2 col-md-6">
                <h5 class="">Deposit Bonus(%)</h5>
                <input type="text" class="form-control  " name="deposit_bonus" value="{{ $settings->deposit_bonus }}"
                    required>
                <small class="">You can specify bonus amount for users deposit. The system calculates the
                    percantage amount you specified with the amount of the users deposit and adds it as a bonus(For
                    every deposit).</small>
            </div>
            <div class="mb-2 col-md-12">
                <input type="submit" class="px-5 btn btn-primary btn-lg" value="Update">
                <input type="hidden" name="id" value="1">
            </div>
        </div>
    </form>
</div>
