<?php
namespace App\Services;

use App\Repositories\ProductoRepository;
use App\Repositories\HomeRepository;

class ProductoService{
    private ProductoRepository $producto_repository;
    private HomeRepository $homeRepository;

    public function __construct(ProductoRepository $producto_repository, HomeRepository $homeRepository)
    {
        $this->producto_repository = $producto_repository;
        $this->homeRepository = $homeRepository;
    }

    public function index()
    {
        return $this->producto_repository->index();
        
    }

    public function crear(array $datos)
    {
        return $this->producto_repository->crear($datos);
    }

    public function buscarId(int $id)
    {
        return $this->producto_repository->buscarId($id);
    }

    public function actualizar(int $id, array $datos)
    {
        return $this->producto_repository->actualizar($id, $datos);
    }

    public function changeState(int $id)
    {
        return $this->producto_repository->changeState($id);
    }

    public function totalProductos(): int
    {
        return $this->homeRepository->totalProductos();
    }
        
    }
?>