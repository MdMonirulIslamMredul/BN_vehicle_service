<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'name',
        'address',
        'role',
        'date',
        'reg_no',
        'chassis_no',
        'model',
        'entry_time',
        'job_no',
        'job_description',
        'drv_name',
        'tk_amount',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
        'entry_time' => 'datetime:H:i',
        'tk_amount' => 'decimal:2',
    ];

    /**
     * Get services for a specific phone number.
     */
    public static function getByPhone($phone)
    {
        return self::where('phone', $phone)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
