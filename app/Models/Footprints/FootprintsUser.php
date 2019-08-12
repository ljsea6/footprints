<?php

namespace App\Models\Footprints;

use App\Models\Footprints\FootprintsEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class FootprintsUser extends Model
{
    protected $connection = 'footprints';

    protected $table = 'TB_USUARIO';

    protected $primaryKey = 'RID';

    protected static function boot()
    {
        parent::boot();

        // Order by name ASC
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('RID', 'asc');
        });
    }
}
