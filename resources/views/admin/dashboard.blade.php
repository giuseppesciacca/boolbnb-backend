@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <h1>
                <span class="fs-1 text-dark">ciao </span>
                <span class="our-user">{{ $user }}</span>
            </h1>
            <p>aggiungi un appartamento e sponsorizzalo, in modo tale da essere in evidenza e avere piu possibilità di affittarlo in modo sicuro e veloce.</p>
            <p>Dalla tua <span class="text-bool">Dashboard</span> puoi:
            </p>
            <ul>
                <li>Controllare i <span class="text-bool">tuoi</span> appartamenti attualmente in affitto, modificarli a tuo piacimento uno ad uno e, nel caso, eliminarli</li>
                <li>Visualizzare <span class="text-bool">tutti</span> i messaggi ricevuti da potenziali clienti per i tuoi boolbnb</li>
                <li>Rimanere informato su <span class="text-bool">tutte</span> le promozioni che boolbnb ha realizzato ad hoc per te</li>
            </ul>
            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
            </div>
            <div class="card-footer dashboard d-flex justify-content-center my-5">
                <div class="w-100 h-100 row  justify-content-between gap-4 align-items-center text-center mb-0">
                    <a href="{{ route('admin.apartments.create') }}" class="dash_link col w-25 p-5 rounded-3">
                        <span class="text-light fw-bold text-decoration-none mb-4">Aggiungi</span>
                        <i class="fa-duotone fa-house-chimney text-white fa-bounce"></i>
                    </a>
                    <a href="{{ route('admin.apartments.index') }}" class="dash_link col w-25 p-5 rounded-3">
                        <span class="text-light fw-bold text-decoration-none mb-4">Appartamenti</span>
                        <i class="fa-duotone fa-house-building fa-bounce text-white mt-2"></i>
                    </a>
                    <a href="{{ route('admin.messages.index') }}" class="dash_link col w-25 p-5 rounded-3">
                        <span class="text-light fw-bold text-decoration-none mb-4">Messaggi</span>
                        <i class="fa-duotone fa-envelope text-white fa-bounce mt-2"></i>
                    </a>
                    <a href="{{ route('admin.sponsors.index') }}" class="dash_link col w-25 p-5 rounded-3">
                        <span class="text-light fw-bold text-decoration-none mb-4">Sponsor</span>
                        <i class="fa-duotone fa-dollar-sign text-white fa-bounce mt-2"></i>
                    </a>
                    <!--                     <li class="p-3 rounded-3 mb-3 {{ str_starts_with(Route::currentRouteName(), 'admin.views') ? 'bg-danger fst-italic fw-bolder' : 'bg-dark' }}">
                                <a class="text-light fw-bold text-decoration-none" href="{{ route('admin.views.index') }}">Lista statistiche singolo appartamento</a>
                            </li> -->
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

<!-- Nella view della dashboard ci sarà un bottone a link di create new apartment e un bottone a link di index apartment 
sotto pagina lista messaggi
pagina sponsorizzazione
pagina statistiche singolo appartamento-->