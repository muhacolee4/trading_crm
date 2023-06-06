@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel ">
        <div class="content">
            <div class="page-inner">
                <x-danger-alert />
                <x-success-alert />
                <div class="mt-2 mb-4">
                    <h1 class="title1 m-0">Trade Signals Settings</h1>
                    <p>Set trade signal subscription fees</p>
                </div>
                <div class="mb-5 row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-8 offset-lg-2">
                                        <form action="{{ route('save.settings') }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="">Monthly Fee ({{ $settings->currency }})</label>
                                                <input type="number" class="form-control"
                                                    value="{{ $signalSettings->signal_monthly_fee }}" name="monthly"
                                                    id="">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Quaterly Fee ({{ $settings->currency }})</label>
                                                <input type="number" step="any"
                                                    value="{{ $signalSettings->signal_quartly_fee }}" class="form-control"
                                                    name="quaterly">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Yearly Fee ({{ $settings->currency }})</label>
                                                <input type="number" step="any"
                                                    value="{{ $signalSettings->signal_yearly_fee }}" class="form-control"
                                                    name="yearly">
                                            </div>
                                            <div class="form-group">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <label for="">Chat ID</label>
                                                    @if ($signalSettings->chat_id == '')
                                                        <a href="{{ route('chat.id') }}" class="btn btn-info btn-sm">Get
                                                            ID</a>
                                                    @else
                                                        <a href="{{ route('delete.id') }}"
                                                            class="btn btn-danger btn-sm">Delete
                                                            ID</a>
                                                    @endif
                                                </div>
                                                <input type="text" value="{{ $signalSettings->chat_id }}"
                                                    class="form-control" name="chat_id" readonly>
                                                @if ($signalSettings->chat_id == '')
                                                    <small>
                                                        Please make sure you have entered your telegram bot api and have
                                                        sent at least one message on your private channel. Also make sure
                                                        you have added the bot as an admin to the private channel, in order
                                                        to retrieve the chat ID.
                                                    </small>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="">Telegram Bot Api</label>
                                                <input type="text" value="{{ $signalSettings->telegram_bot_api }}"
                                                    class="form-control" name="telegram_bot_api">
                                                <p><a href="https://learn.microsoft.com/en-us/azure/bot-service/bot-service-channel-connect-telegram?view=azure-bot-service-4.0#create-a-new-telegram-bot-with-botfather"
                                                        target="_blank" class="mt-2 text-danger">
                                                        See How <i class="fa fa-link"></i>
                                                    </a> to create your telegram bot</p>
                                            </div>

                                            <div class="form-group">
                                                <button class="btn btn-primary px-4" type="submit">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
