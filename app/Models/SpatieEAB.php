<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class SpatieEAB extends Model
{
    use HasFactory;

    public function getPermission($name){
        $existe = false;
        if(Permission::where('name', 'like', "$name.%")->count() > 0){ $existe=true; }
        return $existe;
    }

    public function getPermissionRole($role, $permission){
        return DB::table('role_has_permissions')->where('role_id',$role)->where('permission_id',$permission)->count();
        // Devuelve 0=false ó 1=true
    }

    public function getPermissionRoleName($role, $name){
        return DB::table('role_has_permissions')
                ->join('permissions','permissions.id','role_has_permissions.permission_id')
                    ->where('role_id',$role)->where('name',$name)->count();
        // Devuelve 0=false ó 1=true
    }
}
