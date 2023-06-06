<?php
if (Auth('admin')->User()->dashboard_style == 'light') {
    $text = 'dark';
    $bg = 'light';
} else {
    $text = 'light';
    $bg = 'dark';
}
?>
@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel ">
        <div class="content ">
            <div class="page-inner">
                <div class="mt-2 mb-3 d-flex justify-content-between">
                    <div>
                        <h1 class="title1 text-{{ $text }} d-inline mr-4">Courses</h1>
                        <p>List all the courses you have created.</p>
                    </div>
                    <div>
                        <button class="btn btn-light shadow-sm px-3 border" type="button" data-toggle="modal"
                            data-target="#adduser">
                            <i class=" fa fa-plus"></i>
                            Create New
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" tabindex="-1" id="adduser" aria-h6ledby="exampleModalh6"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header ">
                                        <h3 class="mb-2 d-inline text-{{ $text }}">Add Course</h3>
                                        <button type="button" class="close text-{{ $text }}" data-dismiss="modal"
                                            aria-h6="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body ">
                                        <div>
                                            <form method="POST" action="{{ route('addcourse') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <h6 class="text-{{ $text }}">Course Category</h6>
                                                        <select name="category" id=""
                                                            class="form-control  text-{{ $text }}">
                                                            <option value="Null">Null</option>
                                                            @foreach ($categories as $cat)
                                                                <option value="{{ $cat->category }}">{{ $cat->category }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <h6 class="text-{{ $text }}">Course Title</h6>
                                                        <input type="text" class="form-control  text-{{ $text }}"
                                                            name="title" required>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <h6 class="text-{{ $text }}">Description</h6>
                                                        <textarea name="desc" id="" cols="4" class="form-control  text-{{ $text }}" required></textarea>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <h6 class="text-{{ $text }}">Amount
                                                            {{ $settings->currency }}
                                                        </h6>
                                                        <input type="number"
                                                            class="form-control  text-{{ $text }}" name="amount">
                                                        <span class="text-{{ $text }} mt-2"> Enter amount a user
                                                            can
                                                            pay to
                                                            get this course. If empty the course will
                                                            be available for free.
                                                        </span>
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <h6 class="text-{{ $text }}">Course Image (File)</h6>
                                                        <input type="file"
                                                            class="form-control  text-{{ $text }}" name="image">

                                                        @error('image')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <h6 class="text-{{ $text }}">Course Image (Url)</h6>
                                                        <input type="text"
                                                            class="form-control  text-{{ $text }}"
                                                            name="image_url">
                                                    </div>
                                                    <h6 class="text-{{ $text }}">Use either file upload or url to
                                                        choose a course image, if both is entered, the file upload will be
                                                        used.
                                                    </h6>
                                                </div>
                                                <button type="submit" class="px-4 btn btn-primary">Add Course</button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End add user modal --}}
                    </div>
                </div>
                <x-danger-alert />
                <x-success-alert />

                <div class="mt-2 mb-5 row">
                    {{-- <div class="col-12 mb-4">
                        <form action="{{ route('courses') }}" method="GET" class=" form-inline">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Find a course" name="searchValue"
                                    required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit"
                                        id="button-addon2">Find</button>
                                </div>
                            </div>
                        </form>
                    </div> --}}
                    @forelse ($courses->data as $course)
                        <div class="col-md-4">
                            <div class="card ">
                                <img src="{{ str_starts_with($course->course->course_image, 'http') ? $course->course->course_image : asset('storage/' . $course->course->course_image) }}"
                                    class="card-img-top" alt="course image">
                                <div class="card-body">
                                    <h4 class="text-{{ $text }} font-weight-bolder">
                                        {{ $course->course->course_title }}
                                    </h4>
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <a href="#" class="btn btn-primary btn-sm px-2" data-toggle="modal"
                                            data-target="#editcourse{{ $course->course->id }}">Edit Course</a>
                                        <a href="{{ route('lessons', $course->course->id) }}">
                                            <div class="d-flex align-items-center text-{{ $text }}">
                                                <i class="mr-1 fa fa-book"></i>
                                                <span>
                                                    {{ count($course->lessons) }}
                                                    {{ count($course->lessons) > 1 ? 'Lessons' : 'Lesson' }}
                                                </span>
                                                <i class="fa fa-share ml-1"></i>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="mt-3">
                                        <h2 class=" font-weight-bolder text-{{ $text }}">
                                            {{ !$course->course->amount ? 'Free' : $settings->currency . $course->course->amount }}
                                        </h2>
                                    </div>
                                    <a href="#" class="btn btn-danger btn-sm px-2 btn-block mt-3" data-toggle="modal"
                                        data-target="#courseDeleteModal{{ $course->course->id }}">Delete
                                        Course</a>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" tabindex="-1" id="editcourse{{ $course->course->id }}"
                            aria-h6ledby="exampleModalh6" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header ">
                                        <h3 class="mb-2 d-inline text-{{ $text }}">Update Course</h3>
                                        <button type="button" class="close text-{{ $text }}"
                                            data-dismiss="modal" aria-h6="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body ">
                                        <div>
                                            <form method="POST" action="{{ route('updatecourse') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PATCH')
                                                <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <h6 class="text-{{ $text }}">Course Category</h6>
                                                        <select name="category" id=""
                                                            class="form-control  text-{{ $text }}">
                                                            <option value="{{ $course->course->category }}">
                                                                {{ $course->course->category }}</option>
                                                            @foreach ($categories as $cat)
                                                                <option value="{{ $cat->category }}">{{ $cat->category }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <h6 class="text-{{ $text }}">Course Title</h6>
                                                        <input type="text"
                                                            class="form-control  text-{{ $text }}" name="title"
                                                            value="{{ $course->course->course_title }}" required>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <h6 class="text-{{ $text }}">Description</h6>
                                                        <textarea name="desc" id="" cols="4" class="form-control  text-{{ $text }}" required>
                                                        {{ $course->course->description }}
                                                        </textarea>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <h6 class="text-{{ $text }}">Amount
                                                            {{ $settings->course->currency }}
                                                        </h6>
                                                        <input type="number"
                                                            class="form-control  text-{{ $text }}" name="amount"
                                                            value="{{ $course->course->amount }}">
                                                        <span class="text-{{ $text }} mt-2"> Enter amount a user
                                                            can
                                                            pay to
                                                            get this course. If empty the course will
                                                            be available for free.</span>

                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <h6 class="text-{{ $text }}">Course Image (File)</h6>
                                                        <input type="file"
                                                            class="form-control  text-{{ $text }}"
                                                            name="image">

                                                        @error('image')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <h6 class="text-{{ $text }}">Course Image (Url)</h6>
                                                        <input type="text"
                                                            class="form-control  text-{{ $text }}"
                                                            name="image_url" value="{{ $course->course->course_image }}">
                                                    </div>
                                                    <h6 class="text-{{ $text }}">Use either file upload or url to
                                                        choose a course image, if both is entered, the file upload will be
                                                        used.
                                                    </h6>
                                                </div>
                                                <input type="hidden" name="course_id"
                                                    value="{{ $course->course->id }}">
                                                <button type="submit" class="px-4 btn btn-primary">Update Course</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End add user modal --}}

                        <!-- Modal -->
                        <div class="modal fade" tabindex="-1" id="courseDeleteModal{{ $course->course->id }}"
                            aria-h6ledby="exampleModalh6" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header ">
                                        <h3 class="mb-2 d-inline text-{{ $text }}">Delete Course</h3>
                                        <button type="button" class="close text-{{ $text }}"
                                            data-dismiss="modal" aria-h6="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body ">
                                        <div>
                                            <p class="text-{{ $text }}">Are you sure you want delete this Course
                                                and it's related lessons?
                                            </p>
                                            <a href="{{ route('deletecourse', $course->course->id) }}"
                                                class="btn btn-danger">DELETE</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End add user modal --}}
                    @empty
                        <div class="col-md-12">
                            <div class="card  text-center py-5">
                                <h5 class="text-{{ $text }}">No Course added</h5>
                                <div>
                                    <button class="btn btn-secondary px-3" data-toggle="modal" data-target="#adduser">Add
                                        Course</button>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    @endsection
