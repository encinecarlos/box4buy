<?php

namespace App\Http\Controllers;

use App\CompraAssistidaInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use App\Orcamento;
use App\Ticket;
use App\Estoque;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::where('type_user', '2')->get();
//        $user_month = User::selectRaw("'codigo_suite', 'nome_completo', 'sobrenome', date_format('data_cadastro', '%m')")
//            ->get()
//            ->sortBy('month');

//        $currentMonth = ;
        $user_month = User::where('type_user', 2)
            ->whereMonth('data_cadastro', now()->format('m'))
            ->whereYear('data_cadastro', now()->format('Y'))
            ->orderBy('codigo_suite', 'desc')
            ->limit(5)
            ->get();

        $usercount = $users->count();

        $orcamentos = Orcamento::where('status', '4')->get();
        $countorcamento = $orcamentos->count();
        
        $orcamentospagos = Orcamento::where('status', '6')->get();
        $countpagos = $orcamentospagos->count();

        $suporte = Ticket::Where('status', 'aberto')->get();
        $countchamados = $suporte->count();

        $produtos_enviadosbox = Estoque::select('seq_produto','codigo_suite', 'descricao_produto')
                                        ->where('status', '1')
                                        ->orderBy('codigo_suite', 'desc')
                                        ->limit(5)
                                        ->get();

        $compra_assistida = CompraAssistidaInfo::select('sequencia', 'suite_id', 'created_at')
            ->where('status_solicitacao', '10')
            ->orderBy('sequencia', 'desc')
            ->limit(5)
            ->get();
        
         $orcamento_pendente = Orcamento::where('status', '4')->orderBy('sequencia', 'desc')->limit(5)->get();   
         
         $suporte_aberto = Ticket::where('status', 'aberto')->orderBy('id', 'desc')->limit(5)->get();

        return view('dashboard.main', ['usuarios' => $usercount,
                                       'usuario_mes' => $user_month,
                                       'orcamentos_pendentes' => $countorcamento, 
                                       'orcamentos_pagos' => $countpagos, 
                                       'chamados_abertos' => $countchamados, 
                                       'box_enviados' => $produtos_enviadosbox,
                                       'box_orcamentos_pendentes' => $orcamento_pendente,
                                       'compra_assistida' => $compra_assistida,
                                       'suporte_aberto' => $suporte_aberto]);
    }
}
