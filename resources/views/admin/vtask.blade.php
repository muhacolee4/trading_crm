<?php
if (Auth('admin')->User()->dashboard_style == 'light') {
    $text = 'dark';
} else {
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
                <div class="mt-2">
                    <h1 class="title1 ">View My Task</h1> <br> <br>
                </div>
                <x-danger-alert />
                <x-success-alert />
                <div class="row mb-5">
                    <div class="col-lg-12 card p-4  shadow">
                        <div class="table-responsive" data-example-id="hoverable-table">
                            <table id="ShipTable" class="table table-hover ">
                                <thead>
                                    <tr>
                                        <th>Task Title</th>
                                        <th>Assigned To</th>
                                        <th>Note</th>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>Status</th>
                                        <th>Date Created</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tasks as $task)
                                        <tr>
                                            <td>{{ $task->title }}</td>
                                            <td>{{ $task->tuser->firstName }} {{ $task->tuser->lastName }}</td>
                                            <td>{{ $task->note }}</td>
                                            <td>{{ $task->start_date }}</td>
                                            <td>{{ $task->end_date }}</td>
                                            <td>
                                                @if ($task->status == 'Pending')
                                                    <span class="badge badge-danger">{{ $task->status }}</span>
                                                @else
                                                    <span class=" badge badge-success">{{ $task->status }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $task->created_at->toDayDateTimeString() }}</td>
                                            <td>
                                                @if ($task->status == 'Pending')
                                                    <a href="{{ url('admin/dashboard/markdone') }}/{{ $task->id }}"
                                                        class="btn btn-primary btn-sm m-1">Mark as Done</a>
                                                @else
                                                    <a class="btn btn-success btn-sm m-1">No Action Needed</a>
                                                @endif

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
