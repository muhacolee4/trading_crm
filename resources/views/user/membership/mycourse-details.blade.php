@extends('layouts.dash')
@section('title', $title)
@section('content')
    <!-- Page title -->
    <div class="page-title mb-5">

    </div>
    <x-danger-alert />
    <x-success-alert />
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h3 class="text-primary">{{ $course->course->course_title }}</h3>
                    </div>
                    <div class="p-2 d-lg-flex justify-content-lg-between align-items-center mt-3">
                        <div class="mt-2 mt-lg-0">
                            <p class="m-0 text-primary font-weight-bold">CREATED BY</p>
                            <P class="m-0">{{ $settings->site_name }}</P>
                        </div>
                        <div class="mt-2 mt-lg-0">
                            <p class="m-0 text-primary font-weight-bold">CATEGORY</p>
                            <P class="m-0">{{ $course->course->category }}</P>
                        </div>
                        <div class="mt-2 mt-lg-0">
                            <p class="m-0 text-primary font-weight-bold">PURCHASED</p>
                            <P class="m-0">
                                {{ \Carbon\Carbon::parse($course->course->created_at)->toDayDateTimeString() }}</P>
                        </div>
                    </div>

                    <div class="mt-5">
                        <h4>Course Lessons</h4>
                        @forelse ($lessons as $lesson)
                            <div>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="fas fa-play-circle fa-2x text-danger mr-2"></i>
                                        <div>
                                            <h6 class="h6 m-0">{{ $lesson->title }}</h6>
                                            <small class="text-muted d-block">{{ $lesson->description }}</small>
                                            <small class="text-muted">{{ $lesson->length }}</small>
                                        </div>
                                    </div>
                                    <div>
                                        <a href="{{ route('user.learning', ['lesson' => $lesson->id, 'course' => $course->course->id]) }}"
                                            class="px-3 shadow bg-info text-white rounded-4 rounded-md">Watch</a>
                                    </div>
                                </div>
                                <div style="border-top: 1px dashed black;" class="my-3"></div>
                            </div>
                        @empty
                            <div class="text-center py-3">
                                <p>No Data Available</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
