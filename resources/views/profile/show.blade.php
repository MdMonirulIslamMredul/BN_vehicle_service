@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>My Profile</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card p-4 shadow-sm">
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Phone:</strong> {{ $user->phone ?? 'Not Avaible' }}</p>
        <p><strong>Address:</strong> {{ $user->address ?? 'Not Avaible' }}</p>
        <p><strong>Driving license:</strong> {{ $user->license_number ?? 'Not Avaible' }}</p>
        <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>

        <a href="{{ route('profile.edit') }}" class="btn btn-primary mt-3">Edit Profile</a>
    </div>
</div>
@endsection
