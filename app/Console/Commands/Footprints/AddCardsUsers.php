<?php

namespace App\Console\Commands\Footprints;

use App\Models\Footprints\FootprintsCardUsers;
use App\Models\Local\CardUser;
use App\Traits\Generals\LastRowByModel;
use App\Traits\Local\AddCardUser;
use Illuminate\Console\Command;

class AddCardsUsers extends Command
{
    use LastRowByModel, AddCardUser;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:cards_users';

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
        $model = new CardUser();
        $last = $this->LastRow($model);

        if(is_null($last)) {

            $results = FootprintsCardUsers::take(10000)->get();

            if(!is_null($results)) {
                foreach ($results as $result) {
                    $saved = $this->add($result);
                    if($saved) {
                        $this->info('Se ha guardado el registro: ' . $saved);
                    }
                }
            }
        } else {

            $results = FootprintsCardUsers::where('RID', '>', $last->id)->take(10000)->get();

            if(count($results) > 0) {
                foreach ($results as $result) {
                    $saved = $this->add($result);

                    if($saved) {
                        $this->info('Se ha guardado el registro: ' . $saved);
                    }
                }
            }
        }
    }
}
