@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel ">
        <div class="content">
            <div class="page-inner">
                <x-danger-alert />
                <x-success-alert />
                <div class="mt-2 mb-4">
                    <h1 class="title1 m-0">Trade Signals Subscribers</h1>
                    <p>See users subscription</p>
                </div>
                <div class="mb-5 row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Subscribers</h5>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="bg-primary text-white">
                                            <th>
                                                Subscriber
                                            </th>
                                            <th>
                                                Subscription
                                            </th>
                                            <th>
                                                Amount
                                            </th>
                                            <th>
                                                Expiration
                                            </th>
                                            <th>
                                                Started At
                                            </th>
                                            <th></th>
                                        </thead>
                                        <tbody>
                                            @forelse ($subscribers->data as $subscriber)
                                                <tr>
                                                    <td>
                                                        {{ \App\Models\User::find($subscriber->client_id)->name }}
                                                    </td>
                                                    <td>{{ $subscriber->subscription }}</td>
                                                    <td>{{ $settings->currency }}{{ $subscriber->amount_paid }}</td>
                                                    <td>
                                                        @if (now()->greaterThanOrEqualTo($subscriber->expired_at))
                                                            <span class="text-danger">
                                                                {{ \Carbon\Carbon::parse($subscriber->expired_at)->toDayDateTimeString() }}</span>
                                                        @else
                                                            <span class="text-success">
                                                                {{ \Carbon\Carbon::parse($subscriber->expired_at)->toDayDateTimeString() }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($subscriber->created_at)->toDayDateTimeString() }}
                                                    </td>
                                                    <td>
                                                        {{-- @if (now()->greaterThanOrEqualTo($subscriber->expired_at))
                                                            <button class="btn btn-danger btn-sm">Remove from group</button>
                                                        @endif --}}
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">
                                                        No Data Available
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                {{-- {{ $subscribers->links() }} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
