<?php

namespace App\Models\Tenants;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $table = ['tenant'];

    protected $fillable = ['name'];
}