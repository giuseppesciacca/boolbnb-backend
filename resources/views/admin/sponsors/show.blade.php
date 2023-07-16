@extends('layouts.admin')

@section('content')
<section id="apartment">
    <div class="container">
        <h2 class="py-3">Sponsorizza il tuo appartamento</h2>

        <div class="row row-cols-1 row-cols-md-2">
            <div class="col">
                <div class="card text-left h-100">

                    @if ($apartment->image)

                    <img class="w-100 h-100 object-fit-cover rounded" src=" {{ asset('storage/' . $apartment->image[0]) }}">

                    @else
                    <img class="img-fluid" src=" {{ asset('storage/' . 'uploads/placeholder.png') }}">
                    @endif
                </div>
            </div>
            <div class="col">
                <div class="card p-3 h-100">
                    <h1 class="text-center our-quote">{{ $apartment->title }}</h1>
                    <ul class="icon-list list-unstyled d-flex flex-column justify-content-center align-items-start gap-1 my-4">
                        <li><i class="fa-duotone fa-house fa-lg"></i> : {{$apartment->rooms}}</li>
                        <li><i class="fa-duotone fa-bed fa-lg"></i> :  {{$apartment->beds}}</li>
                        <li><i class="fa-duotone fa-toilet fa-lg"></i> : {{$apartment->bathrooms}}</li>
                        <li><i class="fa-duotone fa-ruler fa-lg"></i> :  {{$apartment->square_meters}} <span class="fw-light"> m²</span></li>
                        <li><i class="fa-duotone fa-map-location-dot fa-lg"></i> : {{$apartment->address}}</li>
                        <li><i class="fa-duotone fa-tags"></i> : €{{$apartment->price}} <span class="fw-light"> a notte</span></li>
                    </ul>
                    <div class="d-flex gap-1 flex-wrap align-items-center">
                        @foreach($apartment->services as $service)
                        <div class="badge p-2 btn-1 btn-1-blue d-flex justify-content-center align-items-center gap-2">
                            <i class="{{$service->image}} fa-lg"></i>
                            <span class="fw-light">{{ $service->name }}</span>
                        </div>
                        @endforeach
                    </div>
                    <div class="d-flex gap-3 mt-4">
                    <a class=" btn-2 text-decoration-none w-50" href="{{ route('admin.apartments.index') }}" role="button">Indietro</a>
                        <a class=" btn-1 btn-1-orange text-decoration-none w-50" href="{{route('admin.apartments.edit', $apartment->slug)}}" role="button">Modifica</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /apartment -->

<section id="sponsorship">
    <div class="container">
        <h4 class="pb-3 pt-5">Seleziona lo sponsor che desideri applicare</h4>
        <div class="row justify-content-center row-cols-1 row-cols-md-2 row-cols-lg-3 g-3 ">
            @forelse ($sponsors as $sponsor)

            <div class="col">
                <div class="card mb-4 rounded-0
                @if ($sponsor->name == 'Advanced')
                delay-1 
                @endif
                @if ($sponsor->name == 'Premium')
                delay-2 
                @endif
                ">
                    <div class="card-header rounded-0
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
                        <h4 class="card-title rounded-0 text-center text-light text-uppercase fw-semibold mb-0">{{$sponsor->name}}</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            Utilizza questo pacchetto per usufruire di <strong>{{$sponsor->duration}}</strong> ore di vantaggi!
                        </p>
                    </div>

                    <div class="card-footer rounded-0
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
                        <p class="card-p d-flex text-light align-items-center justify-content-center mb-0 gap-2">Prezzo: <strong>€{{$sponsor->price}}</strong></p>
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