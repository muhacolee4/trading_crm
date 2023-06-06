@extends('layouts.dash')
@section('title', $title)
@section('content')
    <!-- Page title -->
    <div class="page-title mb-4">
        <div class="row justify-content-between align-items-center">
            <div class="mb-3 col-12">
                <h5 class="mb-0 text-white h3 font-weight-400">Your Courses</h5>
                {{-- <p class="text-white">Learning often happens in classrooms but it doesn’t have to. Use
                    {{ $settings->site_name }} to facilitate
                    learning experiences no matter the context. </p> --}}
            </div>
        </div>
    </div>
    <x-danger-alert />
    <x-success-alert />

    <div class="row">
        <div class="col-md-12">
            <div class="row">

                @forelse ($courses as $course)
                    <div class="col-md-4">
                        <div class="card rounded-0">
                            <img src="{{ str_starts_with($course->course->course_image, 'http') ? $course->course->course_image : asset('storage/' . $course->course->course_image) }}"
                                class="card-img-top" alt="course image">
                            <div class="card-body">
                                <h5 class="font-weight-bolder">{{ $course->course->course_title }}</h5>
                                <div class="d-flex justify-content-between align-items-center my-2">
                                    <div class="d-flex align-items-center">
                                        <i class="mr-1 fa fa-book"></i>
                                        <span>
                                            {{ count($course->lessons) }}
                                            {{ count($course->lessons) > 1 ? 'Lessons' : 'Lesson' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <a href="{{ route('user.mycoursedetails', $course->course->id) }}"
                                        class="btn btn-primary btn-block rounded-0 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-play-circle fa-2x text-danger mr-2"></i>
                                        <span>Watch</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body text-center py-2">
                                <p>No Data Available</p>
                            </div>
                        </div>
                    </div>
                @endforelse
                <div class="col-md-12">
                    {{-- {{ $courses->links() }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection
