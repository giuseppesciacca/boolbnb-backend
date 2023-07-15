@extends('layouts.admin')

@section('content')
<section id="apartment">
    <div class="container">
        <h1 class="pb-3">Sponsorizza il tuo appartamento</h1>

        <div class="row row-cols-1 row-cols-md-2">
            <div class="col">
                <div class="card text-left h-100">

                    @if ($apartment->image)

                    <img class="w-100 h-100 object-fit-cover" src=" {{ asset('storage/' . $apartment->image[0]) }}">

                    @else
                    <img class="img-fluid" src=" {{ asset('storage/' . 'uploads/placeholder.png') }}">
                    @endif
                </div>
            </div>
            <div class="col">
                <div class="card p-3 h-100">
                    <h1 class="text-center">{{ $apartment->title }}</h1>
                    <ul class="list-unstyled">
                        <li class="py-2"><strong>Caratteristiche appartamento</strong></li>
                        <li><strong>Stanze:</strong> {{$apartment->rooms}}</li>
                        <li><strong>Bagni:</strong> {{$apartment->bathrooms}}</li>
                        <li><strong>Letti:</strong> {{$apartment->beds}}</li>
                        <li><strong>Metri quadrati:</strong> {{$apartment->square_meters}}</li>
                        <li><strong>Indirizzo:</strong> {{$apartment->address}}</li>
                    </ul>
                    <div class="d-flex gap-3 mt-4">
                        <a class=" btn-1 btn-1-gold text-decoration-none w-50" href="{{route('admin.apartments.edit', $apartment->slug)}}" role="button">Modifica</a>
                        <a class=" btn-2 text-decoration-none w-50" href="{{ route('admin.apartments.index') }}" role="button">Indietro</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /apartment -->

<section id="sponsorship">
    <div class="container">
        <h2 class="pb-3 pt-5">Seleziona lo sponsor che desideri applicare</h2>
        <div class="row justify-content-center row-cols-1 row-cols-md-2 row-cols-lg-3 g-3 ">
            @forelse ($sponsors as $sponsor)

            <div class="col">
                <div class="card mb-4
                @if ($sponsor->name == 'Advanced')
                delay-1 
                @endif
                @if ($sponsor->name == 'Premium')
                delay-2 
                @endif
                ">
                    <div class="card-header
                    @if ($sponsor->name == 'Basic')
                bg_bronze
                @endif
                @if ($sponsor->name == 'Advanced')
                bg_silver 
                @endif
                @if ($sponsor->name == 'Premium')
                bg_gold 
                @endif
                    ">
                        <h4 class="card-title text-center">{{$sponsor->name}}</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            Utilizza questo pacchetto per usufruire di <strong>{{$sponsor->duration}}</strong> ore di vantaggi!
                        </p>
                    </div>

                    <div class="card-footer
                    @if ($sponsor->name == 'Basic')
                bg_bronze 
                @endif
                @if ($sponsor->name == 'Advanced')
                bg_silver 
                @endif
                @if ($sponsor->name == 'Premium')
                bg_gold 
                @endif
                    d-flex justify-content-between align-content-center">
                        <p class="card-text d-flex align-items-center justify-content-center mb-0 gap-2">Prezzo: <strong>€{{$sponsor->price}}</strong></p>
                        <a class="btn-1 btn-1-black text-decoration-none" href="{{route('admin.payments.create', ['apartment' => $apartment, 'sponsor' => $sponsor])}}" role=" button">Scegli</a>
                    </div>

                </div>
            </div>

            @empty
            <p>Sponsor non disponibili</p>
            @endforelse
        </div>
    </div>
</section>
<!-- /sponsorhip -->
@endsection