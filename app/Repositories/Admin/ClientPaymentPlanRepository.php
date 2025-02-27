<?php

namespace App\Repositories\Admin;

use App\Interfaces\Admin\ClientPaymentPlanRepositoryInterface;
use App\Models\Admin\ClientPaymentPlan;

class ClientPaymentPlanRepository implements ClientPaymentPlanRepositoryInterface
{
    public function all()
    {
        return ClientPaymentPlan::all();
    }

    public function find($id)
    {
        return ClientPaymentPlan::find($id);
    }

    public function create(array $data)
    {
        return ClientPaymentPlan::create($data);
    }

    public function update($id, array $data)
    {
        $model = ClientPaymentPlan::find($id);
        if ($model) {
            $model->update($data);
            return $model;
        }
        return null;
    }

    public function delete($id)
    {
        return ClientPaymentPlan::destroy($id);
    }
}