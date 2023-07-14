@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('User Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
                <div class="card-footer d-flex justify-content-center my-5">
                    <ul class="list-unstyled w-100 h-100 d-flex justify-content-evenly align-items-center gap-5 text-center mb-0">
                        <li class="p-3 rounded-3 {{ Route::currentRouteName() === 'admin.apartments' ? 'bg-danger fst-italic fw-bolder' : 'bg-dark' }}">
                            <a class="text-light fw-bold text-decoration-none" href="{{ route('admin.apartments.create') }}">Aggiungi appartamento</a>
                        </li>
                        <li class="p-3 rounded-3 {{ str_starts_with(Route::currentRouteName(), 'admin.apartments') ? 'bg-danger fst-italic fw-bolder' : 'bg-dark' }}">
                            <a class="text-light fw-bold text-decoration-none" href="{{ route('admin.apartments.index') }}">Tutti gli appartamenti</a>
                        </li>
                        <li class="p-3 rounded-3 {{ str_starts_with(Route::currentRouteName(), 'admin.messages') ? 'bg-danger fst-italic fw-bolder' : 'bg-dark' }}">
                            <a class="text-light fw-bold text-decoration-none" href="{{ route('admin.messages.index') }}">Messaggi singoli appartamenti</a>
                        </li>
                        <li class="p-3 rounded-3 {{ str_starts_with(Route::currentRouteName(), 'admin.sponsors') ? 'bg-danger fst-italic fw-bolder' : 'bg-dark' }}">
                            <a class="text-light fw-bold text-decoration-none" href="{{ route('admin.sponsors.index') }}">Lista sponsor</a>
                        </li>
                        <!--                     <li class="p-3 rounded-3 mb-3 {{ str_starts_with(Route::currentRouteName(), 'admin.views') ? 'bg-danger fst-italic fw-bolder' : 'bg-dark' }}">
                                <a class="text-light fw-bold text-decoration-none" href="{{ route('admin.views.index') }}">Lista statistiche singolo appartamento</a>
                            </li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Nella view della dashboard ci sarà un bottone a link di create new apartment e un bottone a link di index apartment 
sotto pagina lista messaggi
pagina sponsorizzazione
pagina statistiche singolo appartamento-->