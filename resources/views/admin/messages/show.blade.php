@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card p-3">
                    <h1 class="text-center"></h1>
                    <ul class="list-unstyled">
                        <li class="py-2"><strong>Id appartamento</strong> {{$message->apartment_id}}</li>
                        <li><strong>nome</strong> {{$message->name}}</li>
                        <li><strong>cognome:</strong> {{$message->surname}}</li>
                        <li><strong>email:</strong> {{$message->email}}</li>
                        <li><strong>message:</strong> {{$message->message}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection