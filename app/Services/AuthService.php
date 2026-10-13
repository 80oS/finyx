<?php

namespace App\Services;

use App\Repositories\RegisterRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthService{

    private RegisterRepository $register_repository;

    public function __construct(RegisterRepository $register_repository)
    {
        $this->register_repository = $register_repository;
    }

    public function login(array $datos): void
    {
        if(!Auth::attempt($datos)){
            throw ValidationException::withMessages([
                'email' => 'las credenciales no son correctas',
            ]);
        }

        request()->session()->regenerate();
    }

    public function logout(): void
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }

    public function registro(array $datos)
    {
        return $this->register_repository->registro($datos);
    }
}
?>