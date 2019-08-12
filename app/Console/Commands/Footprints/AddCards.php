<?php

namespace App\Console\Commands\Footprints;

use App\Models\Footprints\FootprintsCard;
use App\Models\Local\Card;
use App\Traits\Generals\LastRowByModel;
use App\Traits\Local\AddCard;
use Illuminate\Console\Command;

class AddCards extends Command
{
    use LastRowByModel, AddCard;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:cards';

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
        $model = new Card();
        $last = $this->LastRow($model);

        if(is_null($last)) {

            $results = FootprintsCard::take(10000)->get();

            if(!is_null($results)) {
                foreach ($results as $result) {
                    $saved = $this->add($result);
                    if($saved) {
                        $this->info('Se ha guardado el registro: ' . $saved);
                    }
                }
            }
        } else {

            $results = FootprintsCard::where('RID', '>', $last->id)->take(10000)->get();

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
