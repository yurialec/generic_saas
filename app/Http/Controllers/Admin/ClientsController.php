<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Client\CreateClientRequest;
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
        return view('admin.clients.index');
    }

    public function list(Request $request)
    {
        $clients = $this->ClientsService->all();

        if ($clients) {
            return response()->json([
                'status' => true,
                'clients' => $clients
            ], 200);
        } else {
            return response()->json([
                'message' => 'Nenhum registro encontrado.',
                'status' => 204
            ]);
        }
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(CreateClientRequest $request)
    {
        $user = $this->ClientsService->create($request->all());

        if ($user) {
            return response()->json([
                'status' => true,
                'user' => $user,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao cadastrar usuário'
            ], 204);
        }
    }
}