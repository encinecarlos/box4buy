<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SupportMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $userdata;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->userdata = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Box4Buy - NOVO CHAMADO DE SUPORTE')
                    ->from('atendimento@box4buy.com')
                    ->to($this->userdata[0]->email)
                    ->markdown('emails.suporteuser');
    }
}
