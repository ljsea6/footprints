<?php

namespace App\Models\Local;

use App\Models\Local\Card;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $connection = 'local';

    protected $table = 'footprints_users';

    protected $guarded = [];

    public function cards()
    {
        return $this->belongsToMany(Card::class, 'footprints_cards_users', 'footprints_user_id', 'footprints_card_id')->withPivot(['started_at', 'finished_at']);
    }
}
