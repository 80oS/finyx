<?php
namespace App\Services;

use App\Repositories\PermisoRepository;

class PermisoService{
    private PermisoRepository $permiso_repository;

    public function __construct(PermisoRepository $permiso_repository)
    {
        $this->permiso_repository = $permiso_repository;
    }

    public function index(int $id)
    {
        return $this->permiso_repository->index($id);
    }
}
?>