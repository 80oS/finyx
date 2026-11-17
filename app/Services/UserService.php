<?php
namespace App\Services;

use App\Repositories\UserRepository;

class UserService{
    private UserRepository $user_repository;

    public function __construct(UserRepository $user_repository)
    {
        $this->user_repository = $user_repository;
    }

    public function index()
    {
        return $this->user_repository->index();
    }

    public  function buscarId(int $id)
    {
        return $this->user_repository->buscarId($id);
    }

    public function asignarRol(int $id, array $rol)
    {
        return $this->user_repository->asignarRol($id, $rol);
    }

    public function anularRol(int $id, int $rolId)
    {
        return $this->user_repository->anularRol($id, $rolId);
    }
}
?>