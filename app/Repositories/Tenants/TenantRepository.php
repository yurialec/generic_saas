<?php

namespace App\Repositories\Tenants;

use App\Interfaces\Tenants\TenantRepositoryInterface;
use App\Models\Admin\Clients;
use App\Models\Tenants\Tenant;
use Exception;
use Log;

class TenantRepository implements TenantRepositoryInterface
{
    protected $client;
    protected $tenant;

    public function __construct(Clients $client, Tenant $tenant)
    {
        $this->client = $client;
        $this->tenant = $tenant;
    }

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

    public function viewProfile()
    {
        try {
            return $this->client
                ->whereHas('tenant', function ($query) {
                    $query->where('domain', session('tenant'));
                })
                ->first();
        } catch (Exception $e) {
            Log::error('Erro', ['error' => $e->getMessage()]);
            return null;
        }
    }
}