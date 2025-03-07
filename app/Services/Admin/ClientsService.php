<?php

namespace App\Services\Admin;

use App\Helpers\Utils;
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

    public function create($data)
    {
        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'cpf' => $data['cpf'],
            'function' => $data['function'],
            'phone' => $data['phone'],
        ];

        $tenantData = [
            'name' => $data['name'],
            'domain' => $data['domain'],
        ];

        return $this->ClientsRepository->create($userData, $tenantData);
    }

    public function getClientById($id)
    {
        return $this->ClientsRepository->getClientById($id);
    }

    public function update($id, $data)
    {
        $clientData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'cpf' => Utils::sanitizeInteger($data['cpf']),
            'function' => $data['function'],
            'phone' => Utils::sanitizeInteger($data['phone']),
        ];

        $tenantData = [
            'id' => $data['tenant']['id'],
            'name' => $data['name'],
            'domain' => Utils::sanitizeInteger($data['tenant']['domain']),
        ];

        return $this->ClientsRepository->update($id, $clientData, $tenantData);
    }
}