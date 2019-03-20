<?php

namespace App\Mail;

use App\Estoque;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class StatusNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $product_status;
    public $product;
    public $email;
    public $customer_name;

    /**
     * Create a new message instance.
     *
     * @param Estoque $product
     * @param $email
     * @param $customer_name
     * @param $status
     */
    public function __construct($product, $email, $customer_name, $status)
    {
        $this->product = $product;
        $this->product_status = $status;
        $this->email = $email;
        $this->customer_name = $customer_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('atendimento@box4buy.com')
            ->subject('Box4buy - STATUS DO PRODUTO')
            ->to($this->email)
            ->cc('cxarlos_alexandre88@hotmail.com')
            ->markdown('emails.status');
    }
}
