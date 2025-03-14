<?php

namespace App\Interfaces\Tenants;

interface PatientRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function disable($id);
    public function getPatientById($id);
}