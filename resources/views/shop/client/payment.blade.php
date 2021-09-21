@extends('layouts.client_layout')

@section('content')
        <div class="payment-container">
            <div class="payment-data">
                <input id="cardholder-name" class="card-input" type="text" placeholder="Name" data-secret="{{ $user_email }}">
                <div id="card-element" class="card-input"></div>
            </div>
            <button id="card-button" class="card-input" data-secret="{{ $intent->client_secret }}">
                Submit Payment
            </button>
        </div>
@endsection
