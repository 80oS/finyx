<?php

namespace App\Http\Controllers;

use App\Services\CompraService;
use App\Models\Proveedor;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Http\Requests\CompraStoreRequest;
use App\Http\Requests\CompraUpdateRequest;


class CompraController extends Controller
{
    private CompraService $compra_service;

    public function __construct(CompraService $compra_service)
    {
        $this->compra_service = $compra_service;
    }

    public function index()
    {
        $compras = $this->compra_service->index();

        return view('compra.index', compact('compras'));
    }


    /**
     * Show the form for creating a new resource.
     */
 public function create()
    {
        $proveedores = Proveedor::all();
        $productos   = Producto::orderBy('nombre')->get();

        return view('compra.create', compact('proveedores', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $request->validate([
        'id_proveedor' => 'required|exists:proveedor,id',
        'metodo_pago'  => 'required|in:efectivo,tarjeta,transferencia',
        'id_producto'  => 'required|exists:producto,id',
        'cantidad'     => 'required|integer|min:1',
        'precio'       => 'required|numeric|min:0',
    ]);

    $this->compra_service->registrar(
        (int) $request->id_proveedor,
        $request->metodo_pago,
        [[
            'id_producto' => (int) $request->id_producto,
            'cantidad'    => (int) $request->cantidad,
            'precio'      => (float) $request->precio,
        ]]
    );

    return redirect()->route('compra.index');
}

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit($id)
    {
        $compra = $this->compra_service->buscarId($id);

        $proveedores = Proveedor::all();

        return view('compra.edit', compact('compra', 'proveedores'));
    }
    /**
     * Update the specified resource in storage.
     */
      public function update(int $id, CompraUpdateRequest $request)
    {
        $this->compra_service->update($id, $request->validated());

        return redirect()->route('compra.index')->with('success', 'compra actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }
}
