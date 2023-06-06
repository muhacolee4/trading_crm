<div class="mt-2 mb-4">
    <div class="row row-card-no-pd mt--2">
        <div class="col-md-4">
            <div class="card card-stats card-round full-height">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-4">
                            <div class="text-center icon-big">
                                <i class="fa fa-download text-warning"></i>
                            </div>
                        </div>
                        <div class="col-md-6 col-8 col-stats">
                            <div class="numbers">
                                <p class="card-category">Trading Account Slot</p>
                                <h2>
                                    @if ($myaccount)
                                        {{ $myaccount['trading_account_slot'] ? $myaccount['trading_account_slot'] : '0' }}
                                    @else
                                        0
                                    @endif
                                </h2>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <a href="" class="btn btn-sm btn-primary" data-toggle="modal"
                                data-target="#buySlotModal">Buy Slot</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="buySlotModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Buy Slot</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <livewire:admin.buy-slot />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-stats card-round full-height">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-4">
                            <div class="text-center icon-big">
                                <i class="fa fa-download text-danger"></i>
                            </div>
                        </div>
                        <div class="col-md-6 col-8 col-stats">
                            <div class="numbers">
                                <p class="card-category">Wallet Balance</p>
                                <h2>
                                    ${{ $myaccount ? number_format($myaccount['wallet_balance'], 2, '.') : '0.00' }}
                                </h2>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('tra.pay') }}" class="btn btn-sm btn-primary">Topup</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-stats card-round full-height">
                <div class="card-body ">
                    <div class="row">
                        <div class="col-4">
                            <div class="text-center icon-big">
                                <i class="fa fa-download text-success"></i>
                            </div>
                        </div>
                        <div class="col-8 col-stats">
                            <div class="numbers">
                                <p class="card-category">Subscriber Accounts</p>
                                <h2>{{ $data['data'] ? count($data['data']) : '0' }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
