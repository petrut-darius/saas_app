<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CallingAllPapers;
use App\Models\Conference;

class ImportConferences extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cfps:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(CallingAllPapers $cfps)
    {
        //dd($cfps->conferences());
    
        foreach($cfps->conferences()["cfps"] as $conference) {
            $this->importOrUpdateConference($conference);
        }
    
    }

    public function importOrUpdateConference(array $conference) {
        
        Conference::updateOrCreate(
            ["callingallpapers_id" => $conference["_rel"]["cfp_uri"]],
            [
                "title" => $conference["name"]
            ]
        );
        
    }
}
