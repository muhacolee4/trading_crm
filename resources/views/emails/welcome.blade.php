{{-- blade-formatter-disable --}}
@component('mail::message')
# Hurray {{$user->name}}, 

We are really excited to welcome you to {{$settings->site_name}} community. <br>
This is just the beginning of greater things to come. <br> <br>
Here is how you can get the most out of our system. <br> <br>
<strong>Make a Deposit, Buy an Investment Plan and sit back to enjoy while we make your money work for you.</strong>
<br> <br>
We look forward to seeing you gain your financial desires.
<br> <br>
Your experience is going to be nice and smooth. 🙂 <br>
No frustrations, no trouble.
<br> <br>

Thanks, and welcome.<br>
{{ config('app.name') }}
@endcomponent
{{-- blade-formatter-disable --}}
