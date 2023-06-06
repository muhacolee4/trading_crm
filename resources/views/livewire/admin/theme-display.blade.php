@php
if (Auth('admin')->User()->dashboard_style == 'light') {
    $text = 'dark';
    $bg = 'light';
} else {
    $bg = 'dark';
    $text = 'light';
}
@endphp
<div>
    <div class="form-row mt-4">
        <div class="col-12">
            <h5 class="text-{{ $text }}">Website theme. Double click to save.
                Current theme have a blue border</h5>
        </div>
        <div class="col-md-4 p-2">
            <div class="flex-wrap btn-group-toggle d-flex justify-content-around" data-toggle="buttons">
                <label
                    class="mb-2 shadow btn {{ $settings->website_theme == 'purpose.css' ? 'active border border-primary rounded-lg' : '' }}"
                    wire:click="setTheme('purpose.css')">
                    <img src="{{ asset('dash/images/purpose.png') }}" alt="" class="img-fluid">
                    <input type="radio" name="theme" value="purpose.css" autocomplete="off">
                </label>
            </div>
        </div>
        <div class="col-md-4 p-2">
            <div class="flex-wrap btn-group-toggle d-flex justify-content-around" data-toggle="buttons">
                <label
                    class="mb-2 shadow btn {{ $settings->website_theme == 'blue.css' ? 'active border border-primary' : '' }}"
                    wire:click="setTheme('blue.css')">
                    <img src="{{ asset('dash/images/blue.png') }}" class="img-fluid">
                    <input type="radio" name="theme" value="blue.css" autocomplete="off">
                </label>
            </div>
        </div>
        <div class="col-md-4 p-2">
            <div class="flex-wrap btn-group-toggle d-flex justify-content-around" data-toggle="buttons">
                <label
                    class="mb-2 shadow btn {{ $settings->website_theme == 'green.css' ? 'active border border-primary' : '' }}"
                    wire:click="setTheme('green.css')">
                    <img src="{{ asset('dash/images/green.png') }}" class="img-fluid">
                    <input type="radio" name="theme" value="green.css" autocomplete="off">
                </label>
            </div>
        </div>
        <div class="col-md-4 p-2">
            <div class="flex-wrap btn-group-toggle d-flex justify-content-around" data-toggle="buttons">
                <label
                    class="mb-2 shadow btn {{ $settings->website_theme == 'brown.css' ? 'active border border-primary' : '' }}"
                    wire:click="setTheme('brown.css')">
                    <img src="{{ asset('dash/images/brown.png') }}" class="img-fluid">
                    <input type="radio" name="theme" value="brown.css" autocomplete="off">
                </label>
            </div>
        </div>
        <div class="col-md-4 p-2">
            <div class="flex-wrap btn-group-toggle d-flex justify-content-around" data-toggle="buttons">
                <label
                    class="mb-2 shadow btn {{ $settings->website_theme == 'dark.css' ? 'active border border-primary' : '' }}"
                    wire:click="setTheme('dark.css')">
                    <img src="{{ asset('dash/images/dark.png') }}" class="img-fluid">
                    <input type="radio" name="theme" value="dark.css" autocomplete="off">
                </label>
            </div>
        </div>
    </div>
</div>
