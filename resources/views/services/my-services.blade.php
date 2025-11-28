@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="fw-bold mb-4">My Services</h3>

    @if($services->count() > 0)
        <div class="row">
            @foreach($services as $service)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header bg-{{ $service->status === 'entry' ? 'info' : ($service->status === 'running' ? 'warning' : 'success') }} text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">
                                    <i class="bi bi-tools"></i> Job #{{ $service->job_no ?? 'N/A' }}
                                </h6>
                                <span class="badge bg-light text-dark">
                                    @if($service->status === 'entry')
                                        <i class="bi bi-clock"></i> Entry
                                    @elseif($service->status === 'running')
                                        <i class="bi bi-gear-fill"></i> Running
                                    @else
                                        <i class="bi bi-check-circle-fill"></i> Finished
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            @if($service->status === 'entry')
                                <div class="alert alert-info py-2 small mb-3">
                                    <i class="bi bi-info-circle"></i> Entry at {{ $service->entry_time ? \Carbon\Carbon::parse($service->entry_time)->format('h:i A') : ($service->created_at->format('h:i A')) }}
                                </div>
                            @elseif($service->status === 'running')
                                <div class="alert alert-warning py-2 small mb-3">
                                    <i class="bi bi-gear-fill"></i> Service is currently in progress
                                </div>
                            @else
                                <div class="alert alert-success py-2 small mb-3">
                                    <i class="bi bi-check-circle-fill"></i> Service completed successfully
                                </div>
                            @endif

                            <div class="mb-2">
                                <strong>Date:</strong>
                                <span class="text-muted">{{ $service->date ? $service->date->format('d M Y') : $service->created_at->format('d M Y') }}</span>
                            </div>

                            @if($service->reg_no)
                                <div class="mb-2">
                                    <strong>Registration No:</strong>
                                    <span class="text-muted">{{ $service->reg_no }}</span>
                                </div>
                            @endif

                            @if($service->chassis_no)
                                <div class="mb-2">
                                    <strong>Chassis No:</strong>
                                    <span class="text-muted">{{ $service->chassis_no }}</span>
                                </div>
                            @endif

                            @if($service->model)
                                <div class="mb-2">
                                    <strong>Model:</strong>
                                    <span class="text-muted">{{ $service->model }}</span>
                                </div>
                            @endif

                            @if($service->drv_name)
                                <div class="mb-2">
                                    <strong>Driver:</strong>
                                    <span class="text-muted">{{ $service->drv_name }}</span>
                                </div>
                            @endif

                            @if($service->job_description)
                                <div class="mb-2">
                                    <strong>Description:</strong>
                                    <p class="text-muted small mb-0">{{ $service->job_description }}</p>
                                </div>
                            @endif

                            @if($service->tk_amount)
                                <div class="mt-3 pt-3 border-top">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <strong>Amount:</strong>
                                        <span class="fs-5 text-primary fw-bold">৳ {{ number_format($service->tk_amount, 2) }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="card-footer text-muted small">
                            <i class="bi bi-calendar3"></i> Created: {{ $service->created_at->format('d M Y, h:i A') }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $services->links() }}
        </div>
    @else
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="bi bi-inbox display-1 text-muted"></i>
                <h5 class="mt-3 text-muted">No Services Found</h5>
                <p class="text-muted">You don't have any service records yet.</p>
            </div>
        </div>
    @endif
</div>
@endsection
