<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    protected $fillable = [
        'group',
        'gender',
        'age',
        'full_name',
        'cpf',
        'email',
        'phone',
        'guardian_name',
        'guardian_phone',
        'emergency_contact',
        'emergency_phone',
        'payment_plan',
        'notes'
    ];
}