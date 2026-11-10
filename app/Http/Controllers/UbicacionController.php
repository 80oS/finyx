<?php

namespace App\Http\Controllers;

use App\Http\Requests\AsignarProductoUbicacionRequest;
use App\Http\Requests\MoverProductosUbicacionRequest;
use App\Http\Requests\UbicacionStoreRequest;
use App\Http\Requests\UbicacionUpdateRequest;
use App\Models\Ubicacion;
use App\Services\UbicacionService;
use Illuminate\Http\Request;

class UbicacionController extends Controller
{
    private UbicacionService $ubicacion_service;

    public function __construct(UbicacionService $ubicacion_service)
    {
        $this->ubicacion_service = $ubicacion_service;
    }
    public function index()
    {
        $ubicaciones = $this->ubicacion_service->index();
        return view('ubicacion.index', compact('ubicaciones'));
    }

    public function create()
    {
        $ubicaciones = $this->ubicacion_service->ubicacionPadre();

        return view('ubicacion.create', compact('ubicaciones'));
    }

    public function store(UbicacionStoreRequest $request)
    {
        $this->ubicacion_service->store($request->validated());

        return redirect()->route('ubicacion.index')->with('success', 'ubicacion creada correctamente');
    }

    public function show(int $id)
    {
        $ubicacion = $this->ubicacion_service->show($id);

        return view('ubicacion.show', compact('ubicacion'));
    }

    public function edit(int $id)
    {
        $ubicacion = $this->ubicacion_service->buscarId($id);
        $ubicaciones = $this->ubicacion_service->excluirIdUbicacion($id);

        return view('ubicacion.edit', compact('ubicacion', 'ubicaciones'));
    }

    public function update(UbicacionUpdateRequest $request, int $id)
    {
        $this->ubicacion_service->update($id, $request->validated());

        return redirect()->route('ubicacion.index')->with('success', 'ubicacion actualizada con exito');
    }

    public function changeState(int $id)
    {
        $mensaje = $this->ubicacion_service->changeState($id);

        return redirect()->route('ubicacion.index')->with('success', $mensaje);
    }

    public function asignarProductosUbicacion(int $id, AsignarProductoUbicacionRequest $request)
    {
        $ubicacion = $this->ubicacion_service->asignarProductosUbicacion($id, $request->validated());

        return redirect()->route('ubicacion.show', $ubicacion->id)->with('success', 'productos asignados correctamnete');
    }

    public function MoverProductosUbicacion(MoverProductosUbicacionRequest $request, int $id)
    {
        $ubicacion = $this->ubicacion_service->buscarId($id);
        $datos = $request->validated();

        $productos = collect($datos['productos'])
            ->filter(fn ($producto) => (int) $producto['seleccionado'] === 1)
            ->map( fn ($producto) => [
                'id_producto' => (int) $producto['id_producto'],
                'cantidad' => (int) $producto['cantidad'],
            ])->values()->all();
        
        try {
            $this->ubicacion_service->moverProductos(
            (int) $ubicacion->getKey(),
            (int) $datos['id_destino'],
            $productos);
        } catch (\DomainException $e) {
            return back()
                ->withErrors(['productos' => $e->getMessage()])
                ->withInput();
        }

        return redirect()->route('ubicacion.show', $ubicacion->getKey())->with('success', 'Los productos se trasladaron correctamente.');
    }
}
