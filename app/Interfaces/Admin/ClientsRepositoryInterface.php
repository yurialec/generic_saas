<?php

namespace App\Interfaces\Admin;

interface ClientsRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $userData, array $tenantData);
    public function update($id, array $clientData, array $tenantData);
    public function delete($id);
    public function getClientById($id);
}