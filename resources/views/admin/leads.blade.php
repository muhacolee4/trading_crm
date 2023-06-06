@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel ">
        <div class="content ">
            <div class="page-inner">
                <div class="my-2 mb-4 d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="title1">Manage leads </h1>
                        <p class="">Leads are simply new users that have not made any deposit.</p>
                    </div>
                    <div>
                        <a href="#" data-toggle="modal" data-target="#assignModal" class="btn btn-primary">Assign</a>
                        <!-- Assign Modal -->
                        <div id="assignModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header ">
                                        <h4 class="modal-title ">Assign users to admin for follow up
                                        </h4>
                                        <button type="button" class="close " data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body ">
                                        <form role="form" method="post" action="{{ route('assignuser') }}">
                                            @csrf
                                            <div class="form-group">
                                                <h5 class="">Select User to Assign</h5>
                                                <select name="user_name" id="" class="form-control select2"
                                                    style="width:100%">
                                                    @foreach ($users as $user)
                                                        <option value="{{ $user->id }} ">{{ $user->name }}
                                                            {{ $user->l_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <h5 class="">Select Admin to assign this user to.
                                                </h5>
                                                <select name="admin" id="" class="form-control">
                                                    <option value="">Select</option>
                                                    @foreach ($admin as $user)
                                                        <option value="{{ $user->id }}">{{ $user->firstName }}
                                                            {{ $user->lastName }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-info" value="Assign">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <x-danger-alert />
                <x-success-alert />

                <div class="mb-3 row">
                    <div class="col-lg-6">
                        <p class="m-0 ml-3">Import leads from excel document. <a href="{{ route('downlddoc') }}"
                                class=" text-underline">download
                                sample document</a></p>
                        <form action="{{ route('fileImport') }}" class="form-inline" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input name="file" class="form-control  " type="file" required>
                            </div>
                            <div>
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive" data-example-id="hoverable-table">
                                    <table id="ShipTable" class="table table-hover ">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Status</th>
                                                <th>Date registered</th>
                                                <th>Assigned To</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $list)
                                                <tr>
                                                    <td>{{ $list->name }}</td>
                                                    <td>{{ $list->email }}</td>
                                                    <td>{{ $list->phone }}</td>
                                                    <td>
                                                        @if ($list->status == 'active')
                                                            <span class="badge badge-success">Active</span>
                                                        @else
                                                            <span class="badge badge-danger">Inactive</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $list->created_at->toDayDateTimeString() }}
                                                    </td>
                                                    <td>
                                                        @if ($list->tuser->firstName)
                                                            {{ $list->tuser->firstName }} {{ $list->tuser->lastName }}
                                                        @else
                                                            <span class="text-info">Not assigned yet</span>
                                                        @endif

                                                    </td>
                                                    <td>
                                                        <a class="m-1 btn btn-info btn-sm text-white" data-toggle="modal"
                                                            data-target="#editModal{{ $list->id }}">Edit Status</a>
                                                    </td>
                                                </tr>

                                                <div id="editModal{{ $list->id }}" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header ">
                                                                <h4 class="modal-title">Edit this User status</h4>
                                                                <button type="button" class="close "
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body ">
                                                                <form method="post" action="{{ route('updateuser') }}">
                                                                    <div class="form-group">
                                                                        <h5 class=" ">User Status</h5>
                                                                        <textarea name="userupdate" id="" rows="5" class="form-control  " placeholder="Enter here" required>{{ $list->userupdate }}</textarea>
                                                                    </div>
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $list->id }}">
                                                                    <input type="hidden" name="_token"
                                                                        value="{{ csrf_token() }}">
                                                                    <input type="submit" class="btn btn-primary"
                                                                        value="Save">

                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $('.select2').select2();
            </script>
        </div>
    @endsection
