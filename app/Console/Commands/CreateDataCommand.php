<?php

namespace App\Console\Commands;

use App\Console\Commands\Data\CreateInventoryDataCommand;
use App\Console\Commands\Data\CreateUserDataCommand;
use Illuminate\Console\Command;
use App\Console\Commands\Data\CreateProductDataCommand;

class CreateDataCommand extends Command
{
    const COMMANDS_TO_RUN = [
        CreateUserDataCommand::class,
        CreateProductDataCommand::class,
        CreateInventoryDataCommand::class
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:data';

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
        // $this->call('mail:send', [
        //     'user' => 1, '--queue' => 'default'
        // ]);
        foreach (self::COMMANDS_TO_RUN as $command) {
            $this->call($command);
        }
    }
}
