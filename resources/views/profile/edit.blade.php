@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Edit Profile</h2>

    <div class="card p-4 shadow-sm">
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
            </div>
             <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" class="form-control" value="{{ old('address', $user->address) }}">
            </div>
             <div class="mb-3">
                <label for="license_number" class="form-label">Driving License</label>
                <input type="text" name="license_number" class="form-control" value="{{ old('license_number', $user->license_number) }}">
            </div>

            {{-- <div class="mb-3">
                <label for="password" class="form-label">New Password (optional)(at least 6 character)</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div> --}}

            <button type="submit" class="btn btn-success">Save Changes</button>
            <a href="{{ route('profile.show') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
