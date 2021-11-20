<?php

namespace App\Console\Commands\Data;

use App\Models\Inventory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use League\Csv\Statement;
use App\Models\User;
use App\Models\UserPaymentDetails;
use App\Models\Products;

class CreateInventoryDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:inventory-data';

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
     * @return int
     */
    public function handle()
    {
        $text = Storage::get('import/inventory.csv');
        $csv = Reader::createFromString($text);
        $csv->setHeaderOffset(0);

        foreach ($csv as $row) {
            Inventory::firstOrCreate(
                [
                    'id' => $row['id'],
                ],
                $row
            );
        }
    }
}
