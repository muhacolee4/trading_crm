@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel ">
        <div class="content ">
            <div class="page-inner">
                <div class="mt-2 mb-4">
                    <h1 class="title1 ">Create New Task</h1>
                </div>
                <x-danger-alert />
                <x-success-alert />
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="card">
                            <div class="card-body">
                                <form method="post" action="{{ route('addtask') }}" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <h5 class=" ">Task Title</h5>
                                        <input type="text" name="tasktitle" class="form-control  "
                                            placeholder="task title" required>
                                    </div>

                                    <div class="form-group">
                                        <h5 class=" ">Note </h5>
                                        <textarea name="note" id="" rows="5" class="form-control  " placeholder="task description" required></textarea>
                                    </div>

                                    <div class="form-group">
                                        <h5 class=" ">Task Delegations</h5>
                                        <select class="form-control  " name="delegation" required>
                                            @foreach ($admin as $user)
                                                <option value="{{ $user->id }}">{{ $user->firstName }}
                                                    {{ $user->lastName }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="">Admin to assign this task to</small>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <h5 class=" ">From</h5>
                                                <input type="date" name="start_date" class="form-control  "
                                                    placeholder="First name" required>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class=" ">To</h5>
                                                <input type="date" name="end_date" class="form-control  "
                                                    placeholder="Last name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5 class=" ">Priority</h5>
                                        <select class="form-control  " name="priority" required>
                                            <option>Immediately</option>
                                            <option>High</option>
                                            <option>Medium</option>
                                            <option>Low</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="id" value="{{ Auth('admin')->User()->id }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-primary" value="Submit">
                                    </div>

                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endsection
