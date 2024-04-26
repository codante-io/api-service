<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ResetOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:orders:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reseta database de pedidos';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!file_exists(database_path('db/orders.sqlite'))) {
            touch(database_path('db/orders.sqlite'));
        }
        $this->call('migrate:fresh', [
            '--path' => 'database/migrations/orders',
            '--database' => 'orders',
        ]);
        // $this->call('db:seed', [
        //     '--class' => 'Database\Seeders\Order\OrderSeeder',
        //     '--database' => 'orders',
        // ]);
    }
}
