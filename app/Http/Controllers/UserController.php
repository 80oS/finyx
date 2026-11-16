<?php

namespace App\Http\Controllers;

use App\Http\Requests\AsignarUserRoleRequest;
use App\Services\RolService;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $user_service;
    private RolService $rol_service;

    public function __construct(UserService $user_service, RolService $rol_service)
    {
        $this->user_service = $user_service;
        $this->rol_service = $rol_service;
    }

    public function index()
    {
        $users = $this->user_service->index();

        return view('user.index', compact('users'));
    }

    public function edit(int $id)
    {
        $user = $this->user_service->buscarId($id);
        $roles = $this->rol_service->index();

        return view('user.edit', compact('user', 'roles'));
    }

    public function asignarRole(int $id, AsignarUserRoleRequest $request)
    {
        $this->user_service->asignarRol($id, $request->validated());

        return redirect()->route('user.index')->with('success', 'rol asignado al usario con exito');
    }
}
