<?php
namespace App\Services;

use App\Repositories\UserRepository;

class UserService{
    private UserRepository $user_repository;

    public function __construct(UserRepository $user_repository)
    {
        $this->user_repository = $user_repository;
    }

    public function asignarRol(int $id, string $rol)
    {
        return $this->user_repository->asignarRol($id, $rol);
    }
}
?>