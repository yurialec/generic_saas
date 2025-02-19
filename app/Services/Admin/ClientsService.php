<?php

namespace App\Services\Admin;

use App\Repositories\Admin\ClientsRepository;

class ClientsService
{
    protected $ClientsRepository;

    public function __construct(ClientsRepository $ClientsRepository)
    {
        $this->ClientsRepository = $ClientsRepository;
    }

    public function all()
    {
        return $this->ClientsRepository->all();
    }
}