<?php
namespace App\Repositories;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermisoRepository{

    public function index(int $id)
    {
        $rol = Role::findOrFail($id);

        return Permission::WhereDoesntHave('roles', 
            function ($query) use ($rol){
                $query->where('roles.id', $rol->id);
            })->orderBy('name')->get();
    }
}
?>