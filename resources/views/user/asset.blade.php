@extends('layouts.dash')
@section('title', $title)
@section('content')
    <!-- Page title -->
    <div class="page-title">
        <div class="row justify-content-between align-items-center">
            <div class="mb-3 col-md-6 mb-md-0">
                <p class="mb-0 text-white h3 font-weight-400">Swap Crypto</p>
            </div>
        </div>
    </div>
    <x-danger-alert />
    <x-success-alert />
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="mt-2 mb-4">

                        <div class="d-inline">
                            <a href="{{ route('swaphistory') }}" class="float-right btn btn-primary btn-sm">Transactions</a>
                        </div>
                        <p class="text-{{ $text }}">
                            Earn even more when you swap your Account balance to and from crypto.
                        </p>
                        <div class="row">
                            <div class="col-sm-6 col-lg-3">
                                <div class="p-3 card  shadow">
                                    <div class="d-flex align-items-center">
                                        <span class="mr-3 bg-transparent stamp stamp-md">

                                        </span>
                                        <div>
                                            <p class="mb-1 text-{{ $text }}">
                                                <b>{{ $settings->currency }}{{ number_format(Auth::user()->account_bal, 2, '.', ',') }}</b>
                                            </p>
                                            <small class="text-muted">Account Balance</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($moresettings->btc == 'enabled')
                                <div class="col-sm-6 col-lg-3">
                                    <div class="p-3 card  shadow">
                                        <div class="d-flex align-items-center">
                                            <span class="mr-3 bg-transparent stamp stamp-md">
                                                <img class="w-50"
                                                    src="https://img.icons8.com/color/48/000000/bitcoin--v1.png" />
                                            </span>
                                            <div>
                                                <p class="mb-1 text-{{ $text }}"><b>{{ round($cbalance->btc, 8) }}
                                                        BTC</b></p>
                                                <small class="text-muted usdelement" id="btc"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($moresettings->eth == 'enabled')
                                <div class="col-sm-6 col-lg-3">
                                    <div class="p-3 card  shadow">
                                        <div class="d-flex align-items-center">
                                            <span class="mr-3 bg-transparent stamp stamp-md">
                                                <img class="w-50"
                                                    src="https://img.icons8.com/fluency/48/000000/ethereum.png" />
                                            </span>
                                            <div>
                                                <p class="mb-1 text-{{ $text }}">
                                                    <b>{{ round($cbalance->eth, 8) }} ETH</b>
                                                </p>
                                                <small class="text-muted usdelement" id="eth"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($moresettings->ltc == 'enabled')
                                <div class="col-sm-6 col-lg-3">
                                    <div class="p-3 card  shadow">
                                        <div class="d-flex align-items-center">
                                            <span class="mr-3 bg-transparent stamp stamp-md">
                                                <img class="w-50"
                                                    src="https://img.icons8.com/fluency/48/000000/litecoin.png" />
                                            </span>
                                            <div>
                                                <p class="mb-1 text-{{ $text }}">
                                                    <b>{{ round($cbalance->ltc, 8) }} LTC</b>
                                                </p>
                                                <small class="text-muted usdelement" id="ltc"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($moresettings->link == 'enabled')
                                <div class="col-sm-6 col-lg-3">
                                    <div class="p-3 card  shadow">
                                        <div class="d-flex align-items-center">
                                            <span class="mr-3 bg-transparent stamp stamp-md">
                                                <img class="w-50"
                                                    src="https://img.icons8.com/cotton/64/000000/chainlink.png" />
                                            </span>
                                            <div>
                                                <p class="mb-1 text-{{ $text }}">
                                                    <b>{{ round($cbalance->link, 8) }} LINK</b>
                                                </p>
                                                <small class="text-muted usdelement" id="link"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($moresettings->bnb == 'enabled')
                                <div class="col-sm-6 col-lg-3">
                                    <div class="p-3 card  shadow">
                                        <div class="d-flex align-items-center">
                                            <span class="mr-3 bg-transparent stamp stamp-md">
                                                <img class="w-50"
                                                    src="https://s2.coinmarketcap.com/static/img/coins/64x64/1839.png" />
                                            </span>
                                            <div>
                                                <p class="mb-1 text-{{ $text }}">
                                                    <b>{{ round($cbalance->bnb, 8) }} BNB</b>
                                                </p>
                                                <small class="text-muted usdelement" id="bnb"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($moresettings->ada == 'enabled')
                                <div class="col-sm-6 col-lg-3">
                                    <div class="p-3 card  shadow">
                                        <div class="d-flex align-items-center">
                                            <span class="mr-3 bg-transparent stamp stamp-md">
                                                <img class="w-50"
                                                    src="https://s2.coinmarketcap.com/static/img/coins/64x64/2010.png" />
                                            </span>
                                            <div>
                                                <p class="mb-1 text-{{ $text }}">
                                                    <b>{{ round($cbalance->ada, 8) }} ADA</b>
                                                </p>
                                                <small class="text-muted usdelement" id="ada"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if ($moresettings->aave == 'enabled')
                                <div class="col-sm-6 col-lg-3">
                                    <div class="p-3 card  shadow">
                                        <div class="d-flex align-items-center">
                                            <span class="mr-3 bg-transparent stamp stamp-md">
                                                <img class="w-25"
                                                    src="https://dynamic-assets.coinbase.com/6ad513d3c9108b163cf0a4c9fd3441cadcb9cf656ea7b9fb333eb7e4a94cd503528e0a94188285d31aedfc392f0793fd4161f7ad4e04d5f6b82e4d70a314d295/asset_icons/80f3d2256652f5ccd680fc48702d130dd01f1bd7c9737fac560a02949efac3b9.png" />
                                            </span>
                                            <div>
                                                <p class="mb-1 text-{{ $text }}">
                                                    <b>{{ round($cbalance->aave, 8) }} AAVE</b>
                                                </p>
                                                <small class="text-muted usdelement" id="aave"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($moresettings->usdt == 'enabled')
                                <div class="col-sm-6 col-lg-3">
                                    <div class="p-3 card  shadow">
                                        <div class="d-flex align-items-center">
                                            <span class="mr-3 bg-transparent stamp stamp-md">
                                                <img class="w-50"
                                                    src="https://img.icons8.com/color/48/000000/tether--v2.png" />
                                            </span>
                                            <div>
                                                <p class="mb-1 text-{{ $text }}">
                                                    <b>{{ round($cbalance->usdt, 8) }} USDT</b>
                                                </p>
                                                <small
                                                    class="text-muted">{{ $settings->currency }}{{ number_format(round($cbalance->usdt)) }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($moresettings->bch == 'enabled')
                                <div class="col-sm-6 col-lg-3">
                                    <div class="p-3 card  shadow">
                                        <div class="d-flex align-items-center">
                                            <span class="mr-3 bg-transparent stamp stamp-md">
                                                <img class="w-75"
                                                    src="https://img.icons8.com/material-sharp/24/000000/bitcoin.png" />
                                            </span>
                                            <div>
                                                <p class="mb-1 text-{{ $text }}">
                                                    <b>{{ round($cbalance->bch, 8) }} BCH</b>
                                                </p>
                                                <small class="text-muted usdelement" id="bch"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($moresettings->xrp == 'enabled')
                                <div class="col-sm-6 col-lg-3">
                                    <div class="p-3 card  shadow">
                                        <div class="d-flex align-items-center">
                                            <span class="mr-3 bg-transparent stamp stamp-md">
                                                <img class="w-50"
                                                    src="https://img.icons8.com/fluency/48/000000/ripple.png" />
                                            </span>
                                            <div>
                                                <p class="mb-1 text-{{ $text }}">
                                                    <b>{{ round($cbalance->xrp, 8) }} XRP</b>
                                                </p>
                                                <small class="text-muted usdelement" id="xrp"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($moresettings->xlm == 'enabled')
                                <div class="col-sm-6 col-lg-3">
                                    <div class="p-3 card  shadow">
                                        <div class="d-flex align-items-center">
                                            <span class="mr-3 bg-transparent stamp stamp-md">
                                                <img class="w-50"
                                                    src="https://img.icons8.com/ios/50/000000/stellar.png" />
                                            </span>
                                            <div>
                                                <p class="mb-1 text-{{ $text }}">
                                                    <b>{{ round($cbalance->xlm, 8) }} XLM</b>
                                                </p>
                                                <small class="text-muted usdelement" id="xlm"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="tradingview-widget-container">
                                    <div id="tradingview_f933e"></div>
                                    <div class="tradingview-widget-copyright">
                                        <a href="#" rel="noopener" target="_blank"><span class="blue-text"></span>
                                            <span class="blue-text">Personal trading chart</span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <form method="POST" action="javascript:void(0)" id="exchnageform">
                                    @csrf
                                    <div class="form-group">
                                        <p class="text-{{ $text }}">Source Account</p>
                                        <select class="form-control text-{{ $text }} " name="source"
                                            id="sourceasset">
                                            @if ($moresettings->btc == 'enabled')
                                                <option value="btc">BTC</option>
                                            @endif
                                            @if ($moresettings->link == 'enabled')
                                                <option value="link">LINK</option>
                                            @endif
                                            @if ($moresettings->bnb == 'enabled')
                                                <option value="bnb">BNB</option>
                                            @endif
                                            @if ($moresettings->ada == 'enabled')
                                                <option value="ada">ADA</option>
                                            @endif
                                            @if ($moresettings->aave == 'enabled')
                                                <option value="aave">AAVE</option>
                                            @endif
                                            @if ($moresettings->xlm == 'enabled')
                                                <option value="xlm">XLM</option>
                                            @endif
                                            @if ($moresettings->xrp == 'enabled')
                                                <option value="xrp">XRP</option>
                                            @endif
                                            @if ($moresettings->ltc == 'enabled')
                                                <option value="ltc">LTC</option>
                                            @endif
                                            @if ($moresettings->bch == 'enabled')
                                                <option value="bch">BCH</option>
                                            @endif
                                            @if ($moresettings->eth == 'enabled')
                                                <option value="eth">ETH</option>
                                            @endif
                                            @if ($moresettings->usdt == 'enabled')
                                                <option value="usdt">USDT</option>
                                            @endif
                                            <option value="usd">USD</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <p class="text-{{ $text }}">Destination Account</p>
                                        <select name="destination" class="form-control text-{{ $text }} "
                                            id="destinationasset">
                                            <option value="usd">USD</option>
                                            @if ($moresettings->btc == 'enabled')
                                                <option value="btc">BTC</option>
                                            @endif
                                            @if ($moresettings->link == 'enabled')
                                                <option value="link">LINK</option>
                                            @endif
                                            @if ($moresettings->bnb == 'enabled')
                                                <option value="bnb">BNB</option>
                                            @endif
                                            @if ($moresettings->ada == 'enabled')
                                                <option value="ada">ADA</option>
                                            @endif
                                            @if ($moresettings->aave == 'enabled')
                                                <option value="aave">AAVE</option>
                                            @endif
                                            @if ($moresettings->xlm == 'enabled')
                                                <option value="xlm">XLM</option>
                                            @endif
                                            @if ($moresettings->xrp == 'enabled')
                                                <option value="xrp">XRP</option>
                                            @endif
                                            @if ($moresettings->ltc == 'enabled')
                                                <option value="ltc">LTC</option>
                                            @endif
                                            @if ($moresettings->bch == 'enabled')
                                                <option value="bch">BCH</option>
                                            @endif
                                            @if ($moresettings->eth == 'enabled')
                                                <option value="eth">ETH</option>
                                            @endif
                                            @if ($moresettings->usdt == 'enabled')
                                                <option value="usdt">USDT</option>
                                            @endif
                                        </select>
                                        <small class="text-{{ $text }}">NOTE:USD is your account balance.</small>
                                    </div>

                                    <div class="form-group">
                                        <p class="text-{{ $text }}">Amount</p>
                                        <input type="text" name="amount"
                                            class="form-control text-{{ $text }} "
                                            placeholder="Enter amount of btc" id="amount">
                                    </div>
                                    <div class="form-group">
                                        <p class="text-{{ $text }}">You will get</p>
                                        <input type="text" class="form-control text-{{ $text }} "
                                            placeholder="Quantity of usd" id="quantity" readonly </div>
                                        <input type="hidden" id="realquantity" name="quantity">
                                        <div class="form-group">
                                            <span class="mb-1 ml-2 caption">
                                                <span class="text-{{ $text }}"><b>Fees =
                                                        {{ $moresettings->fee }}%</b></span>
                                            </span>
                                        </div>

                                        <div class="cta inline-group">
                                            <button class="btn btn-success btn-block btn-sm" disbaled>
                                                Swap
                                            </button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
    <script type="text/javascript">
        new TradingView.widget({
            "width": "100%",
            "height": "400",
            "symbol": "COINBASE:BTCUSD",
            "interval": "1",
            "timezone": "Etc/UTC",
            "theme": '<?php echo $bg; ?>',
            "style": "9",
            "locale": "en",
            "toolbar_bg": "#f1f3f6",
            "enable_publishing": false,
            "hide_side_toolbar": false,
            "allow_symbol_change": true,
            "calendar": false,
            "studies": [
                "BB@tv-basicstudies"
            ],
            "container_id": "tradingview_f933e"
        });
    </script>

    @include('user.exchangescript')
@endsection
