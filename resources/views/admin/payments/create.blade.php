@extends('layouts.admin')

@section('script')
@vite(['resources/js/apartment.js'])
@vite(['resources/js/payment.js'])

@endsection

@section('content')

<div class="container">
    @include('admin.partials.session_message')

    @include('admin.partials.validation_errors')

    <h5 class="text-uppercase text-muted pb-3">Aggiungi lo sponsor {{$sponsor->name}} a {{$sponsor->price}}€ per {{$sponsor->duration}} ore</h5>

    <form id="custom-form" action="{{ route('admin.payments.store', ['apartment' => $apartment->id, 'sponsor' => $sponsor->id]) }}" method="post" enctype="multipart/form-data">

        @csrf

        <h3>Vuoi davvero applicare lo sponsor {{$sponsor->name}} per l'appartamento "{{$apartment->title}}"?</h3>

        <div id="dropin-container"></div>
        <button id="submit-button" type="submit" class="submit-button button--small submit-button--red">Acquista</button>
    </form>
</div>
@endsection