@extends('layouts.admin')

@section('content')

@include('admin.partials.session_message')

<div class="container-fluid py-3">

    <table class="table table-hover m-0 py-5">
        <thead>
            <tr class="message">
                <th scope="col">Appartamento</th>
                <th scope="col">Nome</th>
                <th scope="col">Cognome</th>
                <th scope="col">Email</th>
                <th scope="col">Corpo messaggio</th>
                <th scope="col">Ricevuto</th>
                <th scope="col">Azioni</th>
            </tr>
        </thead>


        <tbody>

            @forelse ($messages as $index => $message)
            <tr class="message">
                <td data-cell="Appartamento:"> {{ $message->title }} </td>
                <td scope="row" data-cell="Nome:">{{ $message->name }}</td>
                <td data-cell="Cognome:">{{ $message->surname }}</td>
                <td data-cell="Email:">{{ $message->email }}</td>
                <td data-cell="Corpo messaggio:">{{ $message->message }}</td>
                <td data-cell="Ricevuto:">{{ $message->date_message_sent }}</td>

                <td data-cell="Azioni:">
                    <a href="{{ route('admin.messages.show', $message->alias_message_id, $message->user_id) }}" class="btn-1 btn-1-blue w-75"><i class="fa-solid fa-eye"></i></a>

                    <button type="button" class="btn-1 w-75" data-bs-toggle="modal" data-bs-target="#modalId-{{ $message->alias_message_id }}">
                        <i class="fa-solid fa-trash-can text-white" style="color: #dc3545"></i>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modalId-{{ $message->alias_message_id }}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="modalTitleId">Delete "{{ $message->title }}"
                                        message?</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure to delete this message?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn-2" data-bs-dismiss="modal">Close</button>
                                    <form action="{{ route('admin.messages.destroy', $message->alias_message_id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-1" type="submit">Confirm</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>

            @empty
            <p>No messages yet</p>
        </tbody>
        @endforelse

    </table>


    @endsection