<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ResetReviews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:reviews:reset';

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
        if (! file_exists(database_path('db/reviews.sqlite'))) {
            touch(database_path('db/reviews.sqlite'));
        }

        $this->call('migrate:fresh', [
            '--path' => 'database/migrations/reviews',
            '--database' => 'reviews',
            '--force' => true,
        ]);
        $this->call('db:seed', [
            '--class' => 'Database\Seeders\Reviews\ReviewSeeder',
            '--database' => 'reviews',
            '--force' => true,
        ]);
    }
}
