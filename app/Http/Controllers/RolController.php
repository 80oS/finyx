<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnularPermisosRequest;
use App\Http\Requests\AsignarPermisoRoleRequest;
use App\Http\Requests\RoleStoreRequest;
use App\Services\PermisoService;
use App\Services\RolService;
use Illuminate\Http\Request;

class RolController extends Controller
{
    private RolService $rol_service;
    private PermisoService $permiso_service;

    public function __construct(RolService $rol_service, PermisoService $permiso_service)
    {
        $this->rol_service = $rol_service;
        $this->permiso_service = $permiso_service;
    }

    public function index()
    {
        $roles = $this->rol_service->index();

        return view('role.index', compact('roles'));
    }

    public function create()
    {
        return view('role.create');
    }

    public function store(RoleStoreRequest $request)
    {
        $this->rol_service->crear($request->validated());

        return redirect()->route('rol.index')->with('success', 'rol creado con exito');
    }

    public function edit(int $id)
    {
        $rol = $this->rol_service->buscarId($id);
        $permisos = $this->permiso_service->index($id);

        return view('role.edit', compact('rol', 'permisos'));
    }

    public function asignarPermisos(int $id, AsignarPermisoRoleRequest $request)
    {
        $this->rol_service->asignarPermisos($id, $request->validated());

        return redirect()->route('rol.index')->with('success', 'permisos asignados correctamente');
    }

    public function anularPermisos(int $id, AnularPermisosRequest $request)
    {
        $this->rol_service->anularPermisos($id, $request->validated());

        return redirect()->route('rol.index')->with('success', 'permisos anulados correctamente');
    }
}
