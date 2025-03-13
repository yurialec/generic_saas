<?php

namespace App\Models\Tenants;

use App\Models\Admin\Plan;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $table = 'tenant';

    protected $with = ['plan'];

    protected $fillable = [
        'name',
        'domain',
        'plan_id',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}