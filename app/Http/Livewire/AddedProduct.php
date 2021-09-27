<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class AddedProduct extends Component
{
    public $productID;

    public function mount($productID)
    {
        $this->productID = $productID;
    }

    public function addToCart()
    {
        $product = DB::table('products')->find($this->productID);

        if (!Session::has('cart')) {
            Session::put('cart', []);
            Session::put('quantities', []);
        }

        $cart = collect(Session::get('cart'));
        $qnts = Session::get('quantities');

        if ($cart->contains('id', '=', $this->productID)) {
            foreach ($qnts as &$quantity) {
                if ($quantity['id'] == $this->productID) {
                    $quantity['amount']++;
                }
            }

            Session::forget('quantities');
            Session::put('quantities', $qnts);
        } else {
            Session::push('cart', $product);
            $quantity = array('id' => $this->productID, 'amount' => 1);
            Session::push('quantities', $quantity);
        }

        Session::save();

        $this->emit('updateCartContainer');
        $this->emit('setShowCart');
//        dd(Session::all());
    }

    public function render()
    {
        return view('livewire.added-product');
    }
}
