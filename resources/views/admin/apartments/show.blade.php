@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row row-cols-1 row-cols-md-2">
        <div class="col">
            <div class="card text-left">
                @if ($apartment->image)
                @foreach($apartment->image as $image)
                <img class="img-fluid" style="height: 100px; width:160px; object-fit:cover;" src=" {{ asset('storage/' . $image) }}">
                @endforeach

                @else
                <img class="img-fluid" src=" {{ asset('storage/' . 'uploads/placeholder.png') }}">

                @endif
            </div>
        </div>
        <div class="col">
            <div class="card p-3">
                <h1 class="text-center">{{ $apartment->title }}</h1>
                <ul class="list-unstyled">
                    <li class="py-2"><strong>Caratteristiche appartamento</strong></li>
                    <li><strong>Stanze:</strong> {{$apartment->rooms}}</li>
                    <li><strong>Bagni:</strong> {{$apartment->bathrooms}}</li>
                    <li><strong>Letti:</strong> {{$apartment->beds}}</li>
                    <li><strong>Metri quadrati:</strong> {{$apartment->square_meters}}</li>
                    <li><strong>Indirizzo:</strong> {{$apartment->address}}</li>
                    </ul>
                    <div class="mt-4 d-flex justify-content-end align-items-center flex-wrap gap-3">
                        <a class="btn-2 text-decoration-none" href="{{ route('admin.apartments.index') }}" role="button">Indietro</a>
                        <a name="sponsor" id="sponsor" class="btn-1 btn-1-blue text-decoration-none" href="{{route('admin.sponsors.show', $apartment->slug)}}" role="button">Sponsorizza</a>
                    </div>
                
            </div>
        </div>

    </div>

</div>
@endsection