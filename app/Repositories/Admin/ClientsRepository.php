<?php

namespace App\Repositories\Admin;

use App\Enums\RolesEnum;
use App\Interfaces\Admin\ClientsRepositoryInterface;
use App\Models\Admin\Clients;
use App\Models\Admin\Roles;
use App\Models\Tenants\Tenant;
use Exception;
use Hash;
use Log;

class ClientsRepository implements ClientsRepositoryInterface
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
        try {
            return $this->client->with('tenant')->paginate(10);
        } catch (Exception $err) {
            Log::error('ERRO', ['erro' => $err->getMessage()]);
            return $err->getMessage();
        }
    }

    public function find($id)
    {
        try {
            return $this->client->find($id);
        } catch (Exception $err) {
            Log::error('ERRO', ['erro' => $err->getMessage()]);
            return $err->getMessage();
        }
    }

    public function create($userData, $tenantData)
    {
        try {
            $tenant = $this->tenant->create($tenantData);

            return $this->client->create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make($userData['password']),
                'role_id' => Roles::where('name', RolesEnum::Cliente)->first()->id,
                'tenant_id' => $tenant->id,
                'cpf' => $userData['cpf'],
                'function' => $userData['function'],
                'phone' => $userData['phone'],
            ]);

        } catch (Exception $err) {
            Log::error('ERRO', ['erro' => $err->getMessage()]);
            return $err->getMessage();
        }
    }

    public function update($id, array $data)
    {
        try {
            $client = $this->client->find($id);
            if ($client) {
                $client->update($data);
                return $client;
            }
        } catch (Exception $err) {
            Log::error('ERRO', ['erro' => $err->getMessage()]);
            return $err->getMessage();
        }
    }

    public function delete($id)
    {
        try {
            return $this->client->destroy($id);
        } catch (Exception $err) {
            Log::error('ERRO', ['erro' => $err->getMessage()]);
            return $err->getMessage();
        }
    }
}