<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'price',
        'description',
        'duration',
        'dutarion_type',
    ];
}