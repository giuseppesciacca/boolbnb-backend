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

    <form id="payment-form" action="{{ route('admin.payments.store', ['apartment' => $apartment->id, 'sponsor' => $sponsor->id]) }}" method="post" enctype="multipart/form-data">

        @csrf

        <h4>Vuoi davvero applicare il pacchetto <span class="fw-semibold">{{$sponsor->name}}</span> a "<span class="fw-semibold text-bool">{{$apartment->title}}</span>"?</h4>

        <div id="dropin-container"></div>
        <input type="hidden" id="nonce" name="payment_method_nonce" />
        <input type="hidden" id="device_data" name="device_data" />

        <div class="d-flex justify-content-end align-items-center gap-3 flex-wrap">
            <input id="submit-button" type="submit" class="submit-button btn-1 btn-1-green" />
            <a id="cancel-button" class="submit-button btn-2" href="{{ URL::previous() }}">Torna indietro</a>
        </div>
    </form>
</div>

<script type="text/javascript">
    const form = document.getElementById('payment-form');

    braintree.dropin.create({
        authorization: "{{$clientToken}}",
        container: '#dropin-container',
        dataCollector: true
    }, (error, dropinInstance) => {
        if (error) console.error(error);

        form.addEventListener('submit', event => {
            event.preventDefault();

            dropinInstance.requestPaymentMethod((error, payload) => {
                if (error) console.error(error);
                document.getElementById('device_data').value = payload.deviceData;
                document.getElementById('nonce').value = payload.nonce;
                form.submit();
            });
        });
    });
</script>
@endsection