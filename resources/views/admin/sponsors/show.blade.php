@extends('layouts.admin')

@section('content')

<section id="apartment">
    <div class="container">
        <h1 class="pb-3">Sponsorizza il tuo appartamento</h1>

        <div class="row row-cols-1 row-cols-md-2">
            <div class="col">
                <div class="card text-left">
                    <img class="card-img-top" src="{{$apartment->image}}" alt="{{$apartment->title}}">
                </div>
            </div>
            <div class="col">
                <div class="card p-3">
                    <h1 class="text-center">{{ $apartment->title }}</h1>
                    <ul class="list-unstyled">
                        <li class="py-2"><strong>Caratteristiche appartamento</strong></li>
                        <li><strong>Stanze:</strong> {{$apartment->rooms}}</li>
                        <li><strong>Bagni:</strong> {{$apartment->bathrooms}}</li>
                        <li><strong>Letti:</strong> {{$apartment->beds}}</li>
                        <li><strong>Metri quadrati:</strong> {{$apartment->square_meters}}</li>
                        <li><strong>Indirizzo:</strong> {{$apartment->address}}</li>
                    </ul>
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
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">{{$sponsor->name}}</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            Utilizza questo pacchetto per usufruire di <strong>{{$sponsor->duration}}</strong> ore di vantaggi!
                        </p>
                    </div>

                    <div class="card-footer">
                        <p class="card-text">Prezzo: <strong>{{$sponsor->price}}</strong> €</p>
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