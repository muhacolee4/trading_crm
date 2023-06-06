<form method="POST" action="{{route('updateuserpass')}}">
    @csrf
    @method('PUT')
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="">Old Password</label>
            <input type="password" name="current_password" class="form-control " required>
        </div>
        <div class="form-group col-md-6">
            <label class="">New Password</label>
            <input type="password" name="password" class="form-control " required>
        </div>
        <div class="form-group col-md-6">
            <label class="">Confirm New Password</label>
            <input type="password" name="password_confirmation" class=" form-control" required>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Update Password</button>
</form>
<div class="mt-4">
    <a href="{{ route('twofa') }}" class="text-decoration-none">{{ __('Advance Account Settings') }} <i class="fas fa-arrow-right"></i> </a>
</div>