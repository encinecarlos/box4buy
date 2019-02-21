<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SiteContactMail;

class SiteController extends Controller
{
    public function sendEmailsite(Request $request)
    {
        Mail::send(new SiteContactMail($request->nome, $request->email, $request->mensagem));
        return redirect(route('contato'))->with('msg', 'Mensagem enviada com sucesso. Em breve retornmaremos seu contato.');
    }
}
