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
                <a href="{{ route('courses') }}" class="btn btn-info btn-sm">
                    <i class="fa fa-arrow-left"></i>
                    <span>Back</span>
                </a>
                <div class="mt-2 mb-3 d-lg-flex justify-content-lg-between">
                    <div>
                        <h1 class="title1 text-{{ $text }} d-inline mr-4">Lessons </h1>
                        <h3 class="text-{{ $text }} font-weight-bolder">{{ $course->course_title }}</h3>
                    </div>
                    <div class="mt-3 mt-lg-0">
                        @if ($lessons and !count($lessons) == 0)
                            <button class="btn btn-light shadow-sm px-3 border" type="button" data-toggle="modal"
                                data-target="#lessonModal">
                                <i class=" fa fa-plus"></i>
                                New Lesson
                            </button>
                        @endif
                    </div>

                </div>
                <x-danger-alert />
                <x-success-alert />

                <div class="mt-2 mb-5 row">

                    @forelse ($lessons as $less)
                        <div class="col-md-4">
                            <div class="card ">
                                <img src="{{ str_starts_with($less->thumbnail, 'http') ? $less->thumbnail : asset('storage/' . $less->thumbnail) }}"
                                    class="card-img-top" alt="course image">
                                <div class="card-body">
                                    <h4 class="text-{{ $text }} font-weight-bolder">{{ $loop->iteration }}.
                                        {{ $less->title }}
                                    </h4>
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <a href="#" class="btn btn-primary btn-sm px-2" data-toggle="modal"
                                            data-target="#lessonModal{{ $less->id }}">Edit Lesson</a>

                                        <div class="d-flex align-items-center text-{{ $text }}">
                                            <i class="mr-1 fa fa-clock"></i>
                                            <span> {{ $less->length }}</span>
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-danger btn-sm px-2 btn-block mt-3" data-toggle="modal"
                                        data-target="#lessonDeleteModal{{ $less->id }}">Delete Lesson</a>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" tabindex="-1" id="lessonModal{{ $less->id }}"
                            aria-h6ledby="exampleModalh6" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header ">
                                        <h3 class="mb-2 d-inline text-{{ $text }}">Update Lesson</h3>
                                        <button type="button" class="close text-{{ $text }}" data-dismiss="modal"
                                            aria-h6="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body ">
                                        <div>
                                            <form method="POST" action="{{ route('updatedlesson') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PATCH')
                                                <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <h6 class="text-{{ $text }}">Lesson Title</h6>
                                                        <input type="text"
                                                            class="form-control  text-{{ $text }}"
                                                            value="{{ $less->title }}" name="title" required>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <h6 class="text-{{ $text }}">Description</h6>
                                                        <textarea name="desc" id="" cols="4" class="form-control  text-{{ $text }}" required>
                                                            {{ $less->description }}
                                                        </textarea>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <h6 class="text-{{ $text }}">Video Link</h6>
                                                        <input type="text"
                                                            class="form-control  text-{{ $text }}" name="videolink"
                                                            value="{{ $less->video_link }}" required>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <h6 class="text-{{ $text }}">Length of video</h6>
                                                        <input type="text"
                                                            class="form-control  text-{{ $text }}" name="length"
                                                            value="{{ $less->length }}" required>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <h6 class="text-{{ $text }}">Allow Preview</h6>
                                                        <select name="preview"
                                                            class="form-control  text-{{ $text }}">
                                                            <option value="{{ $less->locked }}">
                                                                {{ $less->locked }}</option>
                                                            <option value="true">true</option>
                                                            <option value="false">false</option>
                                                        </select>
                                                        <small class="text-{{ $text }}">If you want users to be
                                                            able to view this lesson before
                                                            purchase
                                                        </small>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <h6 class="text-{{ $text }}">Lesson Thumbnail (File)</h6>
                                                        <input type="file"
                                                            class="form-control  text-{{ $text }}" name="image">

                                                        @error('image')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <h6 class="text-{{ $text }}">Lesson Thumbnail (Url)</h6>
                                                        <input type="text"
                                                            class="form-control  text-{{ $text }}" name="image_url"
                                                            value="{{ $less->thumbnail }}">
                                                    </div>
                                                    <h6 class="text-{{ $text }}">
                                                        Use either file upload or url to
                                                        choose a lesson image, if both is entered, the file upload will be
                                                        used.
                                                    </h6>
                                                    <input type="hidden" value="{{ $less->id }}" name="lesson_id">
                                                    <input type="hidden" value="{{ $course->id }}" name="course_id">
                                                </div>
                                                <button type="submit" class="px-4 btn btn-primary">Update Lesson</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End add user modal --}}
                        <!-- Modal -->
                        <div class="modal fade" tabindex="-1" id="lessonDeleteModal{{ $less->id }}"
                            aria-h6ledby="exampleModalh6" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header ">
                                        <h3 class="mb-2 d-inline text-{{ $text }}">Delete Lesson</h3>
                                        <button type="button" class="close text-{{ $text }}"
                                            data-dismiss="modal" aria-h6="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body ">
                                        <div>
                                            <p class="text-{{ $text }}">Are you sure you want delete this lesson?
                                            </p>
                                            <a href="{{ route('deletelesson', $less->id) }}"
                                                class="btn btn-danger">DELETE</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End add user modal --}}
                    @empty
                        <div class="col-md-12">
                            <div class="card  text-center py-3">
                                <h5 class="text-{{ $text }}">No Lesson for this course</h5>
                                <div>
                                    <button class="btn btn-secondary px-3" data-toggle="modal"
                                        data-target="#lessonModal">Add Lesson</button>
                                </div>

                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" tabindex="-1" id="lessonModal" aria-h6ledby="exampleModalh6" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header ">
                        <h3 class="mb-2 d-inline text-{{ $text }}">Add Lesson</h3>
                        <button type="button" class="close text-{{ $text }}" data-dismiss="modal"
                            aria-h6="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body ">
                        <div>
                            <form method="POST" action="{{ route('addlesson') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <h6 class="text-{{ $text }}">Lesson Title</h6>
                                        <input type="text" class="form-control  text-{{ $text }}"
                                            name="title" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <h6 class="text-{{ $text }}">Description</h6>
                                        <textarea name="desc" id="" cols="4" class="form-control  text-{{ $text }}" required></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <h6 class="text-{{ $text }}">Video Link</h6>
                                        <input type="text" class="form-control  text-{{ $text }}"
                                            name="videolink" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <h6 class="text-{{ $text }}">Length of video</h6>
                                        <input type="text" class="form-control  text-{{ $text }}"
                                            name="length" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <h6 class="text-{{ $text }}">Allow Preview</h6>
                                        <div class="selectgroup">
                                            <label class="selectgroup-item">
                                                <input type="radio" value="true" class="selectgroup-input"
                                                    name="preview">
                                                <span class="selectgroup-button">Allow</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" value="false" class="selectgroup-input"
                                                    name="preview">
                                                <span class="selectgroup-button">Don't Allow</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <h6 class="text-{{ $text }}">Lesson Thumbnail (File)</h6>
                                        <input type="file" class="form-control  text-{{ $text }}"
                                            name="image">

                                        @error('image')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-12">
                                        <h6 class="text-{{ $text }}">Lesson Thumbnail (Url)</h6>
                                        <input type="text" class="form-control  text-{{ $text }}"
                                            name="image_url">
                                    </div>
                                    <h6 class="text-{{ $text }}">Use either file upload or url to
                                        choose a lesson image, if both is entered, the file upload will be used.
                                    </h6>
                                    <input type="hidden" value="{{ $course->id }}" name="course_id">
                                </div>
                                <button type="submit" class="px-4 btn btn-primary">Add Lesson</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- End add user modal --}}
    @endsection
