@extends('layouts.client_layout')

@section('content')
    <div class="background full-height">
        <div class="product-container">
            <p><b>{{ $product->name }}</b></p>
            <p>Details:</p>
            <div class="product-details">
                <p>{{ $product->description }}</p>
            </div>
            <p>Price: <b>{{ $product->price }}</b> RON</p>
            <div class="cart-button-details" onclick="window.location.href='/add-to-cart/{{ $product->id }}'">
                <i class="fa fa-shopping-cart"></i>
            </div>
        </div>
    </div>
@endsection
