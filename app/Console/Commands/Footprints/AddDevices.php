<?php

namespace App\Console\Commands\Footprints;

use App\Models\Local\Device;
use App\Traits\Local\AddDevice;
use Illuminate\Console\Command;
use App\Traits\Generals\LastRowByModel;
use App\Models\Footprints\FootprintsDevice;

class AddDevices extends Command
{
    use LastRowByModel, AddDevice;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:devices';

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
        $model = new Device();
        $last = $this->LastRow($model);

        if(is_null($last)) {

            $results = FootprintsDevice::take(10000)->get();

            if(!is_null($results)) {
                foreach ($results as $result) {
                    $saved = $this->add($result);
                    if($saved) {
                        $this->info('Se ha guardado el registro: ' . $saved);
                    }
                }
            }
        } else {

            $results = FootprintsDevice::where('RID', '>', $last->id)->take(10000)->get();

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
