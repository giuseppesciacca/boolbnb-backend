@extends('layouts.admin')

@section('script')
@vite(['resources/js/apartment.js'])
@vite(['resources/js/payment.js'])

@endsection

@section('content')

<div class="container">
    @include('admin.partials.session_message')

    @include('admin.partials.validation_errors')

    <h5 class="text-uppercase text-muted py-3 mb-0"><i class="fa-duotone fa-box-open fa-lg"></i> Pacchetto <span class="fw-semibold">{{$sponsor->name}}</span> a €{{$sponsor->price}}€ per <span class="fw-semibold">{{$sponsor->duration}}</span> ore</h5>

    <form id="custom-form" action="{{ route('admin.payments.store', ['apartment' => $apartment->id, 'sponsor' => $sponsor->id]) }}" method="post" enctype="multipart/form-data">

        @csrf

        <h4>Vuoi davvero applicare il pacchetto <span class="fw-semibold">{{$sponsor->name}}</span> a "<span class="fw-semibold text-bool">{{$apartment->title}}</span>"?</h4>

        <div id="dropin-container"></div>
        <div class="d-flex justify-content-end align-items-center gap-3 flex-wrap">
            <button id="cancel-button" class="submit-button btn-2" href="{{ URL::previous() }}">Annulla</button>
            <button id="submit-button" type="submit" class="submit-button btn-1 btn-1-green" disabled><i class="fa-solid fa-credit-card"></i> Acquista</button>
        </div>

    </form>
</div>
@endsection