@extends('layouts.dash')
@section('styles')
    @parent
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('title', $title)
@section('content')
    <!-- Page title -->
    <div class="page-title">
        <div class="row justify-content-between align-items-center">
            <div class="mb-3 col-md-6 mb-md-0">
                <h5 class="mb-0 text-white h3 font-weight-400">Fund Transfer</h5>
            </div>
        </div>
    </div>
    <x-danger-alert />
    <x-success-alert />
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row profile">
                        <div class="col-md-12">
                            <div class="p-2 pb-3 p-md-5 pb-md-0 ">
                                <div class="row">
                                    <div class="mb-3 col-md-4 offset-md-4">
                                        <div class="p-3 card">
                                            <div class="d-flex align-items-center justify-content-around">
                                                <img src="{{ asset('dash2/img/wallet.png') }}" alt="wallet"
                                                    width="25">
                                                <div>
                                                    <h5 class="mb-1 d-inlne">
                                                        <b>{{ $settings->currency }}{{ number_format(Auth::user()->account_bal, 2, '.', ',') }}</b>
                                                    </h5>
                                                    <small class="text-muted">Your Account Balance</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8 offset-md-2">
                                        <form method="post" action="javascript:void(0)" id="transferform">
                                            @csrf
                                            <div class="form-group">
                                                <label for="" class="">Recipient Email or username <span
                                                        class=" text-danger">*</span></label>
                                                <input type="text" name="email" class="form-control " required>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="">Amount({{ $settings->currency }}) <span
                                                        class=" text-danger">*</span></label>
                                                <input type="number" min="{{ $moresettings->min_transfer }}" name="amount"
                                                    placeholder="Enter amount you want to transfer to recipient"
                                                    class="form-control " required>
                                            </div>
                                            <div class="form-group">
                                                <h6 class="">Transfer Charges: <strong
                                                        class=" text-danger">{{ $moresettings->transfer_charges }}%</strong>
                                                </h6>
                                            </div>
                                            <input type="hidden" name="password" id="acntpass">
                                            <div class="">
                                                <input type="submit" id="subbtn" class="py-2 btn btn-primary btn-block"
                                                    value="Proceed">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $('#transferform').on('submit', function() {
            (async () => {

                const {
                    value: password
                } = await Swal.fire({
                    title: 'Input your password',
                    input: 'password',
                    inputLabel: 'Enter your account password to complete transfer',
                    inputPlaceholder: 'Enter your account password'
                })

                if (password) {

                    document.getElementById('acntpass').value = password;
                    $("#subbtn").attr("disabled", "disabled").val('Please wait....');
                    $.ajax({
                        url: "{{ route('transfertouser') }}",
                        type: 'POST',
                        data: $('#transferform').serialize(),
                        success: function(response) {
                            if (response.status === 200) {
                                Swal.fire({
                                    title: 'Success!',
                                    text: response.message,
                                    icon: 'success',
                                    confirmButtonText: 'Cool'
                                });
                                $("#subbtn").removeAttr("disabled").val('Proceed');
                                setTimeout(() => {
                                    let url = "{{ url('/dashboard/transfer-funds') }}";
                                    window.location.href = url;
                                }, 3000);
                            } else {
                                $("#subbtn").removeAttr("disabled").val('Proceed');
                                Swal.fire({
                                    title: 'Error!',
                                    text: response.message,
                                    icon: 'error',
                                });
                            }
                        },
                        error: function(error) {
                            console.log(error);
                        },

                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Password is required',
                        icon: 'error',
                        confirmButtonText: 'Alright'
                    })
                }

            })()

        });
    </script>

@endsection
