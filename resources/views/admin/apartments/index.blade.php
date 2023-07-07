@extends('layouts.admin')

@section('content')

<h1 class="text-center my-3">I MIEI APPARTMAMENTI</h1>
@include('admin.partials.session_message')

<div class="container-fluid bg-light py-3">

    <a href="{{route('admin.apartments.create')}}"><i class="fa-solid fa-plus fa-2x"></i></a>
    <table class="table table-striped m-0 py-5">
        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Preview image</th>
                <th scope="col">n_stanze</th>
                <th scope="col">n_bagni</th>
                <th scope="col">n_letti</th>
                <th scope="col">mq</th>
                <th scope="col">indirizzo</th>
                <th scope="col">servizi</th>
                <th scope="col">Visibile</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($apartments as $apartment)
            <tr>
                <td scope="row">{{$apartment->title}}</td>
                <td class="text-center">
                    @if ($apartment->image)
                    <img class="img-fluid" style="height: 100px; width:160px; object-fit:cover;" src=" {{ asset('storage/' . $apartment->image[0]) }}" alt="{{$apartment->slug}}">
                    @else
                    <img class="img-fluid" src=" {{ asset('storage/' . 'uploads/placeholder.png') }}">
                    @endif
                </td>
                <td>{{$apartment->rooms}}</td>
                <td>{{$apartment->bathrooms}}</td>
                <td>{{$apartment->beds}}</td>
                <td>{{$apartment->square_meters}}</td>
                <td>{{$apartment->address}}</td>
                {{-- roba da levare l'ho messa giusto per vedere che funziona --}}
                <td>
                    @foreach($apartment->services as $service)
                    <div class="label label-info">{{ $service->name }} </div>
                    @endforeach
                </td>
                <td>{{$apartment->visibility ? 'true' : 'false'}}</td>
                <td>
                    <a href="{{route('admin.apartments.show', $apartment->slug)}}"><i class="fa-solid fa-eye"></i></a>

                    <a href="{{route('admin.apartments.edit', $apartment->slug)}}"><i class="fa-solid fa-pencil"></i></a>
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#modalId-{{$apartment->id}}">
                        <i class="fa-solid fa-trash-can" style="color: #dc3545"></i>
                    </button>


                    <!-- Modal -->
                    <div class="modal fade" id="modalId-{{$apartment->id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="modalTitleId">Cancella appartamento "{{$apartment->title}}"?</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Sei sicuro di eliminare questo appartamento?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                                    <form action="{{route('admin.apartments.destroy', $apartment)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Conferma</button>
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