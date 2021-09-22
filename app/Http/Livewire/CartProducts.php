<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Session;
use Livewire\Component;

class CartProducts extends Component
{
    public $products;
    public $quantities;
    public $totalCost;
    protected $listeners = ['reRenderParent'];

    public function mount($products, $quantities, $totalCost)
    {
        $this->products = $products;
        $this->quantities = $quantities;
        $this->totalCost = $totalCost;

    }

    public function render()
    {
        return view('livewire.cart-products');
    }

    public function reRenderParent()
    {
        $this->totalCost = Session::get('totalCost');
        $this->quantities = Session::get('quantities');
        $this->products = Session::get('cart');

    }
}
