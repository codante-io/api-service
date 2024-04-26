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
    protected $signature = 'frases-motivacionais:reset';

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
            '--path' => 'app/APIs/FrasesMotivacionais/migrations',
            '--database' => 'frases_motivacionais',
        ]);
        $this->call('db:seed', [
            '--class' => 'QuoteSeeder',
            '--database' => 'frases_motivacionais',
        ]);
    }
}
