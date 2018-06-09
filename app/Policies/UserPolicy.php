<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before(User $user){
        if($user->isAdmin()){
            return true;
        }
    }
    public function detalle(User $authUser, User $user ){
        if($authUser->hasRoles(['supervisor'])){
            return true;
        }
            return $authUser->id === $user->id;
    }

    public function edit(User $authUser, User $user )
    {
        return $authUser->id === $user->id;
    }

    public function update(User $authUser, User $user ){
        return $authUser->id === $user->id;
    }

    public function delete(User $authUser, User $user)
    {
        return $authUser->id === $user->id;
    }
}
