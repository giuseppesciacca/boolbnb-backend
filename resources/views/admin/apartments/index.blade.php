@extends('layouts.admin')

@section('content')

@include('admin.partials.session_message')

<div class="container-fluid py-3">

    <a href="{{route('admin.apartments.create')}}" class="text-decoration-none text-dark d-flex align-items-center gap-2 py-3">
        <i class="fa-solid fa-plus fa-2x"></i>
        <span class="add_apartment ms-3">Aggiungi</span>
    </a>
    <table class="table table-hover m-0 py-5">
        <thead>
            <tr class="apartment">
                <th scope="col">Nome</th>
                <th scope="col">Immagine</th>
                <th scope="col">Indirizzo</th>
                <th scope="col">Sponsor</th>
                <th scope="col">Visibile</th>
                <th class="text-center" scope="col">Azioni</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($apartments as $apartment)
            <tr class="apartment">
                <td class="action-td align-middle" scope="row" data-cell="Title:">{{$apartment->title}}</td>
                <td class="action-td align-middle" class="img">
                    @if ($apartment->image)
                    <img class="img-fluid" style="height: 100px; width:160px; object-fit:cover;" src=" {{ asset('storage/' . $apartment->image[0]) }}" alt="{{$apartment->slug}}">
                    @else
                    <img class="img-fluid" src=" {{ asset('storage/' . 'uploads/placeholder.png') }}">
                    @endif
                </td>
                <td class="action-td align-middle" data-cell="Indirizzo:">{{$apartment->address}}</td>
                <td class="action-td text-center align-middle" data-cell="Sponsor:"> @foreach($is_sponsored as $sponsored)
                    @if($apartment->title == $sponsored->title)
                    <i class="fa-solid fa-circle-check text-green"></i>
                    @endif
                    @endforeach
                </td>
                <td class="action-td align-middle" data-cell="Visibile:">
                    @if ($apartment->visibility)
                    <i class="fa-solid fa-circle-check text-green"></i>
                    @else
                    <i class="fa-solid fa-circle-xmark" style="color: #ff0000;"></i>
                    @endif
                </td>
                <td class="action-td text-center align-middle" data-cell="Azioni:">
                    <a class="btn-1 btn-1-blue" href="{{route('admin.apartments.show', $apartment->slug)}}"><i class="fa-solid fa-eye"></i></a>

                    <a class="btn-1 btn-1-orange" href="{{route('admin.apartments.edit', $apartment->slug)}}"><i class="fa-solid fa-pencil"></i></a>
                    <a type="button" class="btn-1" data-bs-toggle="modal" data-bs-target="#modalId-{{$apartment->id}}">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>


                    <!-- Modal -->
                    <div class="modal fade" id="modalId-{{$apartment->id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="dialog">
                            <div class="modal-content">
                                <div class="modal-header justify-content-center">
                                    <h1 class="modal-title fs-5 flex-grow-1" id="modalTitleId">{{$apartment->title}}</h1>
                                    <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="card-img-top mt-3">
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
                </td>
            </tr>

            @empty
            <p>Nessun appartamento caricato</p>
        </tbody>
        @endforelse

    </table>


    @endsection