<?php

namespace App\Listeners;

use App\Models\Local\Card;
use App\Models\Local\User;
use App\Models\Local\General;
use App\Events\EventCreated;
use App\Traits\Generals\LastRowByModel;
use App\Traits\Local\AddGeneral;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use League\Flysystem\Adapter\Local;

class SaveGeneralEvents
{
    use AddGeneral, LastRowByModel;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  EventCreated  $event
     * @return void
     */
    public function handle(EventCreated $event)
    {
        $u = User::find($event->event->footprints_user_id);

        if(is_null($u)){

            $card = Card::with('users')->where('card', $event->event->footprints_user_id)->get();

            if(count($card) > 0) {

                foreach ($card[0]->users as $user) {

                    $search = $this->search($user->document, $event->event->created_at);

                    if($user->pivot->finished_at == null) {

                        if($event->event->created_at->gte($user->pivot->started_at)) {

                            if(count($search) == 0) {
                               $g = $this->addIn($user->document, $event->event->created_at, $event->event);
                            }

                            if(count($search) == 1) {
                                $g = $this->addOut($user->document, $event->event->created_at, $event->event);
                            }

                            if(count($search) > 1) {
                                \Log::info('m', [$search]);
                            }
                        }
                    }

                    if($user->pivot->finished_at != null) {

                        if($event->event->created_at->gte($user->pivot->started_at) && $event->event->created_at->lte($user->pivot->finished_at)) {

                            if(count($search) == 0) {
                                $g = $this->addIn($user->document, $event->event->created_at, $event->event);
                            }

                            if(count($search) == 1) {
                                $g = $this->addOut($user->document, $event->event->created_at, $event->event);
                            }

                            if(count($search) > 1) {
                                \Log::info('m', [$search]);
                            }
                        }
                    }
                }
            }
        } else {

            $search = $this->search($u->document, $event->event->created_at);

            if(count($search) == 0) {
                $g = $this->addIn($u->document, $event->event->created_at, $event->event);
            }

            if(count($search) == 1) {
                $g = $this->addOut($u->document, $event->event->created_at, $event->event);
            }

            if(count($search) > 1) {
                \Log::info('m', [$search]);
            }
        }

    }
}
