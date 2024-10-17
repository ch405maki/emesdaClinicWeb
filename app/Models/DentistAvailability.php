<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DentistAvailability extends Model
{
    use HasFactory;

    protected $fillable = [
        'dentist_id', 
        'date', 
        'start_time', 
        'end_time'
    ];

    /**
     * Get the dentist associated with this availability.
     */
    public function dentist()
    {
        return $this->belongsTo(User::class, 'dentist_id');
    }
}
