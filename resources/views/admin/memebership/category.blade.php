@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel ">
        <div class="content ">
            <div class="page-inner">
                <div class="mt-2 mb-3 d-lg-flex justify-content-lg-between">
                    <div>
                        <h1 class="title1 d-inline mr-4">Category</h1>
                        <small class="">Categorize your course</small>
                    </div>
                </div>
                <x-danger-alert />
                <x-success-alert />
                <div class="mt-4 row">
                    <div class="col-lg-6 offset-lg-3 mb-4">
                        <form action="{{ route('addcategory') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <h6 class="">Category Name</h6>
                                <input type="text" class="form-control  border border-primary" name="category" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="px-5 btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 mt-3">
                        <h5 class="">Categories List</h5>
                        <div class=" table-responsive">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $item)
                                        <tr>
                                            <td>{{ $item->category->category }}</td>
                                            <td>
                                                <a href="{{ route('deletecategory', $item->category->id) }}"
                                                    class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center"> No Data Available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
