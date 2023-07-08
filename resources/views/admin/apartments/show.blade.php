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
                    <li> <a name="sponsor" id="sponsor" class="btn btn-warning" href="{{route('admin.sponsors.show', $apartment->slug)}}" role="button">Sponsorizzami</a></li>
                </ul>
            </div>
        </div>
        
    </div>
    <a class="btn btn-primary my-3" href="{{ route('admin.apartments.index') }}" role="button">Return</a>
</div>
@endsection