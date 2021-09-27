<div class="cart-modal-container {{ $over }}" x-data="{ showModal: false }">

    @if($hasCartProducts)
        <div class="round-floating-button cart-icon-container" @click="showModal = !showModal" @click.stop>
            <i class="fa fa-shopping-cart"></i>
        </div>
        <div x-show="showModal" class="cart-modal"  id="cart-modal-id" @click.away="showModal = false">
            <div class="cart-container">
                <div class="cart-list">
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
            </div>
        </div>
    @endif
</div>
