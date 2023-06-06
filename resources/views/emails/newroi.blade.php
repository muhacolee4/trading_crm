{{-- blade-formatter-disable --}}
@component('mail::message')
# Hello {{ $user->name }},

This is a notification of a new return on investment (ROI) on your investment account. 
<br>

<strong>Plan: </strong> {{ $plan }} <br>
<strong>Amount: </strong> {{ $settings->currency }}{{ $amount }}<br>
<strong>Date: </strong> {{ $plandate }} <br>

Thanks,<br>
{{ $settings->site_name }}.
@endcomponent
{{-- blade-formatter-disable --}}
