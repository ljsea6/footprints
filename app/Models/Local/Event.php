<?php

namespace App\Models\Local;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $connection = 'local';

    protected $table = 'footprints_events';

    protected $guarded = [];

}
