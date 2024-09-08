<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'age', 'sex', 'civil_status', 'course_year', 'contact', 'position', 'address', 'ioe_name', 'ioe_relation', 'ioe_address', 'ioe_contact',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function appointmentsAsStudent()
    {
        return $this->hasMany(Appointment::class, 'student_id');
    }

    public function appointmentsAsDentist()
    {
        return $this->hasMany(Appointment::class, 'dentist_id');
    }

    public function isStudent()
    {
        return $this->role === 'student';
    }

    public function isDentist()
    {
        return $this->role === 'dentist';
    }
}