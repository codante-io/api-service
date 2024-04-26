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
    protected $description = 'Reseta e faz o seed';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('migrate:fresh', [
            '--path' => 'database/migrations/orders',
            '--database' => 'orders',
        ]);
        $this->call('db:seed', [
            '--class' => 'Database\Seeders\Order\OrderSeeder',
            '--database' => 'orders',
        ]);
    }
}
