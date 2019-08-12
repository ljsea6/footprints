<?php

namespace App\Models\Local;

use Illuminate\Database\Eloquent\Model;

class CardUser extends Model
{
    protected $connection = 'local';

    protected $table = 'footprints_cards_users';

    protected $guarded = [];

    protected $dates = ['started_at', 'finished_at'];
}
