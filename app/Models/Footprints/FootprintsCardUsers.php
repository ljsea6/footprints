<?php

namespace App\Models\Footprints;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class FootprintsCardUsers extends Model
{
    protected $connection = 'footprints';

    protected $table = 'TB_USUARIO_TARJETA';

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
