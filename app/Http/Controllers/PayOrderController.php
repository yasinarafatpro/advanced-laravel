<?php

namespace App\Http\Controllers;

use App\Billing\PaymentGetway;
use App\Orders\OrderDetails;
use Illuminate\Http\Request;

class PayOrderController extends Controller
{
    public function store(PaymentGetway $paymentGetway,OrderDetails $orderDetails){
        // $paymentGetway=new PaymentGetway(currency:'usd');
        $order = $orderDetails->all();
        dd($paymentGetway->charge(2500));
    }
}
