<?php


namespace App\Traits\Local;

use App\Models\Local\User;
use App\Models\Footprints\FootprintsUser;

trait AddUser
{
    protected function add(FootprintsUser $user)
    {
        if(!is_null($user->DOCUMENTO2) && is_int($user->DOCUMENTO2)) {
            return User::create([
                'id' => $user->RID,
                'name' => $user->NOMBRE,
                'surname' => $user->APELLIDO,
                'document' => $user->DOCUMENTO2,
                'created_at' => $user->FH_INSERT
            ]);
        }

        if(is_null($user->DOCUMENTO2) && is_int($user->DOCUMENTO)) {
            return User::create([
                'id' => $user->RID,
                'name' => $user->NOMBRE,
                'surname' => $user->APELLIDO,
                'document' => $user->DOCUMENTO,
                'created_at' => $user->FH_INSERT
            ]);
        }

        return false;
    }
}
