@extends('layouts.admin')

@section('content')

<div class="container">
    <h1 class="text-center">Sponsorizza il tuo appartamento per metterlo in risalto</h1>

    <h4 class="text-center">A cosa serve la sponsorizzazione?</h4>

    <p class="pt-4"> La sponsorizzazione permetterà al tuo appartamento di:</p>
    <ul class="pb-5">
        <li>
            Farlo apparire in Homepage nella sezione “Appartamenti in Evidenza”;
        </li>
        <li>
            Nella pagina di ricerca, verrà posizionato sempre prima di un appartamento non
            sponsorizzato che soddisfa le stesse caratteristiche di ricerca.
        </li>
    </ul>

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
        Nessuno sponsor esistente
        @endforelse
    </div>

    <p class="pt-3">
        Per sponsorizzare un appartamento, vai su -> <strong>Appartamenti</strong> -> clicca sull'icona a forma di occhio per visualizzare l'appartamento che desideri sponsorizzare "<i class="fa-solid fa-eye"></i>" e clicca su -> <strong>Sponsorizzami</strong>. Da lì potrai scegliere uno dei tre tipi di sponsorizzazione sopra esposti.
    </p>

    <p class="py-3">
        Terminato il periodo di sponsorizzazione, l’appartamento tornerà ad essere
        visualizzato normalmente. Potrai acquistare nuovamente il pacchetto promozionale quando vorrai.
    </p>
</div>
@endsection