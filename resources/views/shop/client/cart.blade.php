@extends('layouts.client_layout')

@section('content')
    <div class="cart-container">
        @if($products)
            <div class="cart-list">
                <div class="cart-product">
                    <p class="cart-product-info"><b class="yellow-title">Products</b></p>
                </div>
                @foreach($products as $index => $value)
                    <div class="cart-product">
                        <div class="product-cart-image-title">
                            <img src="{{asset('/img/product_image_2.png')}}" alt="product_image" class="product-cart-image">
                            <p class="cart-product-info">{{ $value->name }}</p>
                        </div>
                        <p class="cart-product-info"><b>{{ $quantities[$index]['amount'] }}</b> x <b>{{ $value->price }}</b> RON</p>
                    </div>
                @endforeach
                <div class="cart-product total-card">
                    <p class="cart-product-info"><b class="yellow-title">Total</b></p>
                    <p class="cart-product-info"><b class="yellow-title">{{ $totalCost }} RON</b></p>
                </div>
                <button class='buy-button' onclick="window.location.href='/cart/proceed'">Proceed</button>
            </div>
        @else
            <p>Empty cart</p>
        @endif
    </div>
@endsection
