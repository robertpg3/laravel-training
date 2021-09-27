<!DOCTYPE html>
<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <link rel="stylesheet" type="text/css" href="{{asset('/css/app.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('/css/additional-css.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://js.stripe.com/v3/"></script>
        <script defer src="https://unpkg.com/alpinejs@3.3.4/dist/cdn.min.js"></script>
        <script src="{{asset('/js/payment.js')}}"></script>
        <script src="{{asset('/js/cart.js')}}"></script>
        <title>Shop</title>

        @livewireStyles
    </head>
    <body>
        @yield('content')

        @livewireScripts
    </body>
</html>
