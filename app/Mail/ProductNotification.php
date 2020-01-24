<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProductNotification extends Mailable
{
    use Queueable, SerializesModels;
    
    public $suite;
    public $email;
    public $produtodescricao;
    public $produtoquantidade;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($suite, $email,$productdescription, $productquantity)
    {
        $this->suite = $suite;
        $this->email = $email;
        $this->produtodescricao = $productdescription;
        $this->produtoquantidade = $productquantity;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Box4Buy [SUITE CB#$this->suite] - NOVO PRODUTO CADASTRADO")
            ->from('atendimento@box4buy.com')
            ->to(['info@box4buy.com'])
            ->cc($this->email)
            ->markdown('emails.productnotification');
    }
}
