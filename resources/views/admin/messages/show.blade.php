@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row row-cols-1 row-cols-md-2">
        <div class="col  order-1 order-md-0">
            <div class="p-3 d-flex flex-column justify-content-between h-100">
                <h1>Dettagli</h1>
                <ul class="list-unstyled">
                    <li class="py-2"><span>Messaggio per l' appartamento:</span> {{$apartment->title}}</li>
                    <li><span>Messaggio numero:</span> {{$message->id}}</li>
                    <li><span>Da:</span> {{$message->name}} {{$message->surname}}</li>
                    <li><span>E-mail:</span> {{$message->email}}</li>
                    <li><span>Messaggio:</span> {{$message->message}}</li>
                </ul>
                <a class="btn-2 mt-auto" href="{{ route('admin.apartments.index') }}" role="button">Return</a>
            </div>
        </div>
        <div class="col  order-0 order-md-1 mb-2">
            @if ($apartment->image)
            <img class="img-fluid rounded-3 show_image" src=" {{ asset('storage/' . $apartment->image[0]) }}">
            @else
            <img class="img-fluid" src=" {{ asset('storage/' . 'uploads/placeholder.png') }}">
            @endif
        </div>
    </div>
</div>
@endsection