<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ResetFrasesMotivacionais extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:frases-motivacionais:reset';

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
        if (!file_exists(database_path('db/frases_motivacionais.sqlite'))) {
            touch(database_path('db/frases_motivacionais.sqlite'));
        }

        $this->call('migrate:fresh', [
            '--path' => 'database/migrations/frases_motivacionais',
            '--database' => 'frases_motivacionais',
        ]);
        $this->call('db:seed', [
            '--class' => 'Database\Seeders\FrasesMotivacionais\QuoteSeeder',
            '--database' => 'frases_motivacionais',
        ]);
    }
}
