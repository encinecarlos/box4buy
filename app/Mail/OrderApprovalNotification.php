<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderApprovalNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $userinfo;
    public $orderinfo;
    public $productinfo;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderinfo, $productinfo, $userinfo)
    {
        $this->userinfo = $userinfo;
        $this->orderinfo = $orderinfo;
        $this->productinfo = $productinfo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Box4Buy [SUITE CB#{$this->userinfo[0]->codigo_suite}] - ORÇAMENTO APROVADO")
            ->from('atendimento@box4buy.com')
            ->to([$this->userinfo[0]->email])
            ->markdown('emails.orderApprovalNotification');
    }
}
