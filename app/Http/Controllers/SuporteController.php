<?php

namespace App\Http\Controllers;

use App\Lib\NotificationSystem;
use App\Notifications\AnnouncementNotification;
use App\User;
use Illuminate\Http\Request;
use App\Pessoa;
use App\Ticket;
use App\Category;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Mail\SupportMessage;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminSupportMessage;

class SuporteController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('user_id', Auth::user()->codigo_suite)->get();
        $category = Category::all();

        return view('suporte.main', ['mensagens' => $tickets, 'categorias' => $category]);
    }

    public function adminIndex()
    {
        $tickets = Ticket::where('status', 'aberto')->orWhere('status', 'respondido')->get();
        $category = Category::all();
        
        return view('suporte.admin.main', ['mensagens' => $tickets, 'categorias' => $category]);
    }

    public function historico()
    {
        $tickets = Ticket::where('status', 'fechado')->get();
        $category = Category::all();

        return view('suporte.admin.history', ['mensagens' => $tickets, 'categorias' => $category]);
    }

    public function create()
    {
        $categories = Category::all();

        return view('suporte.add', ['categorias' => $categories]);
    }

    public function store(Request $request)
    {
        $ticket_number = str_replace(".", "", substr(hexdec(uniqid(str_random(64))), 0, 6));
        DB::insert(
            'insert into tickets (user_id, ticket_id, message, status, created_at, updated_at) values (?,?,?,?,?,?)',
        [
            Auth::user()->codigo_suite,
            $ticket_number,
            $request->message,
            'aberto',
            new Carbon,
            new Carbon
        ]
        );

        $this->sendEmailSupport();
        $this->notifyAdminEmail();

        /*NotificationSystem::notifyAdmin(
            "Chamado de suporte $ticket_number aberto!",
            "suporte",
            "fa fa-ticket",
            $ticket_number);*/

        
        return redirect()->route('tickets.usuario');
    }

    private function sendEmailSupport()
    {
        $userid = Auth::user()->codigo_suite;
        $user_name = DB::table('bxby_pessoas')->select(['nome_completo', 'email'])->where('codigo_suite', $userid)->get();
        Mail::send(new SupportMessage($user_name));
    }

    private function notifyAdminEmail()
    {
        $ticket = DB::table('tickets')->orderBy('id', 'DESC')->get();
        Mail::send(new AdminSupportMessage($ticket));
    }

    public function show($ticket_id)
    {
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
        $categoria = $ticket->category;
        $respostas = $ticket->comments;
        
        return view('suporte.show', ['ticket' => $ticket, 'categoria' => $categoria, 'respostas' => $respostas]);
    }

    public function adminShow($ticket_id)
    {
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
        $categoria = $ticket->category;
        $respostas = $ticket->comments;
        
        return view('suporte.admin.show', ['ticket' => $ticket, 'categoria' => $categoria, 'respostas' => $respostas]);
    }

    public function closeTicket($ticket_id)
    {
        DB::table('tickets')->where('ticket_id', $ticket_id)->update(['status' => 'fechado']);
        return response()->json(['msg' => 'Chamado encerrado com sucesso!', 'status' => '1']);
    }
    
    public function openTicket($ticket_id)
    {
        DB::table('tickets')->where('ticket_id', $ticket_id)->update(['status' => 'aberto']);
        return response()->json(['msg' => 'Chamado aberto com sucesso!', 'status' => '1']);
    }
}
