<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteStoreRequest;
use App\Http\Requests\ClienteUpdateRequest;
use App\Models\cliente;
use App\Services\ClienteService;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    private ClienteService $cliente_service;

    public function __construct(ClienteService $cliente_service)
    {
        $this->cliente_service = $cliente_service;
    }
    public function index()
    {
        $cliente = $this->cliente_service->index();
        return view('cliente.index', compact('cliente'));
    }

    public function create()
    {
        
    }

    public function store(ClienteStoreRequest $request)
    {
       
    }

    public function edit(int $id)
    {
       
    }

    public function update(int $id, ClienteUpdateRequest $request)
    {
        
    }

    public function destroy(cliente $cliente)
    {
        
    }
}
