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
    protected $renderCounter = 0;


    protected $listeners = [
        'updateCartContainer',
        'setShowCart'
    ];

    public function mount()
    {
        $this->products = Session::get('cart');
        $this->quantities = Session::get('quantities');
        $this->totalCost = Session::get('totalCost');
    }

    public function updateCartContainer()
    {
        $this->renderCounter++;
        $this->totalCost = Session::get('totalCost');
        $this->quantities = Session::get('quantities');
        $this->products = Session::get('cart');
    }

    public function updateQuantity()
    {

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

        if ($this->renderCounter == 0) {
            $this->renderCounter++;
            return view('livewire.cart-container', ['over' => '']);
        } else {
            return view('livewire.cart-container', ['over' => 'over']);
        }
    }
}
