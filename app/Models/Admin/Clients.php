<?php

namespace App\Models\Admin;
use App\Models\Tenants\Tenant;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;

class Clients extends User
{
    protected $table = 'users';

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('only_clients', function (Builder $builder) {
            $builder->whereNotNull('tenant_id');
        });
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}