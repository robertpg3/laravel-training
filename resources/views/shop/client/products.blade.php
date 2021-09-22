@extends('layouts.client_layout')

@section('content')
    <div class="round-floating-button order-history-icon-container" onclick="window.location.href='/order-history'">
        <i class="fa fa-history"></i>
    </div>
    <div class="background" x-data="{ showModal: false }">
        <div class="main-container" >
            @if(\Illuminate\Support\Facades\Session::has('cart'))
{{--                <div class="round-floating-button cart-icon-container" onclick="window.location.href='/cart'">--}}
{{--                    <i class="fa fa-shopping-cart"></i>--}}
{{--                </div>--}}

            @endif
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
                        <div class="product-cart-button" onclick="window.location.href='/add-to-cart/{{ $product->id }}'">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="round-floating-button cart-icon-container" @click="showModal = true">
            <i class="fa fa-shopping-cart"></i>
        </div>
        <div x-show="showModal" class="cart-modal">
            <div class="cart-container">
                @livewire('cart-products', ['products' => Session::get('cart'), 'quantities' => Session::get('quantities'), 'totalCost' => Session::get('totalCost')])
            </div>
            <a class="modal-close-button" @click="showModal = false">X</a>
        </div>
    </div>
@endsection

