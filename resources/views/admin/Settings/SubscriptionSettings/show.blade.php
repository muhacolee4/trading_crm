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
                <div class="mt-2 mb-4">
                    <h1 class="title1 ">MT4 Subscription Settings</h1>
                </div>
                <x-danger-alert />
                <x-success-alert />

                <div class="mb-5 row">
                    <div class="col-md-8 offset-md-2">
                        <div class="card p-1 p-md-5 shadow-lg ">
                            <form method="post" action="javascript:void(0)" id="subform">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <h4 class="">Monthly Subscription Fee:</h4>
                                    <input type="text" name="monthlyfee" class="form-control  "
                                        value="{{ $settings->monthlyfee }}">
                                </div>

                                <div class="form-group">
                                    <h4 class="">Quaterly Subscription Fee:</h4>
                                    <input type="text" name="quaterlyfee" class="form-control  "
                                        value="{{ $settings->quarterlyfee }}">
                                </div>

                                <div class="form-group">
                                    <h4 class="">Yearly Subscription Fee:</h4>
                                    <input type="text" name="yearlyfee" class="form-control  "
                                        value="{{ $settings->yearlyfee }}">
                                </div>

                                <div class="form-group">
                                    <input type="submit" class="px-5 btn btn-primary btn-lg" value="Save">
                                    <input type="hidden" name="id" value="1">
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($settings->subscription_service == 'on')
            <script>
                document.getElementById("subscripton").checked = true;
            </script>
        @else
            <script>
                document.getElementById("subscriptonoff").checked = true;
            </script>
        @endif
        <script>
            // Submit email preference form
            $('#subform').on('submit', function() {
                //alert('love');
                $.ajax({
                    url: "{{ route('updatesubfee') }}",
                    type: 'POST',
                    data: $('#subform').serialize(),
                    success: function(response) {
                        if (response.status === 200) {
                            $.notify({
                                // options
                                icon: 'flaticon-alarm-1',
                                title: 'Success',
                                message: response.success,
                            }, {
                                // settings
                                type: 'success',
                                allow_dismiss: true,
                                newest_on_top: false,
                                placement: {
                                    from: "top",
                                    align: "right"
                                },
                                offset: 20,
                                spacing: 10,
                                z_index: 1031,
                                delay: 5000,
                                timer: 1000,
                                animate: {
                                    enter: 'animated fadeInDown',
                                    exit: 'animated fadeOutUp'
                                },

                            });
                        } else {

                        }
                    },
                    error: function(error) {
                        console.log(error);
                    },
                });
            });
        </script>
    @endsection
