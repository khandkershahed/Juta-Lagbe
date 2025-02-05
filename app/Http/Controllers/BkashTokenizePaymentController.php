<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Karim007\LaravelBkashTokenize\Facade\BkashRefundTokenize;
use Karim007\LaravelBkashTokenize\Facade\BkashPaymentTokenize;

class BkashTokenizePaymentController extends Controller
{
    public function index()
    {
        return view('bkashT::bkash-payment');
    }

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

        $inv = uniqid();

        // "statusCode" => "0000"
        // "statusMessage" => "Successful"
        // "paymentID" => "TR0011WQ1674418613025"
        // "bkashURL" => "https://sandbox.payment.bkash.com/redirect/tokenized/?paymentID=TR0011WQ1674418613025&hash=t1-54Dtkmi*wr1KeWV55Z8fl5_DqsaW2q.zQWAQrPtpMsg*5zhuy3w17ZbXEvQ)qU7IT_ ▶"
        // "callbackURL" => "base_url/bkash/callback"
        // "successCallbackURL" => "base_url/bkash/callback?paymentID=TR0011WQ1674418613025&status=success"
        // "failureCallbackURL" => "base_url/bkash/callback?paymentID=TR0011WQ1674418613025&status=failure"
        // "cancelledCallbackURL" => "base_url/bkash/callback?paymentID=TR0011WQ1674418613025&status=cancel"
        // "amount" => "100"
        // "intent" => "sale"
        // "currency" => "BDT"
        // "paymentCreateTime" => "2023-01-23T02:16:57:784 GMT+0600"
        // "transactionStatus" => "Initiated"
        // "merchantInvoiceNumber" => "63cd99abe6bae"
        $request['intent'] = 'authorization';
        $request['mode'] = '0011';
        $request['payerReference'] = $inv;
        $request['currency'] = 'BDT';
        $request['amount'] = $amount;
        $request['merchantInvoiceNumber'] = $inv;
        $request['callbackURL'] = config("bkash.callbackURL");
        $request['successCallbackURL'] = config("bkash.callbackURL");
        $request['failureCallbackURL'] = config("bkash.callbackURL");
        $request['cancelledCallbackURL'] = config("bkash.callbackURL");
        $request['cancelledCallbackURL'] = config("bkash.callbackURL");
        $request['cancelledCallbackURL'] = config("bkash.callbackURL");
        $request_data_json = json_encode($request->all());
        $response = BkashPaymentTokenize::cPayment($request_data_json);

        if (isset($response['bkashURL'])) {
            session()->put('pending_order.bkash', 'success');
            return redirect()->away($response['bkashURL']);
        } else {
            Session::flash('error', 'Payment initiation failed.' . json_encode($response));
            return redirect()->back();
            // return redirect()->back()->with('error', $response['statusMessage']);
        }
    }


    public function callBack(Request $request)
    {
        //callback request params
        // paymentID=your_payment_id&status=success&apiVersion=1.2.0-beta
        //using paymentID find the account number for sending params

        if ($request->status == 'success') {
            $response = BkashPaymentTokenize::executePayment($request->paymentID);
            //$response = BkashPaymentTokenize::executePayment($request->paymentID, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
            if (!$response) { //if executePayment payment not found call queryPayment
                $response = BkashPaymentTokenize::queryPayment($request->paymentID);
                //$response = BkashPaymentTokenize::queryPayment($request->paymentID,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
            }

            if (isset($response['statusCode']) && $response['statusCode'] == "0000" && $response['transactionStatus'] == "Completed") {
                /*
                 * for refund need to store
                 * paymentID and trxID
                 * */
                session()->put('pending_order.bkash', 'success');
                return BkashPaymentTokenize::success('Thank you for your payment', $response['trxID']);
            }
            return BkashPaymentTokenize::failure($response['statusMessage']);
        } else if ($request->status == 'cancel') {
            return BkashPaymentTokenize::cancel('Your payment is canceled');
        } else {
            return BkashPaymentTokenize::failure('Your transaction is failed');
        }
    }


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
