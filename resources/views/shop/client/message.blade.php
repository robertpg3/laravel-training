@extends('layouts.client_layout')

@section('content')
    <script>
        setTimeout(() => {
            window.location.href = '/products'
        }, 1000)
    </script>
    <div>
        <h1>{{ $message }}</h1>
    </div>
@endsection
