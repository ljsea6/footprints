<?php

namespace App\Models\Local;

use App\Models\Local\User;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $connection = 'local';

    protected $table = 'footprints_cards';

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class, 'footprints_cards_users','footprints_card_id' ,'footprints_user_id' )->withPivot(['started_at', 'finished_at']);
    }
}
