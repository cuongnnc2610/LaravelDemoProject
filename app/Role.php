<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	public $timestamps = false; 

    public function users()
    {
        return $this->belongsToMany('App\User', 'role_users', 'idRole', 'idUser');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\Permission', 'permission_role', 'idRole', 'idPermission');
    }
}
