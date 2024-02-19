<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BankAccountController extends Controller
{
    public function create()
    {
        return view('buy');
    }

        public function store(Request $request)
        {
            if (!$request->has('user_id')) {
                return redirect()->back();
            }
    
            $bankAccount = new BankAccount();
            
            $bankAccount->user_id = $request->user_id;
            $bankAccount->account_number = $request->account_number;
            $bankAccount->account_holder = $request->account_holder;
            $bankAccount->bank_name = $request->bank_name;
            $bankAccount->branch = $request->branch;
            
            $bankAccount->save();

             //Vaciar el carrito después del pago
                Session::forget('cart');
    
            return view('payment');
    }
    
}
