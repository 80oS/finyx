<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private AuthService $auth_service;

    public function __construct(AuthService $auth_service)
    {
        $this->auth_service = $auth_service;
    }

    public function store(LoginRequest $request)
    {
        try {
            $this->auth_service->login($request->validated());
            return redirect()->intended('/home');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function destroy()
    {
        $this->auth_service->logout();

        return redirect()->route('login')->with('cerrado de sesion exitoso');
    }

    public function registroCreate()
    {
        return view('user.register');
    }

    public function registroStore(RegisterRequest $request)
    {
        $this->auth_service->registro($request->validated());

        return redirect()->route('login')->with('usuario creado correctamnete');
    }
}
