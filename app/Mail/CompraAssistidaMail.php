<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class CompraAssistidaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $id, $status, $observacoes, $email, $suite;

    /**
     * Create a new message instance.
     *
     * @param $id
     * @param $suite
     * @param $status
     * @param $observacoes
     * @param $email
     */
    public function __construct($id, $suite ,$status, $observacoes, $email)
    {
        $this->id = $id;
        $this->status = $status;
        $this->observacoes = $observacoes;
        $this->email = $email;
        $this->suite = $suite;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('COMPRA ASSISTIDA - NOVA SOLICITAÇÃO')
                    ->from('atendimento@box4buy.com')
                    ->to($this->email)
                    ->bcc('info@box4buy.com')
                    ->markdown('emails.assistida-notification');
    }
}
