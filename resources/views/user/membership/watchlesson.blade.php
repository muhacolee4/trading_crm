@extends('layouts.dash')
@section('title', $title)
@section('content')
    <!-- Page title -->
    <div class="page-title mb-5">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h5 class="text-white h3 font-weight-400">{{ $lesson->title }}</h5>
                @if ($course)
                    <a href="{{ route('user.mycoursedetails', ['id' => $course->id]) }}" class="btn btn-outline-light btn-sm">
                        <i class="fa fa-arrow-left"></i>
                        Back
                    </a>
                @endif

            </div>
        </div>
    </div>
    <x-danger-alert />
    <x-success-alert />
    <div class="row">
        <div class="col-12">
            <p class="text-white">{{ $lesson->description }}</p>
        </div>
        <div class="col-md-12">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="{{ $lesson->video_link }}" allowfullscreen></iframe>
            </div>
        </div>
        @if ($course)
            <div class="col-md-12 d-flex justify-content-between align-items-center mt-5">
                <div>
                    @if ($previous)
                        <a href="{{ route('user.learning', ['course' => $course->id, 'lesson' => $previous]) }}"
                            class="btn btn-primary btn-sm">
                            <i class="fa fa-arrow-left"></i>
                            Prev Lesson
                        </a>
                    @else
                        <button class="btn btn-primary btn-sm" disabled>
                            <i class="fa fa-arrow-left"></i>
                            Prev Lesson
                        </button>
                    @endif
                </div>
                <div>
                    @if ($next)
                        <a href="{{ route('user.learning', ['course' => $course->id, 'lesson' => $next]) }}"
                            class="btn btn-primary btn-sm">
                            Next Lesson
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    @else
                        <button class="btn btn-primary btn-sm" disabled>
                            Next Lesson
                            <i class="fa fa-arrow-right"></i>
                        </button>
                    @endif
                </div>
            </div>
        @endif

    </div>
@endsection
