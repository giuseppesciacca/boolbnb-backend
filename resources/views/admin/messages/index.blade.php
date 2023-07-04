@extends('layouts.admin')

@section('content')

<h1 class="text-center my-3">I MIEI MESSAGGI - INDEX</h1>
@include('admin.partials.session_message')

<div class="container-fluid bg-light py-3">

    <table class="table table-striped m-0 py-5">
        <thead>
            <tr>
                <th scope="col">Appartamento</th>
                <th scope="col">Nome</th>
                <th scope="col">Cognome</th>
                <th scope="col">Email</th>
                <th scope="col">Corpo messaggio</th>
                <th scope="col">Ricevuto</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>


        <tbody>

            @forelse ($messages as $index => $message)
            <tr>
                <td> {{ $message->title }} </td>
                <td scope="row">{{ $message->name }}</td>
                <td>{{ $message->surname }}</td>
                <td>{{ $message->email }}</td>
                <td>{{ $message->message }}</td>
                <td>{{ $message->created_at }}</td>

                <td>
                    <a href="{{ route('admin.messages.show', $message->alias_message_id, $message->user_id) }}"><i class="fa-solid fa-eye"></i></a>

                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#modalId-{{ $message->alias_message_id }}">
                        <i class="fa-solid fa-trash-can" style="color: #dc3545"></i>
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
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <form action="{{ route('admin.messages.destroy', $message->alias_message_id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Confirm</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Optional: Place to the bottom of scripts -->
                    <script>
                        const myModal = new bootstrap.Modal(document.getElementById('{{ $message->id }}'), options)
                    </script>
                </td>
            </tr>

            @empty
            <p>No messages yet</p>
        </tbody>
        @endforelse

    </table>


    @endsection