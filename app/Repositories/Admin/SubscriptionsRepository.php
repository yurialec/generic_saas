<?php

namespace App\Repositories\Admin;

use App\Interfaces\Admin\SubscriptionsRepositoryInterface;
use App\Models\Admin\Subscriptions;

class SubscriptionsRepository implements SubscriptionsRepositoryInterface
{
    public function all()
    {
        return Subscriptions::all();
    }

    public function find($id)
    {
        return Subscriptions::find($id);
    }

    public function create(array $data)
    {
        return Subscriptions::create($data);
    }

    public function update($id, array $data)
    {
        $model = Subscriptions::find($id);
        if ($model) {
            $model->update($data);
            return $model;
        }
        return null;
    }

    public function delete($id)
    {
        return Subscriptions::destroy($id);
    }
}