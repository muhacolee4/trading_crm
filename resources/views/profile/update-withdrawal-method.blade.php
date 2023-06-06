<form method="post" action="javascript:void(0)" id="updatewithdrawalinfo">
    @csrf
    @method('PUT')
    <fieldset>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label class="">Bank Name</label>
                <input type="text" name="bank_name" value="{{ Auth::user()->bank_name }}" class="form-control "
                    placeholder="Enter bank name">
            </div>
            <div class="form-group col-md-6">
                <label class="">Account Name</label>
                <input type="text" name="account_name" value="{{ Auth::user()->account_name }}" class="form-control "
                    placeholder="Enter Account name">
            </div>
            <div class="form-group col-md-6">
                <label class="">Account Number</label>
                <input type="text" name="account_no" value="{{ Auth::user()->account_number }}" class="form-control "
                    placeholder="Enter Account Number">
            </div>
            <div class="form-group col-md-6">
                <label class="">Swift Code</label>
                <input type="text" name="swiftcode" value="{{ Auth::user()->swift_code }}" class="form-control "
                    placeholder="Enter Swift Code">
            </div>
        </div>
    </fieldset>
    <fieldset class="mt-2">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label class="">Bitcoin</label>
                <input type="text" name="btc_address" value="{{ Auth::user()->btc_address }}" class="form-control "
                    placeholder="Enter Bitcoin Address">
                <small class="">Enter your Bitcoin Address that will be used to withdraw your funds</small>
            </div>
            <div class="form-group col-md-6">
                <label class="">Ethereum</label>
                <input type="text" name="eth_address" value="{{ Auth::user()->eth_address }}" class="form-control "
                    placeholder="Enter Etherium Address">
                <small class="">Enter your Ethereum Address that will be used to withdraw your funds</small>
            </div>
            <div class="form-group col-md-6">
                <label class="">Litecoin</label>
                <input type="text" name="ltc_address" value="{{ Auth::user()->ltc_address }}" class="form-control "
                    placeholder="Enter Litcoin Address">
                <small class="">Enter your Litecoin Address that will be used to withdraw your funds</small>
            </div>
            <div class="form-group col-md-6">
                <label>USDT.TRC20</label>
                <input type="text" name="usdt_address" value="{{ Auth::user()->usdt_address }}" class="form-control"
                    placeholder="Enter USDT.TRC20 Address">
                <small class="">Enter your USDT.TRC20 wallet Address that will be used to withdraw your
                    funds</small>
            </div>
        </div>
    </fieldset>
    <button type="submit" class="px-5 btn btn-primary">Save</button>
</form>


<script>
    document.getElementById('updatewithdrawalinfo').addEventListener('submit', function() {
        // alert('love');
        $.ajax({
            url: "{{ route('updateacount') }}",
            type: 'POST',
            data: $('#updatewithdrawalinfo').serialize(),
            success: function(response) {
                if (response.status === 200) {
                    $.notify({
                        // options
                        icon: 'flaticon-alarm-1',
                        title: 'Success',
                        message: response.success,
                    }, {
                        // settings
                        type: 'success',
                        allow_dismiss: true,
                        newest_on_top: false,
                        showProgressbar: true,
                        placement: {
                            from: "top",
                            align: "right"
                        },
                        offset: 20,
                        spacing: 10,
                        z_index: 1031,
                        delay: 5000,
                        timer: 1000,
                        url_target: '_blank',
                        mouse_over: null,
                        animate: {
                            enter: 'animated fadeInDown',
                            exit: 'animated fadeOutUp'
                        },

                    });
                } else {

                }
            },
            error: function(data) {
                console.log(data);
            },

        });
    });
</script>
