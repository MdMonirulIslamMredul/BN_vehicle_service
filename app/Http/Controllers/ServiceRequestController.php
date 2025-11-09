<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceRequest;

class ServiceRequestController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'owner') {
            $requests = ServiceRequest::where('owner_id', $user->id)->get();
        } elseif ($user->role === 'driver') {
            $requests = ServiceRequest::where('driver_id', $user->id)->get();
        } else {
            abort(403);
        }

        return view('service-requests.index', compact('requests'));
    }

    public function create()
    {
        // Only owners can create service requests
        if (auth()->user()->role !== 'owner') {
            abort(403);
        }

        return view('service-requests.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'owner') {
            abort(403);
        }

        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'description' => 'required|string',
        ]);

        ServiceRequest::create([
            'owner_id' => auth()->id(),
            'vehicle_id' => $request->vehicle_id,
            'description' => $request->description,
        ]);

        return redirect()->route('service-requests.index')
                         ->with('success', 'Service request created.');
    }

    // Similarly handle show, edit, update, destroy with role checks
}
