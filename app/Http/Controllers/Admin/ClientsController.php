<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\ClientsService;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    protected $ClientsService;

    public function __construct(ClientsService $ClientsService)
    {
        $this->ClientsService = $ClientsService;
    }

    public function index()
    {
        return response()->json($this->ClientsService->all());
    }
}