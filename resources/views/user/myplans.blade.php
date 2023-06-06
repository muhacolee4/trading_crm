@extends('layouts.dash')
@section('title', $title)
@section('content')
    <!-- Page title -->
    <div class="page-title">
        <div class="row justify-content-between align-items-center">
            <div class="mb-3 col-md-6 mb-md-0">
                <h5 class="mb-0 text-white h3 font-weight-400">My Investment plans
                    ({{ request()->route('sort') == 'yes' ? 'Active' : request()->route('sort') }})</h5>
            </div>
        </div>
    </div>
    <x-danger-alert />
    <x-success-alert />
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if ($numOfPlan > 0)
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <select name="sortplan" id="sortvalue"
                                    class="custom-select custom-select-sm form-control w-25">
                                    <option value="All">All</option>
                                    <option value="yes">Active</option>
                                    <option value="cancelled">Cancelled/Inactive</option>
                                    <option value="expired">Expired</option>
                                </select>
                                <a href="javascript:;" id="sortform" class="btn btn-primary btn-sm">Sort</a>
                            </div>
                        </div>
                    @endif

                    @forelse ($plans as $plan)
                        <div class="mt-4 row">
                            <div class="col-md-12">
                                <div class="py-4 card">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            {{-- <span class="mr-1 mr fas fa-history fa-3x text-primary"></span> --}}
                                            <div class="">
                                                <h6 class="text-black h6">{{ $plan->dplan->name }}</h6>
                                                <p class="text-muted">Amount - <span
                                                        class="amount">{{ $settings->currency }}{{ number_format($plan->amount) }}</span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-none d-md-block">
                                            <div class="d-flex justify-content-around">
                                                <div class="mr-3">
                                                    <h6 class="text-black bold">
                                                        {{ $plan->created_at->addHour()->toDayDateTimeString() }}</h6>
                                                    <span class="nk-iv-scheme-value date">Start Date</span>
                                                </div>
                                                <i class="fas fa-arrow-right text-muted"></i>
                                                <div class="ml-3">
                                                    <h6 class="text-black bold">
                                                        {{ \Carbon\Carbon::parse($plan->expire_date)->addHour()->toDayDateTimeString() }}
                                                    </h6>
                                                    <span class="nk-iv-scheme-value date">End Date</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="">
                                            <h6 class="text-black">
                                                @if ($plan->active == 'yes')
                                                    <span class="badge badge-success">Active</span>
                                                @elseif($plan->active == 'expired')
                                                    <span class="badge badge-danger">Expired</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </h6>
                                            <span class="nk-iv-scheme-value amount">Status</span>
                                        </div>

                                        <a href="{{ route('plandetails', $plan->id) }}">
                                            <i class="fas fa-chevron-right fa-2x"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @empty
                        <div class="mt-4 row">
                            <div class="col-md-12">
                                <div class="py-4 card">
                                    <div class="text-center card-body">

                                        <p>You do not have an investment plan at the moment or no value match your query.
                                        </p>
                                        <a href="{{ route('mplans') }}" class="px-3 btn btn-primary">Buy a plan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforelse
                    @if (count($plans) > 0)
                        <div class="row">
                            <div class="mt-2 col-12">
                                {{ $plans->links() }}
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        var sortvalue = document.getElementById('sortvalue');
        var sortform = document.getElementById('sortform');
        let makepayurl = "{{ url('/dashboard/sort-plans/All') }}";
        sortform.href = makepayurl;
        sortvalue.addEventListener('change', function() {
            makepayurl = "{{ url('/dashboard/sort-plans/') }}" + '/' + sortvalue.value;
            sortform.href = makepayurl;
        })
    </script>

@endsection
