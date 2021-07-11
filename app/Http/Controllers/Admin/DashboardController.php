<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Transaction;

use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $customer = User::count();
        $revenue = Transaction::where('transaction_status','SUCCESS')->sum('total_price');
        $transaction = Transaction::count();
        $transactions = TransactionDetail::with(['transaction.user','product.galleries'])
                ->whereHas('product', function($product){
                    $product->where('users_id', Auth::user()->id);
                });
        return view('pages.admin.dashboard',[
            'customer' => $customer,
            'revenue' => $revenue,
            'transaction' => $transaction,
            'transaction_count' => $transactions->count(),
            'transaction_data' => $transactions->get(),
        ]);
    }
}
