@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel">
        <div class="content ">
            <div class="page-inner">
                <div class="mt-2 mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="title1 ">Add Investment Plan</h1>
                        </div>
                        <div>
                            <a href="{{ route('plans') }}" class="btn btn-sm btn-primary"> <i class="fa fa-arrow-left"></i>
                                Back</a>
                        </div>
                    </div>
                </div>
                <x-danger-alert />
                <x-success-alert />
                <div class="mb-5 row">
                    <div class="col-lg-12 ">
                        <div class="p-3 card ">
                            <form role="form" method="post" action="{{ route('addplan') }}">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <h5 class="">Plan Name</h5>
                                        <input class="form-control  " placeholder="Enter Plan name" type="text"
                                            name="name" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="">Plan price({{ $settings->currency }})</h5>
                                        <input class="form-control  " placeholder="Enter Plan price" type="number"
                                            name="price" required>
                                        <small class="">This is the maximum amount a user can pay
                                            to invest in this plan, enter the value without a comma(,)</small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="">Plan Minimum Price
                                            ({{ $settings->currency }})</h5>
                                        <input placeholder="Enter Plan minimum price" class="form-control" type="number"
                                            name="min_price" required>
                                        <small class="">This is the minimum amount a user can pay
                                            to invest in this plan, enter the value without a comma(,)</small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="">Plan Maximum Price
                                            ({{ $settings->currency }})</h5>
                                        <input class="form-control  " placeholder="Enter Plan maximum price" type="number"
                                            name="max_price" required>
                                        <small class="">Same as plan price, enter the value without
                                            a comma(,)</small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="">Minimum return (%)</h5>
                                        <input class="form-control" placeholder="Enter minimum return" type="number"
                                            step="any" name="minr" required>
                                        <small class="">This is the minimum return (ROI) for this
                                            plan, enter the value without a comma(,)</small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="">Maximum return (%)</h5>
                                        <input class="form-control  " placeholder="Enter maximum return" type="number"
                                            step="any" name="maxr" required>
                                        <small class="">This is the Maximum return (ROI) for this
                                            plan, enter the value without a comma(,)</small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="">Gift Bonus ({{ $settings->currency }})</h5>
                                        <input class="form-control" placeholder="Enter Additional Gift Bonus" type="number"
                                            step="any" name="gift" value="0" required>
                                        <small class="">Optional Bonus if a user buys this
                                            plan.enter the value without a comma(,) </small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="">Top up Interval</h5>
                                        <select class="form-control  " name="t_interval">
                                            <option>Monthly</option>
                                            <option>Weekly</option>
                                            <option>Daily</option>
                                            <option>Hourly</option>
                                            <option>Every 30 Minutes</option>
                                            <option>Every 10 Minutes</option>
                                        </select>
                                        <small class="">
                                            This specifies how often the system should add profit(ROI) to user account.
                                        </small>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5 class="">Top up Type</h5>
                                        <select class="form-control  " name="t_type">
                                            <option>Percentage</option>
                                            <option>Fixed</option>
                                        </select>
                                        <small class="">This specifies if the system should add
                                            profit in percentage(%) or a fixed amount.</small>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <h5 class="">Top up Amount (in % or
                                            {{ $settings->currency }} as specified above)</h5>
                                        <input class="form-control  " placeholder="top up amount" type="number"
                                            step="any" name="t_amount" required>
                                        <small class="">This is the amount the system will add to
                                            users account as profit, based on what you selected in topup type and topup
                                            interval above.</small>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <h5 class="">Investment Duration</h5>
                                        <input class="form-control" placeholder="eg 1 Days, 2 Weeks, 1 Months"
                                            type="text" name="expiration" required>
                                        <small class="">This specifies how long the investment plan
                                            will run. Please strictly follow the guide on <a href=""
                                                data-toggle="modal" data-target="#durationModal">how to setup investment
                                                duration</a> else it may not work. </small>

                                    </div>
                                    <div class="form-group col-md-12">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-primary" value="Add Plan">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="durationModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body ">
                        <h5 class="">FIRSTLY, Always preceed the time frame with a digit, that is
                            do not write the number in letters, <br> <br> SECONDLY, always add space after the number, <br>
                            <br> LASTLY, the first letter of the timeframe should be in CAPS and always add 's' to the
                            timeframe even if your duration is just a day, month or year.
                        </h5>
                        <h2 class="">Eg, 1 Days, 3 Weeks, 1 Hours, 48 Hours, 4 Months, 1 Years, 9
                            Months</h2>

                    </div>
                </div>
            </div>
        </div>
        <div id="topupModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body ">

                    </div>
                </div>
            </div>
        </div>

        <script>
            function getduration(id, event) {
                event.preventDefault();
                document.getElementById('duridden').value = id;
            }
        </script>
    @endsection
