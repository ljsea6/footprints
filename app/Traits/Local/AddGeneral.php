<?php


namespace App\Traits\Local;

use App\Models\Local\General;

trait AddGeneral
{
    protected function addIn($document, $event, $metadata)
    {
        return General::create([
            'document' => $document,
            'application' => 'footprints',
            'action' => 'in',
            'event_date' => $event,
            'metadata' => $metadata
        ]);
    }

    protected function addOut($document, $event, $metadata)
    {
        return General::create([
            'document' => $document,
            'application' => 'footprints',
            'action' => 'out',
            'event_date' => $event,
            'metadata' => $metadata
        ]);
    }

    protected function search($document, $date)
    {
        return General::where('document', $document)
            ->whereDate('created_at', date('Y-m-d', strtotime($date)))
            ->get();
    }

    protected function update($id, $date, $metadata)
    {
        $find = General::find($id);

        if(count($find) > 0) {
            $find->event_date = $date;
            $find->metadata = $metadata;
            $find->save();

            return $find;
        }

        return false;
    }
}
