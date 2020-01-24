<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $id;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token, $id)
    {
        $this->token = $token;
        $this->id = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Box4Buy - REDEFINIÇÃO DE SENHA')
                    ->from('atendimento@box4buy.com')
                    ->markdown('emails.reset');
    }
}
