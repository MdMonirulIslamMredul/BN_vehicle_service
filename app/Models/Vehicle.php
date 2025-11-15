<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;


    protected $fillable = [
    'user_id',
    'chassis_number',
    'registration_number',
    'make',
    'model',
    'year',
    'color',
    ];


    public function owner(){
        return $this->belongsTo(User::class, 'user_id');
    }


    public function serviceRequests(){
        return $this->hasMany(ServiceRequest::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
