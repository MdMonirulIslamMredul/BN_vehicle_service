<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    //
     use HasFactory;

    // Mass assignable fields
    protected $fillable = [
        'name',
        'phone',
        'email',
        'date',
        'brand',
        'model',
        'number',
        'services',
        'status',
    ];

    // Optional: cast services from JSON to array automatically
    protected $casts = [
        'services' => 'array',
        'date' => 'date',
    ];
}
