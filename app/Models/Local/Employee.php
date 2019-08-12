<?php

namespace App\Models\Local;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $connection = 'local';

    protected $table = 'footprints_employees';

    protected $guarded = [];
}
