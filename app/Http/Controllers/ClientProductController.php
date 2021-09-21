<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Counter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Session;
use PHPUnit\Util\Json;
use Stripe\Stripe;

class ClientProductController extends Controller
{
    public function index()
    {
//        Session::flush();
        $products = DB::table('products')->get();
        return view('/shop/client/products', ['products' => $products]);
    }

    public function show(Request $request, $id)
    {
        $product = DB::table('products')->find($id);
        return view('/shop/client/product_details', ['product' => $product]);
    }

    public function addToCart(Request $request, $id)
    {
        $product = DB::table('products')->find($id);

        if (!Session::has('cart')) {
            Session::put('cart', []);
            Session::put('quantities', []);
        }

        $cart = collect(Session::get('cart'));
        $qnts = Session::get('quantities');

        if ($cart->contains('id', '=', $id)) {
            foreach ($qnts as &$quantity) {
                if ($quantity['id'] == $id) {
                    $quantity['amount']++;
                }
            }

            Session::forget('quantities');
            Session::put('quantities', $qnts);
            Session::save();
        } else {
            Session::push('cart', $product);
            $quantity = array('id' => $id, 'amount' => 1);
            Session::push('quantities', $quantity);
        }

        return back();
    }

    public function showCart()
    {
        $totalCost = self::computeTotal();
        Session::put('totalCost', $totalCost);

        return view('/shop/client/cart', ['products' => Session::get('cart'), 'quantities' => Session::get('quantities'), 'totalCost' => $totalCost]);
    }

    public function testWire()
    {
        return view('/shop/client/testwire');
    }

    public static function computeTotal()
    {
        $totalCost = 0;
        $quantities = Session::get('quantities');
        foreach (Session::get('cart') as $index => $value) {
            $totalCost = $totalCost + $value->price * $quantities[$index]['amount'];
        }

        return $totalCost;
    }
}

