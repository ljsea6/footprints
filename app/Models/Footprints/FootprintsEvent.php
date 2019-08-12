<?php

namespace App\Models\Footprints;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class FootprintsEvent extends Model
{
    protected $connection = 'footprints';

    protected $table = 'TB_BIOCLOCK_EVENTO';

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
