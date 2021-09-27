<?php

namespace App\Http\Livewire;

use App\Http\Controllers\ClientProductController;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class Counter extends Component
{
    public $count;
    public $quantities;
    public $index;
    public $name;
    public $price;

    public function mount($index, $name, $price)
    {
        $this->name = $name;
        $this->price = $price;
        $this->index = $index;
        $this->quantities = Session::get('quantities');
//        dd($this->quantities);
//        dd($index);
        $this->count = array_column($this->quantities, 'amount')[$index];
    }

    public function increment()
    {
//        dd('INCREMENT');
        if($this->count < 10) {
            $this->count++;
            $this->updateQuantity();
        }
    }

    public function decrement()
    {
        if($this->count > 0) {
            $this->count--;
            $this->updateQuantity();
        }
    }

    protected function updateQuantity()
    {
        $this->quantities = Session::get('quantities');
        if($this->count != 0) {
            $this->quantities[$this->index]['amount'] = $this->count;
        }
        else {
            $cart = Session::get('cart');
            unset($cart[$this->index]);
            Session::forget('cart');
            Session::put('cart', $cart);
        }

        Session::forget('quantities');
        Session::put('quantities', $this->quantities);
        Session::save();
        ClientProductController::computeTotal();

        $this->emitUp('updateCartButton');
//        $this->emitUp('reRenderParent');
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
