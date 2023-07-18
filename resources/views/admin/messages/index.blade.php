@extends('layouts.admin')

@section('content')

@include('admin.partials.session_message')

<div class="container-fluid py-3">

    <table class="table table-hover table-striped m-0 py-5">
        <thead>
            <tr class="message">
                <th scope="col">Appartamento</th>
                <th scope="col">Nome</th>
                <th scope="col">Cognome</th>
                <th scope="col">E-Mail</th>
                <th scope="col">Ricevuto il</th>
                <th class="text-center" scope="col">Azioni</th>
            </tr>
        </thead>


        <tbody>

            @forelse ($messages as $index => $message)
            <tr class="message">
                <td class="action-td align-middle" scope="row" data-cell="Appartamento:">{{ $message->title }}</td>
                <td class="action-td align-middle" scope="row" data-cell="Nome:">{{ $message->name }}</td>
                <td class="action-td align-middle" data-cell="Cognome:">{{ $message->surname }}</td>
                <td class="action-td align-middle" data-cell="Email:"><a href="mailto: {{ $message->email }}">{{ $message->email }}</a></td>
                <td class="action-td align-middle" data-cell="Ricevuto:">{{ $message->date_message_sent }}</td>

                <td class="action-td text-center align-middle" data-cell="Azioni:">
                    <a class="btn-1 btn-1-blue" href="{{ route('admin.messages.show', $message->alias_message_id, $message->user_id) }}"><i class="fa-solid fa-eye"></i></a>

                    <a type="button" class="btn-1" data-bs-toggle="modal" data-bs-target="#modalId-{{ $message->alias_message_id }}">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>

                    <!-- Modal -->
                    <div class="modal fade" id="modalId-{{ $message->alias_message_id }}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="dialog">
                            <div class="modal-content">
                                <div class="modal-header justify-content-center">
                                    <h1 class="modal-title fs-5 flex-grow-1" id="modalTitleId">Messaggio n. {{ $message->id }} per {{ $message->title }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="py-2">{{ $message->message }}</div>
                                    <div class="py-2 text-end text-secondary small-text">Inviato da {{ $message->name }}</div>
                                    <span>Sei sicuro di eliminare questo messaggio?</span>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn-2" data-bs-dismiss="modal">Chiudi</button>
                                    <form action="{{ route('admin.messages.destroy', $message->alias_message_id) }}" method="post">
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
            <p>Non hai ancora ricevuto alcun messaggio</p>
        </tbody>
        @endforelse

    </table>


    @endsection