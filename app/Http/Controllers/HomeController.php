<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;

        return match($role) {
            'admin' => redirect()->route('admin.dashboard'),
            'owner' => redirect()->route('owner.dashboard'),
            'driver' => redirect()->route('driver.dashboard'),
            default => redirect('/'),
        };
    }

    public function about()
    {
        return view('about');
    }
    public function contact()
    {
        return view('contact');
    }
}
