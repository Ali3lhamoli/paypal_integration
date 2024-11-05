<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use Srmklive\PayPal\Services\ExpressCheckout;

class PayPalController extends Controller
{
    public function index(){
        return view('order');
    }
    public function ckeckout(OrderRequest $orderRequest){
        $item = $orderRequest->validated();
        $item['price'] = 100;
        $total = $item['qty'] * $item['price'];
        $rundom = uniqid();
        $data = [
            'items' => [
                $item,
            ],
            'invoice_id' => $rundom,
            'invoice_description' => 'Order #' . $rundom . 'description',
            'return_url' => route('paypal.success'),
            'cancel_url' => route('paypal.cancel',['invoice_id' => $rundom]),
            'total' => $total,
        ];

        $order = Order::create(
            [
                'name'      => $item['name'],
                'qty'       => $item['qty'],
                'price'     => $item['price'],
                'total'     => $data['total'],
                'status'    => 0,
                'invoice_id'=> $data['invoice_id'],
            ]
        );
    

        $provider = new ExpressCheckout();
        $response = $provider->setExpressCheckout($data,true);
        // dd($response);
        return redirect($response['paypal_link']);
    }
    public function success(Request $request ){
        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->input('token'));
        if(in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])){
            $order = Order::where('invoice_id',$response['INVNUM'])->first();
            $order->status = 1;
            $order->save();
            return view('success');
        }
        $order = Order::where('invoice_id',$response['INVNUM'])->first();
        $order->delete();
        return view('error');
    }
    public function cancel(Request $request){
        $order = Order::where('invoice_id',$request['invoice_id'])->first();
        $order->delete();
        toastr()->info('Order Cancelled! Your order has been cancelled.');
        return redirect()->route('paypal');
    }
}
