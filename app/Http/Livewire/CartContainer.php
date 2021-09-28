<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class CartContainer extends Component
{
    public $hasCartProducts;
    public $products;
    public $quantities;
    public $totalCost;

    protected $listeners = [
        'updateCartContainer',
        'setShowCart',
        'updateQuantity'
    ];

    public function mount()
    {
        $this->products = Session::get('cart');
        $this->quantities = Session::get('quantities');
        $this->totalCost = Session::get('totalCost');
    }

    public function updateCartContainer()
    {
        $this->totalCost = Session::get('totalCost');
        $this->quantities = Session::get('quantities');
        $this->products = Session::get('cart');
    }

    public function setShowCart()
    {
        $this->hasCartProducts = true;
    }

    public function render()
    {
        if (Session::has('cart')) {
            $this->hasCartProducts = true;
        } else {
            $this->hasCartProducts = false;
        }
        return view('livewire.cart-container');

    }
}
