@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel ">
        <div class="content ">
            <div class="page-inner">
                <div class="my-2 mb-4">
                    <h1 class="title1 ">Manage All Task</h1>
                </div>
                <x-danger-alert />
                <x-success-alert />
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive" data-example-id="hoverable-table">
                                    <table id="ShipTable" class="table table-hover ">
                                        <thead>
                                            <tr>
                                                <th>Task Title</th>
                                                <th>Assigned To</th>
                                                <th>From Date</th>
                                                <th>To Date</th>
                                                <th>Status</th>
                                                <th>Date Created</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tasks as $task)
                                                <tr>
                                                    <td>{{ $task->title }}</td>
                                                    <td>{{ $task->tuser->firstName }} {{ $task->tuser->lastName }}</td>
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
                                                            <a class="btn btn-success btn-sm m-1 text-white"
                                                                data-toggle="modal"
                                                                data-target="#edittaskModal{{ $task->id }}">Edit</a>
                                                        @endif

                                                        <a href="{{ url('admin/dashboard/deltask') }}/{{ $task->id }}"
                                                            class="btn btn-danger btn-sm m-1">Delete</a>
                                                    </td>
                                                </tr>

                                                <div id="edittaskModal{{ $task->id }}" class="modal fade"
                                                    role="dialog">
                                                    <div class="modal-dialog">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header ">
                                                                <h4 class="modal-title">Edit this Task</h4>
                                                                <button type="button" class="close "
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body ">
                                                                <form method="post" action="{{ route('updatetask') }}"
                                                                    enctype="multipart/form-data">
                                                                    <div class="form-group">
                                                                        <div class=" ">
                                                                            <h5 class=" ">Task Title</h5>
                                                                            <input type="text" name="tasktitle"
                                                                                value="{{ $task->title }}"
                                                                                class="form-control  " required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <div class=" ">
                                                                            <h5 class=" ">Note </h5>
                                                                            <textarea name="note" id="" rows="5" class="form-control  " required>{{ $task->note }}</textarea>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <h5 class=" ">Task Delegations</h5>
                                                                        <select class="form-control  " name="delegation"
                                                                            required>
                                                                            <option value="{{ $task->designation }}">
                                                                                {{ $task->tuser->firstName }}
                                                                                {{ $task->tuser->lastName }}</option>
                                                                            @foreach ($admin as $user)
                                                                                <option value="{{ $user->id }}">
                                                                                    {{ $user->firstName }}
                                                                                    {{ $user->lastName }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <div class="form-row">
                                                                            <div class="col-md-6">
                                                                                <h5 class=" ">From</h5>
                                                                                <input type="date" name="start_date"
                                                                                    value="{{ $task->start_date }}"
                                                                                    class="form-control  " required>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <h5 class=" ">To</h5>
                                                                                <input type="date"
                                                                                    value="{{ $task->end_date }}"
                                                                                    name="end_date" class="form-control  "
                                                                                    required>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <h5 class=" ">Priority</h5>
                                                                        <select class="form-control  " name="priority"
                                                                            required>
                                                                            <option value="{{ $task->priority }}">
                                                                                {{ $task->priority }}</option>
                                                                            <option>Immediately</option>
                                                                            <option>High</option>
                                                                            <option>Medium</option>
                                                                            <option>Low</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="hidden" name="id"
                                                                            value="{{ $task->id }}">
                                                                        <input type="hidden" name="_token"
                                                                            value="{{ csrf_token() }}">
                                                                        <input type="submit" class="btn btn-primary"
                                                                            value="Apply Change">
                                                                    </div>


                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /send all users email Modal -->
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endsection
