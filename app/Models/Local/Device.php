<?php

namespace App\Models\Local;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $connection = 'local';

    protected $table = 'footprints_devices';

    protected $guarded = [];
}
