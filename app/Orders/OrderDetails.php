<?php
namespace App\Orders;

use App\Billing\PaymentGetway;

class OrderDetails{

    private $paymentGetway;

    public function __construct(PaymentGetway $paymentGetway)
    {
        $this->paymentGetway = $paymentGetway;
    }
    public function all(){
        $this->paymentGetway->setDiscount(500);
        return [
            'name'=>'Victory',
            'address'=>'dhaka bangladesh',
        ];
    }
}