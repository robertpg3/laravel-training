@extends('layouts.client_layout')

@section('content')
    <div class="cart-container">
        @if($products)
            @livewire('cart-products', ['products' => $products, 'quantities' => $quantities, 'totalCost' => $totalCost])
        @else
            <p>Empty cart</p>
        @endif
    </div>
@endsection
