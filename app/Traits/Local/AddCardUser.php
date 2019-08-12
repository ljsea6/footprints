<?php


namespace App\Traits\Local;

use App\Models\Footprints\FootprintsCardUsers;
use App\Models\Local\CardUser;

trait AddCardUser
{
    protected function add(FootprintsCardUsers $data)
    {
        return CardUser::create([
            'id' => $data->RID,
            'footprints_user_id' => $data->RID_USUARIO,
            'footprints_card_id' => $data->RID_TARJETA,
            'created_at' => $data->FH_INSERT,
            'started_at' => $data->DESDE,
            'finished_at' => $data->HASTA
        ]);
    }
}
