
@extends('layouts.dash')
@section('title', $title)
@section('content')
    <!-- Page title -->
    <div class="page-title">
        <div class="row justify-content-between align-items-center">
            <div class="mb-3 col-md-6 mb-md-0">
                <h5 class="mb-0 text-white h3 font-weight-400">24/7 Customer Support</h5>
            </div>
        </div>
    </div>
    <x-danger-alert/>
	<x-success-alert/>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
					<div class="mb-5 row p-md-3">
						<div class="col-12 p-md-2">
							<div class="p-3 text-center col-12">
								<h1>{{$settings->site_name}} Support</h1>
								<div class="">
									<h4 class="h5">For inquiries, suggestions or complains. Mail us</h4>
									<h1 class="mt-3 text-primary h4"> <a href="mailto:{{$settings->contact_email}}">{{$settings->contact_email}}</a> </h1>
								</div>
							</div>
							<div class="pb-5 col-md-8 offset-md-2">
								<form method="post" action="{{route('enquiry')}}">
									<input type="hidden" name="name" value="{{Auth::user()->name}}" />
									<div class="form-group">
										<input type="hidden" name="email" value="{{Auth::user()->email}}">
									</div>
									<div class="form-group">
										<h5 for="" class="">Message<span class=" text-danger">*</span></h5>
										<textarea name="message" class="form-control " rows="5"></textarea>
									</div>
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<div class="">
										<input type="submit" class="py-2 btn btn-primary btn-block" value="Send">
									</div>
								</form>
							</div>
						</div>
						
					</div>
                </div>
            </div>
        </div>
	</div>
@endsection
