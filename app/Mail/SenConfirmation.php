<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\ConfirmaDados;

class SenConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $suite;
    public $email;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($suite, $email)
    {
        $this->suite = $suite;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Box4Buy - Criação de conta')
                    ->from('atendimento@box4buy.com')
                    ->cc(['info@box4buy.com'])
                    ->markdown('emails.confirmation');
    }
}
