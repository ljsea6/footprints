<?php


namespace App\Traits\Local;

use App\Models\Local\Device;
use App\Models\Footprints\FootprintsDevice;

trait AddDevice
{
    protected function add(FootprintsDevice $device)
    {
        return Device::create([
            'id' => $device->RID,
            'name' => $device->NOMBRE,
            'created_at' => $device->FH_INSERT
        ]);
    }
}
