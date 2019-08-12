<?php

namespace App\Models\Local;

use Illuminate\Database\Eloquent\Model;

class General extends Model
{
    protected $connection = 'local';

    protected $table = 'general';

    protected $guarded = ['id'];
}
