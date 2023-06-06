@php
$sub_link = 'https://trade.mql5.com/trade';
@endphp

@extends('layouts.dash')
@section('title', $title)
@section('content')
    <!-- Page title -->
    <div class="page-title">
        <div class="row justify-content-between align-items-center">
            <div class="mb-3 col-md-6 mb-md-0">
                <h5 class="mb-0 text-white h3 font-weight-400">Trading Account(s)</h5>
            </div>
        </div>
    </div>
    <x-danger-alert />
    <x-success-alert />
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-5 row">
                        <div class="shadow-lg col-lg-12 card p-lg-3 p-sm-5">
                            <h2 class="">{{ $settings->site_name }} Account manager</h2> <br>
                            <div clas="well">
                                <p class="text-justify ">Don’t have time to trade or learn how to
                                    trade?
                                    Our Account Management Service is The Best Profitable Trading Option for you,
                                    We can help you to manage your account in the financial MARKET with a simple
                                    subscription model.<br>
                                    <small>Terms and Conditions apply</small><br>Reach us at {{ $settings->contact_email }}
                                    for more info.
                                </p>
                            </div>
                            <br>
                            <div class="py-3">
                                <a class="text-white btn btn-primary" data-toggle="modal" data-target="#submitmt4modal">
                                    Subscribe Now
                                </a>
                            </div>

                        </div>
                    </div>
                    <div class="p-2 mb-5 p-md-4 row">
                        <div class="mb-3 col-12">
                            <h5 class="">My Trading Accounts</h5>
                        </div>
                        @forelse ($subscriptions as $sub)
                            <div class="col-md-4 p-2">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $sub->mt4_id }}/{{ $sub->account_type }}
                                        </h5>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-primary">Currency</span>
                                            <span>{{ $sub->currency }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-primary">Leverage</span>
                                            <span>{{ $sub->leverage }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-primary">Server</span>
                                            <span>{{ $sub->server }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-primary">Duration</span>
                                            <span>{{ $sub->duration }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-primary">Account Password</span>
                                            <span>xxxxxxx</span>
                                        </div>

                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-primary">Status</span>
                                            <span>{{ $sub->status }}</span>
                                        </div>
                                        <div class="d-flex justify-content-center mb-2">
                                            <small>Submitted:
                                                {{ \Carbon\Carbon::parse($sub->created_at)->toDayDateTimeString() }}</small>
                                        </div>
                                        <div class="d-flex justify-content-center mb-2">
                                            <small>
                                                Started:
                                                @if (!empty($sub->start_date))
                                                    {{ \Carbon\Carbon::parse($sub->start_date)->toDayDateTimeString() }}
                                                @else
                                                    Not Started yet
                                                @endif
                                            </small>
                                        </div>
                                        <div class="d-flex justify-content-center mb-2">
                                            <small>Expire:
                                                @if (!empty($sub->end_date))
                                                    {{ \Carbon\Carbon::parse($sub->end_date)->toDayDateTimeString() }}
                                                @else
                                                    Not Started yet
                                                @endif
                                            </small>
                                        </div>
                                        <div class="mt-4 text-center">
                                            @php
                                                $endAt = \Carbon\Carbon::parse($sub->end_date);
                                                $remindAt = \Carbon\Carbon::parse($sub->reminded_at);
                                            @endphp
                                            <a href="#" data-toggle="modal" class="btn btn-danger btn-sm"
                                                onclick="deletemt4()">Cancel</a>
                                            @if (now()->isSameDay($remindAt) || $sub->status == 'Expired')
                                                <a href="{{ route('renewsub', $sub->id) }}"
                                                    class="btn btn-success btn-sm">Renew</a>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-md-12">
                                <div class="py-4 card">
                                    <div class="text-center card-body">
                                        <p>You do not have an trading at the moment.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h3 class="">Connect to your trading account to monitor activities on
                                your trading account(s).</h3>
                            <iframe src="{{ $sub_link }}" name="WebTrader" title="{{ $title }}" frameborder="0"
                                style="display: block; border: none; height: 76vh; width: 80vw;"></iframe>
                        </div>
                    </div>
                    <!-- end of chart -->
                </div>
            </div>
        </div>
    </div>
    @include('user.modals')
    <script type="text/javascript">
        function deletemt4() {
            swal({
                title: "Error!",
                text: "Send an Email to {{ $settings->contact_email }} to have your MT4 Details cancelled.",
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
        }
    </script>
@endsection
