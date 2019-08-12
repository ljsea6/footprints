<?php


namespace App\Traits\Local;


use App\Models\Local\Event;
use App\Models\Footprints\FootprintsEvent;

trait AddEvent
{
    protected function add(FootprintsEvent $event)
    {
        return Event::create([
            'id' => $event->RID,
            'footprints_user_id' => $event->ID_USUARIO,
            'footprints_device_id' => $event->RID_BIOCLOCK,
            'created_at' => $event->FH_INSERT
        ]);
    }
}
