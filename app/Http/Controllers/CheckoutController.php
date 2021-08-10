<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;


class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        // save  users data
        $user = Auth::user();
        $user-> update($request->except('total_price'));

        // Process checkout
        $code = 'STORE-' . mt_rand(000000,999999);
        $carts = Cart::with(['product','user'])
                ->where('users_id', Auth::user()->id)
                ->get();

        //Transaction create
        $transaction = Transaction::create([
            'users_id' => Auth::user()->id,
            'insurance_price' => 0,
            'shipping_price' => 0,
            'total_price' => $request->total_price,
            'transaction_status' => 'PENDING',
            'code' => $code
        ]);

        foreach ($carts as $cart) {
            $trx = 'TRX-' . mt_rand(000000,999999);

            TransactionDetail::create([
            'transactions_id' => $transaction->id,
            'products_id' => $cart->product->id,
            'price' => $cart->product->price,
            'shipping_status' => 'PENDING',
            'resi' => '',
            'code' => $trx
        ]);
        }

        //DELETE CART DATA
        Cart::where('users_id', Auth::user()->id)->delete();

    }

     public function callback(Request $request)
      {
        // Set konfigurasi midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // Buat instance midtrans notification
        $notification = new Notification();

    
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;


        if ($status == 'capture') {
            if ($type == 'credit_card'){
                if($fraud == 'challenge'){
                    $transaction = Transaction::where('code', $order_id)->update([
                            'transaction_status' => 'PENDING'
                        ]);
                }
                else {
                    $transaction = Transaction::where('code', $order_id)->update([
                            'transaction_status' => 'SUCCESS'
                        ]);
                }
            }
        }
        else if ($status == 'settlement'){
             $transaction = Transaction::where('code', $order_id)->update([
                            'transaction_status' => 'SUCCESS'
                        ]);
        }
        else if($status == 'pending'){
             $transaction = Transaction::where('code', $order_id)->update([
                            'transaction_status' => 'PENDING'
                        ]);
        }
        else if ($status == 'deny') {
             $transaction = Transaction::where('code', $order_id)->update([
                            'transaction_status' => 'CANCELLED'
                        ]);
        }
        else if ($status == 'expire') {
            $transaction = Transaction::where('code', $order_id)->update([
                            'transaction_status' => 'CANCELLED'
                        ]);
        }
        else if ($status == 'cancel') {
            $transaction = Transaction::where('code', $order_id)->update([
                            'transaction_status' => 'CANCELLED'
                        ]);
        }

        // Simpan transaksi

       return $transaction;
    }
}