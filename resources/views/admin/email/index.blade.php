@php
if (Auth('admin')->User()->dashboard_style == 'light') {
    $text = 'dark';
    $bg = 'light';
} else {
    $text = 'light';
    $bg = 'dark';
}
@endphp
@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel ">
        <div class="content">
            <div class="page-inner">
                <div class="mt-2 mb-4">
                    <h1 class="title1 text-{{ $text }}">Send Email to users</h1>
                </div>
                <x-danger-alert />
                <x-success-alert />

                <div class="mb-5 row">
                    <div class="col-md-12">
                        <div class="card p-2 shadow ">
                            <div class="card-body">
                                <form method="post" action="{{ route('sendmailtoall') }}">
                                    @csrf
                                    <div class=" form-group">
                                        <h6 class="text-{{ $text }}">Category</h6>
                                        <select class="form-control  text-{{ $text }}" id="category"
                                            name="category">
                                            <option value="All">All Users</option>
                                            <option value="No active plans">Users without active investment plan</option>
                                            <option value="No deposit">Users without any Deposit (likely to be new users)
                                            </option>
                                            <option value="Select Users">Choose Users</option>
                                        </select>
                                    </div>
                                    <div class="form-group d-none" id="select-user-view">
                                        <h6 class="text-{{ $text }}">Select Users (<span
                                                class="text-primary font-bold" id="numofusers">0</span>)
                                        </h6>
                                        <select onChange="SelectPage(this)" name="users[]" multiple
                                            class="form-control select2  text-{{ $text }}" style="width: 100%"
                                            id="showusers"></select>
                                    </div>
                                    <div class=" form-group">
                                        <h6 class="text-{{ $text }}">Greeting/Title</h6>
                                        <div class="input-group">
                                            <input type="text" aria-label="Hello" value="Hello" name="greet"
                                                class="form-control">
                                            <input type="text" aria-label="Investor" value="Investor" name="title"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class=" form-group">
                                        <h6 class="text-{{ $text }}">Subject</h6>
                                        <input type="text" name="subject" class="form-control  text-{{ $text }}"
                                            placeholder="Subject" required>
                                    </div>
                                    <div class=" form-group">
                                        <textarea placeholder="Type your message here" class="form-control  text-{{ $text }} ckeditor" name="message"
                                            row="8" placeholder="Type your message here" required></textarea>
                                    </div>
                                    <div class=" form-group">
                                        <button type="submit" class="btn btn-secondary">
                                            <span>Send</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var category = document.querySelector("#category")
        if (category.value == "Select Users") {
            document.querySelector("#select-user-view").classList.remove("d-none")
        } else {
            document.querySelector("#select-user-view").classList.add("d-none")
        }

        $('.select2').select2();

        function SelectPage(elem) {
            var options = elem.options
            var count = 0
            for (var i = 0; i < options.length; i++) {
                if (options[i].selected) count++;
            }
            document.querySelector("#numofusers").textContent = count;
        }


        category.addEventListener('change', function() {
            if (category.value == "Select Users") {
                document.querySelector("#select-user-view").classList.remove("d-none")

                var users = document.querySelector('#showusers')
                fetch("{{ route('fetchusers') }}")
                    .then(response => response.json())
                    .then(data => {
                        data.data.forEach(element => {
                            var usersopt = document.createElement('option');
                            usersopt.value = element.id;
                            usersopt.innerHTML = element.name;
                            users.appendChild(usersopt);
                        });
                    });

            } else {
                document.querySelector("#select-user-view").classList.add("d-none")
            }
        })
    </script>
@endsection
@section('scripts')
    @parent
    <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
    </script>
@endsection
