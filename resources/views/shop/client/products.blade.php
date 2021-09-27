@extends('layouts.client_layout')

@section('content')
    <div class="round-floating-button logout-icon-container" onclick="window.location.href='/logout'">
        <i class="fa fa-sign-out"></i>
    </div>
    <div class="round-floating-button order-history-icon-container" onclick="window.location.href='/order-history'">
        <i class="fa fa-history"></i>
    </div>
    <div class="background">
        <div class="main-container" >
            @livewire('cart-container')
            <div class="products-container">
                @foreach($products as $product)
                    <div class="product-card">
                        <div class="product-short-info" onclick="window.location.href='/product-details/{{ $product->id }}'">
                            <div class="product-title-image">
                                <p class="product-title"><b>{{ $product->name }}</b></p>
                                <img src="{{asset('/img/product_image_2.png')}}" alt="product_image" class="product_small_image">
                            </div>
                            <p>Price: <b>{{ $product->price }}</b> RON</p>
                        </div>
                        @livewire('added-product', ['productID' => $product->id])
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

