<div class="cart-list">
{{--    <div class="cart-product">--}}
{{--        <p class="cart-product-info"><b class="yellow-title">Products</b></p>--}}
{{--    </div>--}}
    <div class="cart-list-nested">
    @foreach($products as $index => $value)
            @livewire('counter', ['index' => $index, 'name' => $value->name, 'price' => $value->price], key($index))
        @endforeach
    </div>
    <div class="cart-product total-card">
        <p class="cart-product-info"><b class="yellow-title">Total</b></p>
        <p class="cart-product-info"><b class="yellow-title">{{ $totalCost }} RON</b></p>
    </div>
    <button class='buy-button' onclick="window.location.href='/cart/proceed'">Proceed</button>
</div>
