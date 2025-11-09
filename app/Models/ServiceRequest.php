<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    use HasFactory;


    protected $fillable = [
    'vehicle_id',
    'owner_id',
    'driver_id',
    'problem_description',
    'status',
    'scheduled_at',
    'estimated_cost',
    'admin_notes'
    ];


    public function vehicle() {
         return $this->belongsTo(Vehicle::class);
        }
    public function owner() {
        return $this->belongsTo(User::class, 'owner_id');
         }
    public function driver() {
         return $this->belongsTo(User::class, 'driver_id');
         }
}
