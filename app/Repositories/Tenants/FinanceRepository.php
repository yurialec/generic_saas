<?php

namespace App\Repositories\Tenants;

use App\Interfaces\Tenants\FinanceRepositoryInterface;
use App\Models\Tenants\Finance;

class FinanceRepository implements FinanceRepositoryInterface
{
    public function all()
    {
        return Finance::all();
    }

    public function find($id)
    {
        return Finance::find($id);
    }

    public function create(array $data)
    {
        return Finance::create($data);
    }

    public function update($id, array $data)
    {
        $model = Finance::find($id);
        if ($model) {
            $model->update($data);
            return $model;
        }
        return null;
    }

    public function delete($id)
    {
        return Finance::destroy($id);
    }
}