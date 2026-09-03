<?php
namespace App\Services;

use App\Repositories\VentaRepository;

class VentaService{
    private VentaRepository $venta_repository;

    public function __construct(VentaRepository $venta_repository)
    {
        $this->venta_repository = $venta_repository;
    }

    public function index()
    {
        return $this->venta_repository->index();
    }
}
?>