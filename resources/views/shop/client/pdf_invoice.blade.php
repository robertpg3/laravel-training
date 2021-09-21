<!Doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Email</title>
        <link rel="stylesheet" type="text/css" href="{{asset('/css/additional-css.css')}}">
    </head>
    <body>
        <div>
            <div>
                <p><b>Products</b></p>
            </div>
            <br>
            @foreach($order_items as $index => $value)
                <div class="cart-product-pdf">
                    <p class="cart-product-info">{{ $products[$index]['name'] ?? '' }}</p>
                    <p class="cart-product-info">{{ $value['units'] }} x {{ $value['cost'] }} RON</p>
                </div>
            @endforeach

            <div class="cart-product-pdf">
                <p class="cart-product-info"><b>Total</b></p>
                <p class="cart-product-info"><b>{{ $order['totalCost'] }} RON</b></p>
            </div>
            <p class="cart-product-info"><b>Order date</b></p>
            <p class="cart-product-info"><b>{{ $order['orderDate'] }}</b></p>
        </div>
    </body>
</html>
