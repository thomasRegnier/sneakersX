<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailShop extends Mailable
{
    //

    private $datas;
    use Queueable, SerializesModels;

    public function __construct($order, $products)
    {
        //
        $this->order = $order;
        $this->products = $products;

    }

    public function build()
    {
        return $this->from('thomas.regnier3001@gmail.com', 'Mailtrap')
            ->subject('Shop message')
            ->view('mailShop')
            ->with(['info' => $this->order, 'products' => $this->products]);
    }
}
