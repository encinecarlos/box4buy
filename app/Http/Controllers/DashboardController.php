<?php

namespace App\Http\Controllers;

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
        
         $orcamento_pendente = Orcamento::where('status', '4')->orderBy('sequencia', 'desc')->limit(5)->get();   
         
         $suporte_aberto = Ticket::where('status', 'aberto')->orderBy('id', 'desc')->limit(5)->get();

        return view('dashboard.main', ['usuarios' => $usercount, 
                                       'orcamentos_pendentes' => $countorcamento, 
                                       'orcamentos_pagos' => $countpagos, 
                                       'chamados_abertos' => $countchamados, 
                                       'box_enviados' => $produtos_enviadosbox,
                                       'box_orcamentos_pendentes' => $orcamento_pendente,
                                       'suporte_aberto' => $suporte_aberto]);
    }
}
