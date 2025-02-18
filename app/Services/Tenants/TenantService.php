<?php

namespace App\Services\Tenants;

use App\Repositories\Tenants\TenantRepository;

class TenantService
{
    protected $TenantRepository;

    public function __construct(TenantRepository $TenantRepository)
    {
        $this->TenantRepository = $TenantRepository;
    }

    public function all()
    {
        return $this->TenantRepository->all();
    }
}