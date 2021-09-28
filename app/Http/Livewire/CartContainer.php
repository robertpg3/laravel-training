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
    protected $over = '';

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
        $this->renderCounter++;
        $this->totalCost = Session::get('totalCost');
        $this->quantities = Session::get('quantities');
        $this->products = Session::get('cart');
    }

    public function updateQuantity()
    {
        $this->over = 'over';
        $this->updateCartContainer();
    }

    public function setShowCart()
    {
//        $this->over = 'over';
        $this->hasCartProducts = true;
    }

    public function display()
    {
//        dd('HERE');
        $this->over = 'over';
    }

    public function render()
    {
//        var_dump($this->renderCounter);
        if (Session::has('cart')) {
            $this->hasCartProducts = true;
        } else {
            $this->hasCartProducts = false;
        }
//        dd($this->renderCounter);
        return view('livewire.cart-container', ['over' => $this->over]);

        if ($this->renderCounter == 0 || $this->renderCounter > 1) {
            $this->renderCounter++;
//            var_dump($this->renderCounter);

//        } elseif ($this->renderCounter == 1) {
//            echo 'second if';
//            $this->renderCounter += 2;
//            return view('livewire.cart-container', ['over' => 'over']);
//        }
        }
    }
}
