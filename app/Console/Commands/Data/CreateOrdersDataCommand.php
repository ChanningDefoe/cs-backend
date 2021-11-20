<?php

namespace App\Console\Commands\Data;

use App\Models\Orders;
use Illuminate\Console\Command;
use App\Models\Inventory;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use League\Csv\Statement;
use App\Models\User;
use App\Models\UserPaymentDetails;
use App\Models\Products;

class CreateOrdersDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:order-data';

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
        $text = Storage::get('import/orders.csv');
        $csv = Reader::createFromString($text);
        $csv->setHeaderOffset(0);

        foreach ($csv as $row) {
            // dd($row);
            $row = collect($row)->map(function ($item) {
                if ($item === 'NULL') {
                    return null;
                }
            })->toArray();
            Orders::firstOrCreate(
                [
                    'id' => $row['id'],
                ],
                $row
            );
        }
    }
}
