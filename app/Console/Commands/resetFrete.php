<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class resetFrete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:frete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para limpar os valores de frete da sessão';

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
     * @return mixed
     */
    public function handle()
    {
        if (session()->has('frete')) {
            session()->forget('frete');
            return "Frete excluido com sucesso";
        } else {
            return "Nada para ser excluido!";
        }
    }
}
