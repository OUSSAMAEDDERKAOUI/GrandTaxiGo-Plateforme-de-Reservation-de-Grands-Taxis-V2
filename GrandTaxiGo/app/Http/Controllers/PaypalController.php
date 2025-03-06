<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;

class PaypalController extends Controller
{
    public function payment(){

        $data = [];
        $data['items'] = [
            [
                'name' => 'Product 1',
                'price' => 9.99,
                'desc'  => 'Description for product 1',
                'qty' => 1
            ],
            [
                'name' => 'Product 2',
                'price' => 4.99,
                'desc'  => 'Description for product 2',
                'qty' => 2
            ]
        ];
        
        $data['invoice_id'] = 1;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = '/payment/success';
        $data['cancel_url'] = '/cancel';
        $data['total'] = 2600;
    
        $provider= new ExpressCheckout ;

        $response = $provider->setExpressCheckout($data);
        dd($response['paypal_link']);
           return redirect($response['paypal_link']);

    }
    public function cancel(){
        return response()->json('payment canclled',402);
    }
    public function seccuss(Request $request){
        $provider= new ExpressCheckout ;
        $response = $provider->getExpressCheckoutDetails($request->token);
        if(in_array(strtoupper($response['ACK']),['success','SuCCESSWITHWARNING'])){
       return response()->json('Paid success');
        }
        return response()->json('Fail payment',402);

    }
}
