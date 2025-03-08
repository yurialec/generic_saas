<?php

namespace App\Repositories\Admin;

use App\Interfaces\Admin\PlanRepositoryInterface;
use App\Models\Admin\Plan;

class PlanRepository implements PlanRepositoryInterface
{
    public function all()
    {
        return Plan::all();
    }

    public function find($id)
    {
        return Plan::find($id);
    }

    public function create(array $data)
    {
        return Plan::create($data);
    }

    public function update($id, array $data)
    {
        $model = Plan::find($id);
        if ($model) {
            $model->update($data);
            return $model;
        }
        return null;
    }

    public function delete($id)
    {
        return Plan::destroy($id);
    }
}