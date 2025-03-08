<?php

namespace App\Services\Admin;

use App\Repositories\Admin\SubscriptionsRepository;

class SubscriptionsService
{
    protected $SubscriptionsRepository;

    public function __construct(SubscriptionsRepository $SubscriptionsRepository)
    {
        $this->SubscriptionsRepository = $SubscriptionsRepository;
    }

    public function all()
    {
        return $this->SubscriptionsRepository->all();
    }
}