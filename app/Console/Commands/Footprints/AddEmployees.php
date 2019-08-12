<?php

namespace App\Console\Commands\Footprints;

use Illuminate\Console\Command;
use App\Models\Local\Employee;
use App\Traits\Local\AddEmployee;
use App\Traits\Generals\LastRowByModel;
use App\Models\Footprints\FootprintsEmployee;

class AddEmployees extends Command
{
    use LastRowByModel, AddEmployee;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:employees';

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
        $model = new Employee();
        $last = $this->LastRow($model);

        if(is_null($last)) {

            $results = FootprintsEmployee::take(10000)->get();

            if(!is_null($results)) {
                foreach ($results as $result) {
                    $saved = $this->add($result);

                    if($saved) {
                        $this->info('Se ha guardado el registro: ' . $saved);
                    }else {
                        $this->info('No se pudo guardar el registro: ' . $result);
                    }
                }
            }
        } else {

            $results = FootprintsEmployee::where('RID', '>', $last->id)->take(10000)->get();

            if(count($results) > 0) {
                foreach ($results as $result) {
                    $saved = $this->add($result);

                    if($saved) {
                        $this->info('Se ha guardado el registro: ' . $saved);
                    }else {
                        $this->info('No se pudo guardar el registro: ' . $result);
                    }
                }
            }
        }
    }
}
