@extends('layouts.admin')

@section('content')

<div class="container">
    <h1 class="text-center mb-3">Sponsorizza il tuo appartamento per metterlo in risalto</h1>

    <h4 class="text-center">A cosa serve la sponsorizzazione?</h4>

    <p class="pt-4"> La sponsorizzazione permetterà al tuo appartamento di:</p>
    <ul class="pb-5 list-unstyled">
        <li>
            <i class="fa-solid fa-hand-point-right fa-lg me-2 fa-shake" style="color: #ff5a5f;"></i> Farlo apparire in Homepage nella sezione “Appartamenti in Evidenza”;
        </li>
        <li>
            <i class="fa-solid fa-hand-point-right fa-lg me-2 fa-shake" style="color: #ff5a5f;"></i> Nella pagina di ricerca, verrà posizionato sempre prima di un appartamento non
            sponsorizzato che soddisfa le stesse caratteristiche di ricerca.
        </li>
    </ul>

    <div class="row sponsorship justify-content-center row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
        @forelse ($sponsors as $sponsor)
        <div class="col">
            <div class="card mb-3 rounded-2
                @if ($sponsor->name == 'Advanced')
                delay-1 
                @endif
                @if ($sponsor->name == 'Premium')
                delay-2 
                @endif
            ">
                <div class="card-header rounded-2            
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
                    <h4 class="card-title text-center text-light text-uppercase fw-bold">{{$sponsor->name}}</h4>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        Utilizza questo pacchetto per usufruire di <strong>{{$sponsor->duration}}</strong> ore di vantaggi!
                    </p>
                </div>

                <div class="card-footer rounded-2
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
                    <p class="card-text text-light card-p">Prezzo: <strong>€{{$sponsor->price}}</strong></p>
                </div>

            </div>
        </div>

        @empty
        <p>Sponsor non disponibili</p>
        @endforelse
    </div>

    <p class="sponsor py-3">
        Per sponsorizzare un appartamento, vai su <i class="fa-regular fa-arrow-right fa-fade fa-fw"></i> <strong>Appartamenti</strong> <i class="fa-regular fa-arrow-right fa-fade fa-fw"></i> clicca sull'icona a forma di occhio per visualizzare l'appartamento che desideri sponsorizzare " <i class="fa-duotone fa-lg fa-eye fa-beat" style="color: #0d6efd;"></i> " e clicca su <i class="fa-regular fa-arrow-right fa-fade fa-fw"></i> <strong>Sponsorizza</strong>. Da lì potrai scegliere uno dei tre tipi di sponsorizzazione sopra esposti e procedere al pagamento.
    </p>

    <p>Puoi acquistare più sponsorizzazioni per lo stesso appartamento e, una volta scaduta la sponsorizzazione precedentemente acquistata, la successiva si attiverà automaticamente. Le sponsorizzazioni successive verranno messe in coda.</p>

    <p class="sponsor py-3 text-secondary disclaimer text-center">
        <em>
            Terminato il periodo di sponsorizzazione, l’appartamento tornerà ad essere
            visualizzato normalmente. Potrai acquistare nuovamente il pacchetto promozionale quando vorrai.
        </em>
    </p>
</div>
@endsection