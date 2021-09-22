<div class="cart-product">
    <div class="product-cart-image-title">
        <img src="{{asset('/img/product_image_2.png')}}" alt="product_image" class="product-cart-image">
        <p class="cart-product-info">{{ $name }}</p>
    </div>
    <div class="quantity-container">
        <div style="text-align: center">
            <button class="quantity-button" wire:click="decrement"><b>-</b></button>
            <button class="quantity-button" wire:click="increment"><b>+</b></button>
        </div>
        <p class="cart-product-info"><b>{{ $quantities[$index]['amount'] }}</b> x <b>{{ $price }}</b> RON</p>
    </div>
</div>
