@extends('layouts.admin')

@section('content')
@vite(['resources/js/payment.js'])
<div class="container">
    nome:<p>{{$sponsor->name}}</p>
    durata:<p>{{$sponsor->duration}}</p>
    prezzo:<p>{{$sponsor->price}}</p>
    <div id="dropin-wrapper">
        <div id="checkout-message"></div>
        <div id="dropin-container"></div>
        <button id="submit-button" class="submit-button submit-button--small submit-button--red">Paga ora</button>
        <button id="return-button" class="submit-button submit-button--small submit-button--red">Indietro</button>
    </div>
</div>
@endsection