
@extends('layouts.dash')
@section('title', $title)
@section('content')
    <!-- Page title -->
    <div class="page-title">
        <div class="row justify-content-between align-items-center">
            <div class="mb-3 col-md-6 mb-md-0">
                <h5 class="mb-0 text-white h3 font-weight-400">Swapping History</h5>
            </div>
        </div>
    </div>
    <x-danger-alert/>
	<x-success-alert/>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-2 d-block">
                        <a class="btn btn-primary btn-sm" href="{{route('assetbalance')}}"> <i class="fas fa-arrow-left"></i> back</a> 
                    </div>
                    <div class="p-2 mb-5 shadow p-md-4 row card ">
                        <div class="col-12">
                            <div class="table-responsive" data-example-id="hoverable-table">
                                <table id="UserTable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Source</th>
                                            <th>Destination</th>
                                            <th>Amount(src)</th>
                                            <th>Quantity(dest)</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($transactions as $tran)
                                        <tr>
                                            <td>{{$tran->source}}</td>
                                            <td>{{$tran->dest}}</td>
                                            <td>{{round(number_format($tran->amount, 2, '.', ','), 6)}}</td>
                                            <td>{{round($tran->quantity, 6)}}</td>
                                            <td>{{\Carbon\Carbon::parse($tran->created_at)->toDayDateTimeString()}}</td>
                                            
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="14" class="text-center">No record available</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                {{$transactions->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
@endsection