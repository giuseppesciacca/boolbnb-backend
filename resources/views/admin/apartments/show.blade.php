@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row row-cols-1 row-cols-md-2 flex-column">
        <div class="col-12  w-100 mb-5">
            <div class="card text-left w-100 h-100">
                @if ($apartment->image)
                <img class=" img-fluid img_show rounded" src=" {{ asset('storage/' . $apartment->image[0]) }}">
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
            <h1 class="card-title text-center text-uppercase my-3 our-quote fs-2">{{ $apartment->title }}</h1>
            <div class="primary-info d-flex flex-column py-3">
                <div class="d-flex justify-content-between mb-3">
                    <div class="badge p-2 btn-1 me-3 d-flex justify-content-center align-items-center gap-2">
                        <i class="fa-solid fa-house fa-lg"></i>
                        <span class="align-bottom">{{ $apartment->rooms }}</span>
                        <span class="fw-light">Stanze</span>
                    </div>

                    <div class="badge p-2 btn-1 me-3 d-flex justify-content-center align-items-center gap-2">
                        <i class="fa-solid fa-bed fa-lg"></i>
                        <span class="align-bottom">{{ $apartment->beds }}</span>
                        <span class="fw-light">Letti</span>
                    </div>

                    <div class="badge p-2 btn-1 me-3 d-flex justify-content-center align-items-center gap-2">
                        <i class="fa-solid fa-toilet fa-lg"></i>
                        <span class="align-bottom">{{ $apartment->bathrooms }}</span>
                        <span class="fw-light">Bagni</span>
                    </div>


                    <div class="badge p-2 btn-1 me-3 d-flex justify-content-center align-items-center gap-2">
                        <i class="fa-solid fa-ruler fa-lg"></i>
                        <span class="align-bottom">{{ $apartment->square_meters }}</span>
                        <span class="fw-light">m²</span>
                    </div>
                </div>
                <span><span class="fw-semibold">€{{$apartment->price}}</span> <span class="fw-light">a notte</span></span>
                <h4 class="our-address d-flex justify-content-start align-items-center gap-2 mb-0 my-2 py-2">
                    <i class="fa-solid fa-map-location-dot fa-lg"></i>
                    <span>Indirizzo: {{ $apartment->address }}</span>
                </h4>
                <div class="mt-3">
                    <p class="card-text mb-1 fs-5">Descrizione:</p>
                    <p class="fw-light">{{ $apartment->description }}</p>
                </div>
                <div class="card-footer px-0">
                    <div class="d-flex gap-1 flex-wrap align-items-center">
                        @foreach($services as $service)
                        <div class="badge p-2 btn-1 btn-1-blue d-flex justify-content-center align-items-center gap-2">
                            <i class="{{$service->image}} fa-lg"></i>
                            <span class="fw-light">{{ $service->name }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="d-flex justify-content-end align-items-center flex-column flex-md-row flex-lg-column gap-3 py-5 mt_custom list_button">
                <a name="sponsor" id="sponsor" class="btn-1 btn-1-green text-decoration-none w-50" href="{{route('admin.sponsors.show', $apartment->slug)}}" role="button">Sponsorizza</a>
                <a class=" btn-1 btn-1-orange text-decoration-none w-50" href="{{route('admin.apartments.edit', $apartment->slug)}}" role="button">Modifica</a>
                <a type="button" class=" btn-1 w-50" data-bs-toggle="modal" data-bs-target="#modalId-{{$apartment->id}}">
                    Cancella
                </a>
                <!-- Modal -->
                <div class="modal fade" id="modalId-{{$apartment->id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="dialog">
                        <div class="modal-content">
                            <div class="modal-header justify-content-center">
                                <h1 class="modal-title fs-5 flex-grow-1 text-center" id="modalTitleId">{{$apartment->title}}</h1>
                                <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="card-img-top mt-3 text-center">
                                @if ($apartment->image)
                                <img class="img-fluid" style="height: 300px; width:360px; object-fit:cover;" src=" {{ asset('storage/' . $apartment->image[0]) }}" alt="{{$apartment->slug}}">
                                @else
                                <img class="img-fluid" src=" {{ asset('storage/' . 'uploads/placeholder.png') }}">
                                @endif
                            </div>
                            <div class="modal-body text-center">
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