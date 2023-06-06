{{-- blade-formatter-disable --}}
@component('mail::message')
# Hello {{$foramin  ? 'Admin' : $user->name}}
@if ($foramin)
 This is to inform you of a successfull Deposit of {{$settings->currency.$deposit->amount}} from {{$user->name}}. {{ $deposit->status == "Processed" ? '' : ' Please login to process it.' }}
@else
@if ($deposit->status == 'Processed')
This is to inform you that your deposit of {{$settings->currency.$deposit->amount}} have been received and confirmed. Your account balance have been credited with the specified amount.
@else
This is to inform you that your deposit of {{$settings->currency.$deposit->amount}} is successful, please wait while we confirm your deposit. You will receive a notification regarding the status of this transaction.
@endif
@endif
Thanks,
<br>
{{ config('app.name') }}
@endcomponent
{{-- blade-formatter-disable --}}
