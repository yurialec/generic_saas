<?php

namespace App\Repositories\Tenants;

use App\Interfaces\Tenants\TenantRepositoryInterface;
use App\Models\Tenants\Tenant;

class TenantRepository implements TenantRepositoryInterface
{
    public function all()
    {
        return Tenant::all();
    }

    public function find($id)
    {
        return Tenant::find($id);
    }

    public function create(array $data)
    {
        return Tenant::create($data);
    }

    public function update($id, array $data)
    {
        $model = Tenant::find($id);
        if ($model) {
            $model->update($data);
            return $model;
        }
        return null;
    }

    public function delete($id)
    {
        return Tenant::destroy($id);
    }
}