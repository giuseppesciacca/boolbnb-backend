@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Dashboard') }}
    </h2>
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
                <div class="card-footer">
                    <ul class="list-unstyled w-50">
                            <li class="p-3 rounded-3 mb-3 {{ Route::currentRouteName() === 'admin.apartments' ? 'bg-danger fst-italic fw-bolder' : 'bg-dark' }}">
                                <a class="text-light fw-bold text-decoration-none" href="{{ route('admin.apartments.create') }}">aggiungi appartamento</a>
                            </li>
                            <li class="p-3 rounded-3 mb-3 {{ str_starts_with(Route::currentRouteName(), 'admin.apartments') ? 'bg-danger fst-italic fw-bolder' : 'bg-dark' }}">
                                <a class="text-light fw-bold text-decoration-none" href="{{ route('admin.apartments.index') }}">tutti gli appartamenti</a>
                            </li>
                            <li class="p-3 rounded-3 mb-3 {{ str_starts_with(Route::currentRouteName(), 'admin.messages') ? 'bg-danger fst-italic fw-bolder' : 'bg-dark' }}">
                                <a class="text-light fw-bold text-decoration-none" href="{{ route('admin.messages.index') }}">messaggi singoli appartamenti</a>
                            </li>
                            <li class="p-3 rounded-3 mb-3 {{ str_starts_with(Route::currentRouteName(), 'admin.sponsors') ? 'bg-danger fst-italic fw-bolder' : 'bg-dark' }}">
                                <a class="text-light fw-bold text-decoration-none" href="{{ route('admin.sponsors.index') }}">lista sponsor</a>
                            </li>
                            <li class="p-3 rounded-3 mb-3 {{ str_starts_with(Route::currentRouteName(), 'admin.views') ? 'bg-danger fst-italic fw-bolder' : 'bg-dark' }}">
                                <a class="text-light fw-bold text-decoration-none" href="{{ route('admin.views.index') }}">lista statistiche singolo appartamento</a>
                            </li>
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
