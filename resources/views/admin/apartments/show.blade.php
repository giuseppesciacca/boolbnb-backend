@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row row-cols-1 row-cols-md-2 flex-column">
        <div class="col-12  w-100 mb-5">
            <div class="card text-left w-100 h-100">
                @if ($apartment->image)
                <img class=" img-fluid img_show rounded-3" src=" {{ asset('storage/' . $apartment->image[0]) }}">
                @foreach($apartment->image as $image)
                @endforeach

                @else
                <img class="img-fluid" src=" {{ asset('storage/' . 'uploads/placeholder.png') }}">

                @endif
            </div>
        </div>

    </div>
    <div class="row justify-content-center row-cols-1 row-cols-lg-2">
        <div class="col">
            <h1 class="card-title text-center text-uppercase">{{ $apartment->title }}</h1>
            <div class="primary-info d-flex flex-column py-3">
                <div class="d-flex justify-content-between mb-3 gap-2">
                    <div class="w-20">
                        <div class="d-flex align-items-baseline gap-1">
                            <i class="fa-solid fa-house me-1"></i>
                            <span class="fw-light"> Stanze </span>
                        </div>
                        <span class="badge w-100 btn-1 btn-1-blue align-bottom">{{ $apartment->rooms }}</span>
                    </div>

                    <div class="w-20">
                        <div class="d-flex align-items-baseline gap-1">
                            <i class="fa-solid fa-bed me-1"></i>
                            <span class="fw-light"> Letti </span>
                        </div>
                        <span class="badge w-100 btn-1 btn-1-blue align-bottom">{{ $apartment->beds }}</span>
                    </div>

                    <div class="w-20">
                        <div class="d-flex align-items-baseline gap-1">
                            <i class="fa-solid fa-toilet-paper"></i>
                            <span class="fw-light"> Bagni </span>
                        </div>
                        <span class="badge w-100 btn-1 btn-1-blue align-bottom">{{ $apartment->bathrooms }}</span>
                    </div>


                    <div class="w-20">
                        <div class="d-flex align-items-baseline gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-rulers" viewBox="0 0 16 16">
                                <path d="M1 0a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h5v-1H2v-1h4v-1H4v-1h2v-1H2v-1h4V9H4V8h2V7H2V6h4V2h1v4h1V4h1v2h1V2h1v4h1V4h1v2h1V2h1v4h1V1a1 1 0 0 0-1-1H1z" />
                            </svg>
                            <span class="fw-light"> &#13217; </span>
                        </div>
                        <span class="badge w-100 btn-1 btn-1-blue align-bottom">{{ $apartment->square_meters }}</span>
                    </div>
                </div>
                <h4>Indirizzo: {{ $apartment->address }}</h4>
                <p class="card-text m-0 mt-3">Descrizione appartamento:</p>
                <p class=" fw-light ">{{ $apartment->description }}</p>
                <div class="card-footer px-2">
                    Servizi:
                    <div class="d-flex gap-1 flex-wrap">
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="d-flex justify-content-end align-items-center flex-column flex-md-row flex-lg-column gap-3 py-5 mt_custom list_button">
                <a name="sponsor" id="sponsor" class="btn-1 btn-1-orange text-decoration-none w-50" href="{{route('admin.sponsors.show', $apartment->slug)}}" role="button">Sponsorizza</a>
                <a class=" btn-1 btn-1-gold text-decoration-none w-50" href="{{route('admin.apartments.edit', $apartment->slug)}}" role="button">Modifica</a>
                <a type="button" class=" btn-1 w-50" data-bs-toggle="modal" data-bs-target="#modalId-{{$apartment->id}}">
                    Cancella
                </a>
                <!-- Modal -->
                <div class="modal fade" id="modalId-{{$apartment->id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="modalTitleId">Cancella appartamento "{{$apartment->title}}"?</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="card-img-top mt-3 text-center">
                                @if ($apartment->image)
                                <img class="img-fluid" style="height: 300px; width:360px; object-fit:cover;" src=" {{ asset('storage/' . $apartment->image[0]) }}" alt="{{$apartment->slug}}">
                                @else
                                <img class="img-fluid" src=" {{ asset('storage/' . 'uploads/placeholder.png') }}">
                                @endif
                            </div>
                            <div class="modal-body">
                                Sei sicuro di eliminare questo appartamento?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn-2" data-bs-dismiss="modal">Chiudi</button>
                                <form action="{{route('admin.apartments.destroy', $apartment)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-1" type="submit">Conferma</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <a class=" btn-2 text-decoration-none w-50" href="{{ route('admin.apartments.index') }}" role="button">Indietro</a>
            </div>
        </div>
    </div>

</div>
@endsection