<?php

namespace App\Repositories;

use App\Models\User;

class RegisterRepository{

    public function registro(array $datos){
        return User::create($datos);
    }
}

?>