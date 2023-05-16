<?php
namespace App\Orders;

use App\Billing\PaymentGetwayContract;

class OrderDetails{

    private $paymentGetway;

    public function __construct(PaymentGetwayContract $bankPaymentGetway)
    {
        $this->paymentGetway = $bankPaymentGetway;
    }
    public function all(){
        $this->paymentGetway->setDiscount(500);
        return [
            'name'=>'Victory',
            'address'=>'dhaka bangladesh',
        ];
    }
}