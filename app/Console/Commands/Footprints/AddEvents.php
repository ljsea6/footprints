<?php

namespace App\Console\Commands\Footprints;

use App\Events\EventCreated;
use App\Models\Footprints\FootprintsEvent;
use App\Models\Local\Card;
use App\Models\Local\Event;
use App\Models\Local\User;
use App\Traits\Generals\LastRowByModel;
use App\Traits\Local\AddEvent;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AddEvents extends Command
{
    use LastRowByModel, AddEvent;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:events';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $model = new Event();
        $last = $this->LastRow($model);

        if(is_null($last)) {

            $results = FootprintsEvent::take(50000)->get();

            if(!is_null($results)) {
                foreach ($results as $result) {
                    $saved = $this->add($result);
                    if($saved) {
                        event(new EventCreated($saved));
                        $this->info('Se ha guardado el registro: ' . $result);
                    }
                }
            }
        } else {

            $results = FootprintsEvent::where('RID', '>', $last->id)->take(50000)->get();

            if(count($results) > 0) {
                foreach ($results as $result) {
                    $saved = $this->add($result);
                    if($saved) {
                        event(new EventCreated($saved));
                        $this->info('Se ha guardado el registro: ' . $result);
                    }
                }
            }
        }
    }
}
