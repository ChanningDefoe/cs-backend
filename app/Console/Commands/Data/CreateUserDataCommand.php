<?php

namespace App\Console\Commands\Data;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use League\Csv\Statement;
use App\Models\User;
use App\Models\UserPaymentDetails;

class CreateUserDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create User Data';

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
        $text = Storage::get('import/users.csv');
        $csv = Reader::createFromString($text);
        $csv->setHeaderOffset(0);

        foreach ($csv as $row) {
            User::firstOrCreate(
                [
                    'id' => $row['id']
                ],
                [
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'password' => bcrypt($row['password_plain']),
                    'shop_domain' => $row['shop_domain'],
                    'superadmin' => $row['superadmin'],
                    'is_enabled' => $row['is_enabled'],
                ]
            );

            UserPaymentDetails::firstOrCreate(
                [
                    'user_id' => $row['id']
                ],
                [
                    'user_id' => $row['id'],
                    'card_brand' => $row['card_brand'],
                    'card_last_four' => $row['card_last_four'],
                    'billing_plan' =>  $row['billing_plan'],
                    'trial_starts_at' => $row['trial_starts_at'],
                    'trial_ends_at' => $row['trial_ends_at'],
                ]

            );
        }
    }
}
