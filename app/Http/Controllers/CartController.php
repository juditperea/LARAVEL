<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        $cart = Session::get('cart', []);
        $cart[$product->id] = $product;
        Session::put('cart', $cart);

        return redirect()->back();
    }

    public function deleteFromCart($id)
    {
        $cart = Session::get('cart', []);
        unset($cart[$id]);
        Session::put('cart', $cart);
        return redirect()->back();
    }
    public function viewCart()
    {
        $cart = Session::get('cart', []);

        $cartProducts = Product::whereIn('id', array_keys($cart))->get();
        $sumPrice = $cartProducts->sum(function ($product) use ($cart) {
            return $product->price;
        });
    
        return view('cart', [
            'cart' => $cartProducts,
            'products' => $cartProducts,
            'sumPrice' => $sumPrice
        ]);
    }
}
