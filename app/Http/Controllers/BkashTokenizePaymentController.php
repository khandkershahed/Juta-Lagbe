<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Karim007\LaravelBkashTokenize\Facade\BkashPaymentTokenize;
use Karim007\LaravelBkashTokenize\Facade\BkashRefundTokenize;

class BkashTokenizePaymentController extends Controller
{
    public function index()
    {
        return view('bkashT::bkash-payment');
    }
    // public function createPayment(Request $request, $id)
    // {
    //     $order = Order::where('order_number', $id)->first();
    //     // dd($order);
    //     if ($order->payment_status == 'completely_paid') {
    //         $amount = $order->total_amount;
    //     } else {
    //         $amount = $order->shipping_charge;
    //     }

    //     try {
    //         $inv = uniqid();
    //         $request['intent'] = 'sale';
    //         $request['mode'] = '0011'; //0011 for checkout
    //         $request['payerReference'] = $inv;
    //         $request['currency'] = 'BDT';
    //         $request['amount'] = $amount;
    //         $request['merchantInvoiceNumber'] = $inv;
    //         $request['callbackURL'] = config("bkash.callbackURL");;
    //         $request_data_json = json_encode($request->all());
    //         $response =  BkashPaymentTokenize::cPayment($request_data_json);
    //         // dd($response);
    //         //$response =  BkashPaymentTokenize::cPayment($request_data_json,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..

    //         //store paymentID and your account number for matching in callback request
    //         // dd($response) //if you are using sandbox and not submit info to bkash use it for 1 response
    //         if (isset($response['bkashURL'])) {
    //             // return redirect()->route('checkout.success',$order->order_number);
    //             return redirect()->away($response['bkashURL']);
    //         } else {
    //             $order->delete();
    //             foreach ($order->orderItems as $key => $orderItem) {
    //                 $orderItem->delete();
    //             }
    //         }
    //     } catch (\Exception $e) {
    //         $order->delete();
    //         foreach ($order->orderItems as $key => $orderItem) {
    //             $orderItem->delete();
    //         }
    //         Session::flash('error', $response['message']);
    //         Session::flash('error', 'Failed to send Mail: ' . $e->getMessage());
    //         return redirect()->back()->withInput();
    //     }
    // }

