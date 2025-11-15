<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    //
     public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'date' => 'required|date|after_or_equal:today',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'number' => 'required|string|max:50',
            'services' => 'required|array|min:1',
        ]);

       // $data['services'] = json_encode($data['services']);

        Appointment::create($data);

        return back()->with('success', 'Appointment booked successfully!');
    }




}
