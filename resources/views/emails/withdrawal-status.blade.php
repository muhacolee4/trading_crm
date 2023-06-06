{{-- blade-formatter-disable --}}
@component('mail::message')
# Hello {{$foramin  ? 'Admin' : $user->name}}
@if ($foramin)
This is to inform you that you {{$user->name}} have made a withdrawal request of {{$settings->currency.$withdrawal->amount}}, kindly login to your account to review and take neccesary action.
@else
@if ($deposit->status == 'Processed')
This is to inform you that your withdrawal request of {{$settings->currency.$withdrawal->amount}} have been approved and funds have been sent to your selected account
@else
This is to inform you that your withdrawal request of {{$settings->currency.$withdrawal->amount}} is successfull, please wait while we process your request. You will receive a notification regarding the status of your request.
@endif    
@endif
Thanks,<br>
{{ config('app.name') }}
@endcomponent
{{-- blade-formatter-disable --}}
