<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Pessoa;
use App\Ticket;
use App\Comment;
use Auth;
use DB;
use Mail;
use App\Mail\SupportResponse;
use App\Mail\SupportAdminResponse;

class CommentsController extends Controller
{
    public function postComment(Request $request)
    {
        $comment = Comment::create([
            'ticket_id' => $request->ticket_id,
            'user_id' => Auth::user()->codigo_suite,
            'comment' => $request->resposta
        ]);

        DB::table('tickets')->where('ticket_id', $request->ticket_id)
            ->update(['status' => 'aberto', 'updated_at' => new Carbon()]);
        Mail::send(new SupportResponse($request->ticket_id, Auth::user()->email));
        Mail::send(new SupportAdminResponse($request->ticket_id, Auth::user()->codigo_suite));

        return redirect()->back();
    }
}