    public function createPayment(Request $request, $id)
    {
        $pendingOrder = session('pending_order');

        if (!$pendingOrder || $pendingOrder['order_number'] !== $id) {
            Session::flash('error', 'Invalid order session.');
            return redirect()->back();
        }

        // $amount = $pendingOrder['total_amount'];
        if ($pendingOrder['payment_status'] == 'completely_paid') {
            $amount = $pendingOrder['total_amount'];
        } else {
            $amount = $pendingOrder['shipping_charge'];
        }
        try {
            $inv = uniqid();
            $request['intent'] = 'sale';
            $request['mode'] = '0011';
            $request['payerReference'] = $inv;
            $request['currency'] = 'BDT';
            $request['amount'] = $amount;
            $request['merchantInvoiceNumber'] = $inv;
            $request['callbackURL'] = config("bkash.callbackURL");
            $request_data_json = json_encode($request->all());
            $response = BkashPaymentTokenize::cPayment($request_data_json);

            if (isset($response['bkashURL'])) {
                return redirect()->away($response['bkashURL']);
            } else {
                Session::forget('pending_order');
                Session::flash('error', 'Payment initiation failed.' . json_encode($response));
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Session::forget('pending_order');
            Session::flash('error', 'Payment initiation failed: ' . $e->getMessage());
            return redirect()->back();
        }
    }


    // public function callBack(Request $request)
    // {

    //     if ($request->status == 'success') {
    //         $response = BkashPaymentTokenize::executePayment($request->paymentID);
    //         if (!$response) {
    //             $response = BkashPaymentTokenize::queryPayment($request->paymentID);
    //         }

    //         if (isset($response['statusCode']) && $response['statusCode'] == "0000" && $response['transactionStatus'] == "Completed") {

    //             return BkashPaymentTokenize::success('Thank you for your payment', $response['trxID']);
    //         }
    //         return BkashPaymentTokenize::failure($response['statusMessage']);
    //     } else if ($request->status == 'cancel') {
    //         return BkashPaymentTokenize::cancel('Your payment is canceled');
    //     } else {
    //         return BkashPaymentTokenize::failure('Your transaction is failed');
    //     }
    // }
    public function callBack(Request $request)
    {
        if ($request->status == 'success') {
            $response = BkashPaymentTokenize::executePayment($request->paymentID);
            if (!$response) {
                $response = BkashPaymentTokenize::queryPayment($request->paymentID);
            }

            if (isset($response['statusCode']) && $response['statusCode'] == "0000" && $response['transactionStatus'] == "Completed") {
                $pendingOrder = session('pending_order');

                if (!$pendingOrder) {
                    return BkashPaymentTokenize::failure('Order session expired.');
                }

                // Store the order in the database
                DB::beginTransaction();
                try {
                    $order = Order::create($pendingOrder);

                    foreach ($pendingOrder['cart_items'] as $item) {
                        OrderItem::create([
                            'order_id' => $order->id,
                            'product_id' => $item->id,
                            'user_id' => $pendingOrder['user_id'],
                            'product_name' => $item->name,
                            'product_color' => $item->model->color ?? null,
                            'product_sku' => $item->model->sku ?? null,
                            'size' => $item->options->size ?? null,
                            'price' => $item->price,
                            'tax' => $item->tax ?? 0,
                            'quantity' => $item->qty,
                            'subtotal' => $item->qty * $item->price,
                        ]);

                        // Update product stock
                        $product = Product::find($item->id);
                        $product->update([
                            'box_stock' => $product->box_stock - $item->qty,
                        ]);
                    }

                    DB::commit();

                    // Clear cart and session
                    Cart::instance('cart')->destroy();
                    session()->forget('pending_order');

                    return BkashPaymentTokenize::success('Thank you for your payment', $response['trxID']);
                } catch (\Exception $e) {
                    DB::rollback();
                    return BkashPaymentTokenize::failure('Order processing failed: ' . $e->getMessage());
                }
            }
            return BkashPaymentTokenize::failure($response['statusMessage']);
        } else if ($request->status == 'cancel') {
            return BkashPaymentTokenize::cancel('Your payment is canceled');
        } else {
            return BkashPaymentTokenize::failure('Your transaction failed');
        }
    }

    // public function callBack(Request $request)
    // {
    //     //callback request params
    //     // paymentID=your_payment_id&status=success&apiVersion=1.2.0-beta
    //     //using paymentID find the account number for sending params

    //     if ($request->status == 'success') {
    //         $response = BkashPaymentTokenize::executePayment($request->paymentID);
    //         //$response = BkashPaymentTokenize::executePayment($request->paymentID, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    //         if (!$response) { //if executePayment payment not found call queryPayment
    //             $response = BkashPaymentTokenize::queryPayment($request->paymentID);
    //             //$response = BkashPaymentTokenize::queryPayment($request->paymentID,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    //         }

    //         if (isset($response['statusCode']) && $response['statusCode'] == "0000" && $response['transactionStatus'] == "Completed") {

    //             return BkashPaymentTokenize::success('Thank you for your payment', $response['trxID']);
    //         }
    //         return BkashPaymentTokenize::failure($response['statusMessage']);
    //     } else if ($request->status == 'cancel') {
    //         return BkashPaymentTokenize::cancel('Your payment is canceled');
    //     } else {
    //         return BkashPaymentTokenize::failure('Your transaction is failed');
    //     }
    // }

    public function searchTnx($trxID)
    {
        //response
        return BkashPaymentTokenize::searchTransaction($trxID);
        //return BkashPaymentTokenize::searchTransaction($trxID,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }

    public function refund(Request $request)
    {
        $paymentID = 'Your payment id';
        $trxID = 'your transaction no';
        $amount = 5;
        $reason = 'this is test reason';
        $sku = 'abc';
        //response
        return BkashRefundTokenize::refund($paymentID, $trxID, $amount, $reason, $sku);
        //return BkashRefundTokenize::refund($paymentID,$trxID,$amount,$reason,$sku, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }
    public function refundStatus(Request $request)
    {
        $paymentID = 'Your payment id';
        $trxID = 'your transaction no';
        return BkashRefundTokenize::refundStatus($paymentID, $trxID);
        //return BkashRefundTokenize::refundStatus($paymentID,$trxID, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }
}
