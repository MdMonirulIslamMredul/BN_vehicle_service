@extends('layouts.app_home')

@section('content')
<div class="container py-5">
    <h1 class="text-center fw-bold mb-4">About BN Vehicle Service</h1>
    <p class="lead text-center text-muted mb-5">Your Trusted Partner for Nitol-Tata Fleet Management and Maintenance in Bangladesh.</p>

    <div class="row align-items-center mb-5">
        <div class="col-lg-6">
            <h2 class="text-primary mb-3">🤝 A Proud Third-Party Partner of Nitol-Tata BD</h2>
            <p>BN Vehicle Service operates as a dedicated **third-party service and fleet management provider** specializing in vehicles distributed by **Nitol-Tata in Bangladesh**. We bridge the gap between Nitol-Tata's commitment to quality vehicles and the operational demands of their customers' fleets.</p>
            <p>Our operation is built on mutual trust and a shared vision of maximizing vehicle uptime and ensuring long-term asset value for businesses across the country.</p>
        </div>
        <div class="col-lg-6 text-center">
            <img src="{{ asset('images/about-nitol-tata.jpg') }}" alt="Nitol-Tata Partnership" class="img-fluid rounded shadow-sm">
        </div>
    </div>

    <hr class="my-5">

    <div class="row align-items-center flex-row-reverse mb-5">
        <div class="col-lg-6">
            <h2 class="text-success mb-3">🎯 Mission: Maximizing Uptime and Efficiency</h2>
            <p>Our core mission is simple: to **eliminate vehicle downtime** and optimize the performance of every vehicle in your fleet. We understand that in the transport and logistics industry, time is money. </p>
            <p>By focusing exclusively on Nitol-Tata vehicles, our technicians possess specialized knowledge, tools, and genuine spare parts (or high-quality approved alternatives) to deliver precise, rapid, and reliable service, exceeding standard maintenance benchmarks.</p>
            <ul class="list-unstyled">
                <li><i class="bi bi-check-circle-fill text-success me-2"></i> **Expertise:** Specialized Nitol-Tata knowledge.</li>
                <li><i class="bi bi-check-circle-fill text-success me-2"></i> **Reliability:** Guaranteed quality in parts and labor.</li>
                <li><i class="bi bi-check-circle-fill text-success me-2"></i> **Efficiency:** Streamlined service requests and quick turnaround.</li>
            </ul>
        </div>
        <div class="col-lg-6 text-center">
            <img src="{{ asset('images/mission.jpg') }}" alt="Our Mission" class="img-fluid rounded shadow-sm">

        </div>
    </div>

    <hr class="my-5">

    <div class="text-center mb-5">
        <h2 class="text-info mb-4">🔧 What We Offer</h2>
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card p-3 shadow-sm h-100">
                    <h5 class="card-title text-primary">Fleet Maintenance</h5>
                    <p class="card-text small">Scheduled servicing, preventative checks, and routine repairs.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3 shadow-sm h-100">
                    <h5 class="card-title text-primary">Driver Management</h5>
                    <p class="card-text small">Assignment, tracking, and management of vehicle operators.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3 shadow-sm h-100">
                    <h5 class="card-title text-primary">Appointment System</h5>
                    <p class="card-text small">Digital booking and management of all vehicle service appointments.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-5">
        <a href="{{ route('contact') }}" class="btn btn-lg btn-danger shadow-lg">Get in Touch with Our Team</a>
    </div>

</div>
@endsection
