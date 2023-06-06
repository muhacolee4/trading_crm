<?php
if (Auth('admin')->User()->dashboard_style == 'light') {
    $text = 'dark';
    $bg = 'light';
} else {
    $bg = 'dark';
    $text = 'light';
}
?>
@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel ">
        <div class="content ">
            <div class="page-inner">
                <div class="mt-2 mb-4">
                    <h1 class="title1 text-{{ $text }}">{{ $settings->site_name }} KYC Application list</h1>
                </div>
                <x-danger-alert />
                <x-success-alert />
                <div class="mb-5 row">

                    <div class="col-12 card p-4  shadow">
                        <div class="bs-example widget-shadow table-responsive" data-example-id="hoverable-table">
                            <table id="ShipTable" class="table table-hover  text-{{ $text }}">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>KYC Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kycs as $list)
                                        <tr>
                                            <td>{{ $list->user->name }}</td>

                                            <td>
                                                @if ($list->status == 'Verified')
                                                    <span class="badge badge-success">Verified</span>
                                                @else
                                                    <span class="badge badge-danger">{{ $list->status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('viewkyc', $list->id) }}"
                                                    class="btn btn-primary btn-sm">View application</a>

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
