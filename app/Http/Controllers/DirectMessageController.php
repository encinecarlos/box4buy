<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pessoa;
use Mail;
use App\Mail\MultiDirectMessage;
use DB;

class DirectMessageController extends Controller
{
    public function index()
    {
        $query = "SELECT codigo_suite, email, nome_completo FROM bxby_pessoas";
        $emails = DB::select($query);
        return view('messages.main', ['emails' => $emails]);
    }
    
    public function sendToAll(Request $request)
    {        
        $query_email = "SELECT email from bxby_pessoas";
        $mailaddress = DB::select($query_email);
        foreach ($mailaddress as $address) {
            if ($address->email != null) {
                Mail::to($address->email)->send(new MultiDirectMessage($request->message, $request->subject));
            }
        }

        return redirect(route('send-direct-message'))->with('msg', 'Mensagem enviada com sucesso!');
    }
    
    public function sendToSingle(Request $request)
    {        
        // $query_email = "SELECT email from bxby_pessoas where codigo_suite IN (15,19)";
        $mailaddress = $request->emailto;
        foreach ($mailaddress as $address) {
            // dump($address);
            if ($address != null) {
                Mail::to($address)->send(new MultiDirectMessage($request->message, $request->subject));
            }
        }
           
        return redirect(route('send-direct-message'))->with('msg', 'Mensagem enviada com sucesso!');
    }

    public function uploadFolder(Request $request)
    {
        return $request->file_path;
    }

    // public function uploadFolder(Request $request)
    // {
    //     try {
    //         if ($request->hasFile('file')) {
    //             $filename = str_random(30) . '.' . $request->file('file')->getClientOriginalExtension();

    //             $user_folder = 'temp_img';

    //             $destination = public_path() . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . $user_folder;

    //             $fullpath = DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . $user_folder . DIRECTORY_SEPARATOR . $filename;
    //             $request->file('file')->move($destination, $filename);
    //             return $fullpath;
    //         }
    //         // return response()->json(['msg' => 'Foto inserida com sucesso!', 'status' => '1']);
    //     } catch (QueryException $ex) {
    //         return CustomException::trataErro($ex);
    //     }
    // }
}
