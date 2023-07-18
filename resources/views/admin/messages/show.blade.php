@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row row-cols-1 row-cols-md-2">
        <div class="col order-1 order-md-0">
            <div class="p-3 d-flex flex-column justify-content-between gap-5">
                <h2 class="mb-0 d-flex align-items-center gap-1">
                    <i class="fa-duotone fa-envelope-open-text fa-lg"></i>
                    <i class="fa-duotone fa-hashtag fa-2xs"></i>
                    <i class="fa-solid fa-{{$message->id}}"></i>
                </h2>
                <ul class="list-unstyled d-flex flex-column justify-content-center align-items-start gap-3 control-icon-list">
                    <li class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-paper-plane-top fa-lg"></i>
                        <span class="text-uppercase fw-light">Mittente:</span>
                        <span>{{$message->name}} {{$message->surname}}</span>
                    </li>
                    <li class="d-flex align-items-center gap-2">
                    <i class="fa-duotone fa-house-building fa-lg"></i>
                        <span class="text-uppercase fw-light">Per:</span>
                        <span>{{$apartment->title}}</span>
                    </li>
                    <li class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-at fa-lg"></i>
                        <span class="text-uppercase fw-light">E-Mail:</span>
                        <span><a href="mailto: {{ $message->email }}">{{ $message->email }}</a></span>
                    </li>
                    <li class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-clock-two fa-lg"></i>
                        <span class="text-uppercase fw-light">Ricevuto il:</span>
                        <span>{{$message->created_at}}</span>
                    </li>
                    <li class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-paperclip fa-lg"></i>
                        <span class="text-uppercase fw-light">Testo:</span>
                    </li>
                    <li class="card rounded shadow p-3 fw-light">{{ $message->message }}</li>
                </ul>
            </div>
            <div class="d-flex justify-content-end align-items-center gap-2">
                <a class="btn-2" href="{{ route('admin.messages.index') }}" role="button">Indietro</a>
                <a type="button" class="btn-1" data-bs-toggle="modal" data-bs-target="#modalId-{{ $message->id }}">Cancella</a>
            </div>
            <div class="modal fade" id="modalId-{{$message->id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                <div class="modal-dialog" role="dialog">
                    <div class="modal-content">
                        <div class="modal-header justify-content-center">
                            <h1 class="modal-title fs-5 flex-grow-1" id="modalTitleId">Messaggio n. {{ $message->id }} per {{$apartment->title}}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="py-2">{{ $message->message }}</div>
                            <div class="py-2 text-end text-secondary small-text">Inviato da {{ $message->name }}</div>
                            <span>Sei sicuro di eliminare questo messaggio?</span>
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
        </div>
        <div class="col order-0 order-md-1 mb-2 p-3">
            @if ($apartment->image)
            <img class="img-fluid rounded-3 show_image" src=" {{ asset('storage/' . $apartment->image[0]) }}">
            @else
            <img class="img-fluid" src=" {{ asset('storage/' . 'uploads/placeholder.png') }}">
            @endif
        </div>
    </div>
</div>
@endsection