<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\SheetDbController;

class SaveDataCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:save';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command save data from spreadsheet';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $controller = new SheetDbController();
        $controller->saveDataAllCompany();

        info("Cron Job running at ". now());
    }
}