<?php

namespace App\Repositories\Admin;

use App\Interfaces\Admin\ClientsRepositoryInterface;
use App\Models\Admin\Clients;

class ClientsRepository implements ClientsRepositoryInterface
{
    public function all()
    {
        return Clients::all();
    }

    public function find($id)
    {
        return Clients::find($id);
    }

    public function create(array $data)
    {
        return Clients::create($data);
    }

    public function update($id, array $data)
    {
        $model = Clients::find($id);
        if ($model) {
            $model->update($data);
            return $model;
        }
        return null;
    }

    public function delete($id)
    {
        return Clients::destroy($id);
    }
}