<?php

namespace App\Repositories\Admin;

use App\Interfaces\Admin\PlanRepositoryInterface;
use App\Models\Admin\Plan;
use Exception;
use Log;

class PlanRepository implements PlanRepositoryInterface
{
    protected $plan;

    public function __construct(Plan $plan)
    {
        $this->plan = $plan;
    }

    public function all()
    {
        try {
            return $this->plan->paginate(10);
        } catch (Exception $err) {
            Log::error('Erro', ['erro' => $err->getMessage()]);
            return null;
        }
    }

    public function find($id)
    {
        return $this->plan->find($id);
    }

    public function create(array $data)
    {
        try {
            return $this->plan->create($data);
        } catch (Exception $err) {
            Log::error('Erro', ['erro' => $err->getMessage()]);
            return null;
        }
    }

    public function update($id, array $data)
    {
        try {
            $model = $this->plan->find($id);
            if ($model) {
                $model->update($data);
                return $model;
            }
        } catch (Exception $err) {
            Log::error('Erro', ['erro' => $err->getMessage()]);
            return null;
        }
    }

    public function delete($id)
    {
        try {
            return $this->plan->destroy($id);
        } catch (Exception $err) {
            Log::error('Erro', ['erro' => $err->getMessage()]);
            return null;
        }
    }
}