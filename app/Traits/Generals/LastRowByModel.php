<?php


namespace App\Traits\Generals;

use Illuminate\Database\Eloquent\Model;

trait LastRowByModel
{
    protected function LastRow(Model $model)
    {
        return $model::all()->last();
    }
}
