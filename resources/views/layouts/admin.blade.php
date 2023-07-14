<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Boolbnb</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Grape+Nuts&family=Lato:wght@100;400&family=Manrope:wght@300;600&family=Odibee+Sans&display=swap" rel="stylesheet">
    <!-- TOMTOM -->
    <link rel="stylesheet" type="text/css" href="https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.3-public-preview.0/SearchBox.css" />
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.3-public-preview.0/SearchBox-web.js"></script>
    <script src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.1.2-public-preview.15/services/services-web.min.js"></script>
    <!-- BRAINTREE -->
    <!-- <script src="https://js.braintreegateway.com/web/dropin/1.38.1/js/dropin.min.js"></script> -->
    @vite(['resources/js/braintree.js'])
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link d-flex justify-content-center" href="http://localhost:5174/">
                                <img class="animated-img" src="{{asset('logo.png')}}" alt="Boolbnb" height="50px">
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav gap-md-5">
                        <li class="nav-item d-flex justify-content-center">
                            <a class="animated-span" href="http://localhost:5174/apartments" class="nav-link">{{ __('Appartamenti') }}</a>
                        </li>
                        <li class="nav-item d-flex justify-content-center">
                            <a class="animated-span" href="http://localhost:5174/about" class="nav-link">{{ __('Chi siamo') }}</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown d-flex justify-content-center">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <span class="animated-span"><i class="fa-solid fa-circle-user fa-lg"></i> {{ Auth::user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item animated-span letter-span" href="{{ route('admin.dashboard') }}">{{__('Dashboard')}}</a>
                                <!-- <a class="dropdown-item" href="{{ url('profile') }}">{{__('Profile')}}</a> -->
                                <a class="dropdown-item animated-span letter-span" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main id="main-admin" class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-2">
                        <ul class="list-unstyled">
                            <li class="p-3 rounded-3 mb-3 {{ Route::currentRouteName() === 'admin.dashboard' ? 'bg-danger fst-italic fw-bolder' : 'bg-dark' }}">
                                <a class="text-light fw-bold text-decoration-none" href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="p-3 rounded-3 mb-3 {{ str_starts_with(Route::currentRouteName(), 'admin.apartments') ? 'bg-danger fst-italic fw-bolder' : 'bg-dark' }}">
                                <a class="text-light fw-bold text-decoration-none" href="{{ route('admin.apartments.index') }}">Appartamenti</a>
                            </li>
                            <li class="p-3 rounded-3 mb-3 {{ str_starts_with(Route::currentRouteName(), 'admin.messages') ? 'bg-danger fst-italic fw-bolder' : 'bg-dark' }}">
                                <a class="text-light fw-bold text-decoration-none" href="{{ route('admin.messages.index') }}">Inbox</a>
                            </li>
                            <li class="p-3 rounded-3 mb-3 {{ str_starts_with(Route::currentRouteName(), 'admin.sponsors') ? 'bg-danger fst-italic fw-bolder' : 'bg-dark' }}">
                                <a class="text-light fw-bold text-decoration-none" href="{{ route('admin.sponsors.index') }}">Sponsorship</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-10">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
        @include('admin.partials.app_footer')
    </div>
    @yield('script')
</body>

</html>