<?php

namespace App\Repositories\Admin;

use App\Interfaces\Admin\PaymentsRepositoryInterface;
use App\Models\Admin\Payments;

class PaymentsRepository implements PaymentsRepositoryInterface
{
    public function all()
    {
        return Payments::all();
    }

    public function find($id)
    {
        return Payments::find($id);
    }

    public function create(array $data)
    {
        return Payments::create($data);
    }

    public function update($id, array $data)
    {
        $model = Payments::find($id);
        if ($model) {
            $model->update($data);
            return $model;
        }
        return null;
    }

    public function delete($id)
    {
        return Payments::destroy($id);
    }
}