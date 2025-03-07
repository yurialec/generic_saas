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
        $client = $this->ClientsService->create($request->all());

        if ($client) {
            return response()->json([
                'status' => true,
                'client' => $client,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao cadastrar usuário'
            ], 204);
        }
    }

    public function edit($id)
    {
        return view('admin.clients.edit', compact('id'));
    }

    public function getClientById($id)
    {
        $client = $this->ClientsService->getClientById($id);
        if ($client) {
            return response()->json([
                'status' => true,
                'client' => $client,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao localizar cliente'
            ], 204);
        }
    }

    public function update($id, Request $request)
    {
        $client = $this->ClientsService->update($id, $request->all());

        if ($client) {
            return response()->json([
                'status' => true,
                'client' => $client,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao atualizar cliente'
            ], 204);
        }
    }
}