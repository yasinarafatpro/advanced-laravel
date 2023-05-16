<?php

namespace App\Http\Controllers;

use App\Billing\BankPaymentGetway;
use App\Billing\PaymentGetwayContract;
use App\Orders\OrderDetails;
use Illuminate\Http\Request;

class PayOrderController extends Controller
{
    public function store(PaymentGetwayContract $contractPaymentGetway,OrderDetails $orderDetails){
        // $paymentGetway=new PaymentGetway(currency:'usd');
        $order = $orderDetails->all();
        dd($contractPaymentGetway->charge(2500));
    }
}
