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
    protected $signature = 'api:job-board:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reseta database de Job Board';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (! file_exists(database_path('db/job_board.sqlite'))) {
            touch(database_path('db/job_board.sqlite'));
        }
        $this->call('migrate:fresh', [
            '--path' => 'database/migrations/job_board',
            '--database' => 'job_board',
            '--force' => true,
        ]);
        $this->call('db:seed', [
            '--class' => 'Database\Seeders\JobBoard\JobSeeder',
            '--database' => 'job_board',
            '--force' => true,
        ]);
    }
}
