
@extends('layouts.dash')
@section('title', $title)
@section('content')
    <!-- Page title -->
    <div class="page-title">
        <div class="row justify-content-between align-items-center">
            <div class="mb-3 col-md-6 mb-md-0">
                <h5 class="mb-0 text-white h3 font-weight-400">{{ __('Security/Account Deletion') }}</h5>
            </div>
        </div>
    </div>
    <x-danger-alert/>
	<x-success-alert/>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
					<div class="row">
						<div class="p-2 text-center col-md-12 p-md-3">
                            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                                <div>
                                    @livewire('profile.two-factor-authentication-form')
                                </div>
                            @endif
                        </div>
					</div>
					<div class="row">
						<div class="p-2 text-center col-md-12">
							@livewire('profile.logout-other-browser-sessions-form')
                        </div>
					</div>
					<div class="row">
						<div class="p-2 text-center col-md-12">
							@if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
								<x-jet-section-border />
								@livewire('profile.delete-user-form')
							@endif
                        </div>
					</div>
                </div>
            </div>
        </div>
	</div>
@endsection
