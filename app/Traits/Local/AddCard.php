<?php


namespace App\Traits\Local;

use App\Models\Footprints\FootprintsCard;
use App\Models\Local\Card;

trait AddCard
{
    protected function add(FootprintsCard $card)
    {
        return Card::create([
            'id' => $card->RID,
            'type' => $card->TIPO,
            'card' => $card->TARJETA,
            'created_at' => $card->FH_INSERT
        ]);
    }
}
