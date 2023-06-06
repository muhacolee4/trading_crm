@extends('layouts.dash')
@section('title', $title)
@section('content')
    <!-- Page title -->
    <div class="page-title">
        <div class="row justify-content-between align-items-center">
            <div class="mb-3 col-md-6 mb-md-0">
                <h5 class="mb-0 text-white h3 font-weight-400">Place a withdrawal request</h5>
            </div>
        </div>
    </div>
    <x-danger-alert />
    <x-success-alert />
    <div class="row">
        <div class="my-5 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="my-5 row d-flex nowrap">
                        @foreach ($wmethods as $method)
                            <div class="mb-4 col-lg-4">
								<div class="card-deck">
									<div class="text-center border-0 rounded-lg shadow-lg card card-pricing hover-scale-110 bg-primary popular">
										<div class="py-0 border-0 card-header">
											<span class="px-4 py-1 mx-auto bg-white shadow-sm h6 d-inline-block rounded-bottom">{{ $method->name }}</span>
											<div class="py-5">
												<img src="{{ asset('dash2/img/Wallet.svg.png') }}" alt="withdrawal method image" srcset="" class="img-fluid img-center" style="height:90px;">
												
											</div>
										</div>
										<hr class="my-0 divider divider-fade divider-dark" />
										<div class="card-body">
											<ul class="mb-4 text-white list-unstyled">
												<li> 
													<small>Minimum withdrawable amount</small>
													<p class="text-white h5">{{ $settings->currency }}{{ number_format($method->minimum) }}</p>
												</li>
												<li>
													<small>Maximum withdrawable amount</small>
													<p class="text-white h5">{{ $settings->currency }}{{ number_format($method->maximum )}}</p>
												</li>
												<li>Charge Type: <strong>{{ $method->charges_type }}</strong></li>
												<li>
													Charges Amount: 
													<strong>
														@if ($method->charges_type == 'percentage')
															{{ $method->charges_amount }}%
														@else
															{{ $settings->currency }}{{ $method->charges_amount }}
														@endif
													</strong>
												</li>
												<li>
													Duration: <strong>{{ $method->duration }}</strong>
												</li>
											</ul>
											@if ($settings->enable_with == 'false')
												<button class="mb-3 btn btn-sm btn-neutral" data-toggle="modal"
													data-target="#withdrawdisabled"><i class="fa fa-plus"></i> Request
													withdrawal</button>
											@else
												<form action='{{ route('withdrawamount') }}' method="POST">
													@csrf
													<div class="form-group">
														<input type="hidden" value="{{ $method->name }}" name="method">
														<button class="mb-3 btn btn-sm btn-neutral" type='submit'><i
																class="fa fa-plus"></i> Request withdrawal</button>
													</div>
												</form>
											@endif
										</div>
									</div>
								</div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Withdrawal Modal -->
                    <div id="withdrawdisabled" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header ">
                                    <h6 class="modal-title">Withdrawal Status</h4>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
                                </div>
                                <div class="modal-body ">
                                    <h6 class="">Withdrawal is Disabled at the moment, Please check
                                        back later</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Withdrawals Modal -->
                </div>
            </div>

        </div>
    </div>
@endsection
