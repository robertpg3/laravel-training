@extends('layouts.client_layout')

@section('content')
    <div>
        <input id="cardholder-name" type="text" data-secret="{{ $user_email }}">
        <div id="card-element"></div>
        <button id="card-button" data-secret="{{ $intent->client_secret }}">
            Submit Payment
        </button>
    </div>
@endsection
