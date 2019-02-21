<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Facades\CotacaoDolar;
use DB;

class DolarValue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dolar:value';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the current dolar Value.';

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
        $dolar = number_format(CotacaoDolar::getDolar(), 2);
        // config(['app.dolar_value' => $dolar]);
        DB::update("update bxby_configurations set cfg_dolar = $dolar where sequencia = ?", ['1']);
        $this->info('Dolar Atualizado!');
    }
}
