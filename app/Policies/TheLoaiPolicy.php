<?php

namespace App\Policies;

use App\TheLoai;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use DB;

class TheLoaiPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\TheLoai  $theLoai
     * @return mixed
     */
    //public function view(User $user, TheLoai $theLoai)
    public function view(User $user)
    {
        foreach ($user->roles as $role) {
            foreach ($role->permissions as $permission) {
                if($permission->name == 'theloai.view')
                    return true;
            }
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        foreach ($user->roles as $role) {
            foreach ($role->permissions as $permission) {
                if($permission->name == 'theloai.create')
                    return true;
            }
        }
        return false;
        //return $user->roles->permissions->name == "theloai.create";
        /*$idRole = DB::table('role_users')->where('idUser', $user->id)->first()->idRole;
        $permissions = DB::table('permission_role')->where('idRole', $idRole)->select('idPermission')->get()->toArray();
        foreach ($permissions as $permission) {
            if($permission->idPermission == 1)
                return true;
        }
        return false;*/
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\TheLoai  $theLoai
     * @return mixed
     */
    //public function update(User $user, TheLoai $theLoai)
    public function update(User $user)
    {
        foreach ($user->roles as $role) {
            foreach ($role->permissions as $permission) {
                if($permission->name == 'theloai.edit')
                    return true;
            }
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\TheLoai  $theLoai
     * @return mixed
     */
    //public function delete(User $user, TheLoai $theLoai)
    public function delete(User $user)
    {
        foreach ($user->roles as $role) {
            foreach ($role->permissions as $permission) {
                if($permission->name == 'theloai.delete')
                    return true;
            }
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\TheLoai  $theLoai
     * @return mixed
     */
    public function restore(User $user, TheLoai $theLoai)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\TheLoai  $theLoai
     * @return mixed
     */
    public function forceDelete(User $user, TheLoai $theLoai)
    {
        //
    }
}
