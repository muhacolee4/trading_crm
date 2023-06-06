@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <x-danger-alert />
                <x-success-alert />
                @include('admin.subscription.master.statistics')
                <div class="mb-5 row">
                    <div class="col-md-12">
                        @if ($accounts and count($accounts) < 1)
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-center">
                                        <h5 class="card-title">No Master Trading Account</h5>
                                        <p>Add a master account</p>
                                        <a href="{{ route('create.master') }}" type="button"
                                            class="text-white btn btn-primary" data-toggle="modal"
                                            data-target="#masterModal">
                                            Add Account
                                        </a>
                                    </div>

                                </div>
                            </div>
                        @else
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-center">
                                        <p>Add a master account</p>
                                        <a href="{{ route('create.master') }}" type="button"
                                            class="text-white btn btn-primary" data-toggle="modal"
                                            data-target="#masterModal">
                                            Add Account
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <h1 class=" font-weight-bold d-md-block d-none">Your Master(Provider) Accounts
                                            </h1>
                                            <h2 class=" font-weight-bold d-md-none d-block">Your Master(Provider) Accounts
                                            </h2>
                                            <p class="text-primary font-weight-bold">
                                                NOTE: Your master Account will be
                                                deleted after
                                                10 days of
                                                expiration and have not been renewed.
                                            </p>
                                            <div class=" table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Account ID</th>
                                                            <th>Account Password</th>
                                                            <th>Account Type</th>
                                                            <th>Account Name</th>
                                                            <th>Server</th>
                                                            <th>Deployment status</th>
                                                            <th>Started at</th>
                                                            <th>Expiring at</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($accounts as $item)
                                                            <tr>
                                                                <td>
                                                                    {{ $item['login'] }}
                                                                </td>
                                                                <td>
                                                                    {{ $item['password'] }}
                                                                </td>
                                                                <td>
                                                                    {{ $item['account_type'] }}
                                                                </td>
                                                                <td>
                                                                    {{ $item['account_name'] }}
                                                                </td>
                                                                <td>
                                                                    {{ $item['server'] }}
                                                                </td>
                                                                <td>
                                                                    @if ($item['deployment_status'] == 'Deployed')
                                                                        <h2 class="badge badge-success">
                                                                            {{ $item['deployment_status'] }}</h2>
                                                                    @else
                                                                        <h2 class="badge badge-warning">
                                                                            {{ $item['deployment_status'] }}</h2>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <span>{{ \Carbon\Carbon::parse($item['start_date'])->toDayDateTimeString() }}</span>
                                                                </td>
                                                                <td>
                                                                    {{ \Carbon\Carbon::parse($item['end_date'])->toDayDateTimeString() }}
                                                                </td>
                                                                <td>
                                                                    @if (now()->greaterThanOrEqualTo(\Carbon\Carbon::parse($item['end_date'])))
                                                                        <a href="#" class="btn btn-info btn-sm m-1"
                                                                            data-toggle="modal"
                                                                            data-target="#renewModal{{ $item['id'] }}">Renew</a>
                                                                    @endif
                                                                    <button type="button" data-toggle="modal"
                                                                        data-target="#strategyModal{{ $item['id'] }}"
                                                                        class="btn btn-secondary btn-sm m-1">
                                                                        <span>
                                                                            Update Strategy
                                                                        </span>
                                                                    </button>
                                                                    <button type="button" data-toggle="modal"
                                                                        data-target="#deleteModal{{ $item['id'] }}"
                                                                        class="btn btn-danger btn-sm m-1">
                                                                        <i class="fa fa-trash"></i>
                                                                        <span> Delete</span>
                                                                    </button>
                                                                    @include('admin.subscription.master.delete-master')
                                                                    @include('admin.subscription.master.renew-master')
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="9" class="text-center">
                                                                    No Data Available
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @include('admin.subscription.master.create-master')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
