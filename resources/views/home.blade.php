@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <h1>Welcome, {{ Auth::user()->name }}!</h1>

                    @if(Auth::user()->role === 'admin')
                        <p>Here’s admin-specific content</p>
                    @elseif(Auth::user()->role === 'owner')
                        <p>Here’s owner-specific content</p>

                         <div class="container">
                            <h3 class="fw-bold mb-3">Owner Dashboard</h3>

                            <a href="{{ route('vehicles.create') }}" class="btn btn-primary mb-3">+ Add Vehicle</a>

                            @include('vehicles.index') {{-- Optional: directly show the list --}}
                        </div>

                    @elseif(Auth::user()->role === 'driver')
                        <p>Here’s driver-specific content</p>
                    @endif



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
