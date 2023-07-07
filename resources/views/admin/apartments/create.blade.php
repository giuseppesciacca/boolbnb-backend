@extends('layouts.admin')

@section('script')
@vite(['resources/js/apartment.js'])
@endsection

@section('content')
<div class="bg-light py-3">

    <div class="container">
        @include('admin.partials.validation_errors')
        <h5 class="text-uppercase text-muted my-4">Add a new Apartment</h5>

        <form id="custom-form" action="{{ route('admin.apartments.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Title
                    <!-- (*) -->
                </label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Apartment title here " aria-describedby="nameHelper" required>
                <span id="span-title" class="d-none bg-danger text-dark" role="alert">
                    <strong>Il titolo non è valido</strong>
                </span>

                @error('title')
                <div class="alert alert-danger" role="alert">
                    <strong>Errore: </strong>{{ $message }}
                </div>
                @enderror

            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image[]" id="image" class="form-control @error('image') is-invalid @enderror" placeholder="Apartment image here " aria-describedby="imageHelper" accept="image/*" multiple>
                <span id="span-image" class="d-none bg-danger text-dark" role="alert">
                    <strong>Il file caricato non è valido</strong>
                </span>
                @error('image')
                <div class="alert alert-danger" role="alert">
                    <strong>Errore: </strong>{{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea cols="30" rows="5" name="description" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="Apartment description here " aria-describedby="nameHelper"></textarea>
                <span id="span-description" class="d-none bg-danger text-dark" role="alert">
                    <strong>La descrizione inserita non è valida</strong>
                </span>

                @error('description')
                <div class="alert alert-danger" role="alert">
                    <strong>Errore: </strong>{{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="rooms" class="form-label">rooms</label>
                <input type="number" name="rooms" id="rooms" class="form-control @error('rooms') is-invalid @enderror" placeholder="N. Apartment rooms here " aria-describedby="imageHelper" min="1" max="50" step="1">
                <span id="span-rooms" class="d-none bg-danger text-dark" role="alert">
                    <strong>Il numero delle camere non è valido</strong>
                </span>

                @error('rooms')
                <div class="alert alert-danger" role="alert">
                    <strong>Errore: </strong>{{ $message }}
                </div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="bathrooms" class="form-label">bathrooms</label>
                <input type="number" name="bathrooms" id="bathrooms" class="form-control @error('bathrooms') is-invalid @enderror" placeholder="N. bathrooms here " aria-describedby="imageHelper" min="1" max="25" step="1">
                <span id="span-bathrooms" class="d-none bg-danger text-dark" role="alert">
                    <strong>Il numero dei bagni non è valido</strong>
                </span>

                @error('bathrooms')
                <div class="alert alert-danger" role="alert">
                    <strong>Errore: </strong>{{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="beds" class="form-label">beds</label>
                <input type="number" name="beds" id="beds" class="form-control @error('beds') is-invalid @enderror" placeholder="N. beds here " aria-describedby="imageHelper" min="1" max="25" step="1">
                <span id="span-beds" class="d-none bg-danger text-dark" role="alert">
                    <strong>Il numero dei letti non è valido</strong>
                </span>

                @error('beds')
                <div class="alert alert-danger" role="alert">
                    <strong>Errore: </strong>{{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="square_meters" class="form-label">square_meters</label>
                <input type="number" name="square_meters" id="square_meters" class="form-control @error('square_meters') is-invalid @enderror" placeholder="N. square_meters here " aria-describedby="imageHelper" min="1" max="9999" step="1">
                <span id="span-square_meters" class="d-none bg-danger text-dark" role="alert">
                    <strong>Il numero dei metri quadrati non è valido</strong>
                </span>
                <small>MQ</small>

                @error('square_meters')
                <div class="alert alert-danger" role="alert">
                    <strong>Errore: </strong>{{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">address
                    <!-- (*) -->
                </label>
                <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="Apartment address here " aria-describedby="nameHelper" required>
                <span id="span-address" class="d-none bg-danger text-dark" role="alert">
                    <strong>L'indirizzo inserito non è valido</strong>
                </span>
                <small>complete address here</small>

                @error('address')
                <div class="alert alert-danger" role="alert">
                    <strong>Errore: </strong>{{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-check d-flex row row-cols-4 mb-3 ps-2">
                @foreach($services as $service)
                <label class="form-check-label" for="{{ $service->name }}">
                    <input name="services[]" class="form-check-input" type="checkbox" value="{{ $service->id }}" id="{{ $service->name }}" {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}>
                    {{ $service->name }}
                </label>
                @endforeach
            </div>

            <div>
                <label>
                    <input type="radio" name="visibility" id="visibility" value="1">Visible</label>
                <label>
                    <input type="radio" name="visibility" id="visibility" value="0">Not visible</label>
            </div>{{-- controllare come passare valori diversi, nel db è sattato come tinyint non booleano(?) --}}
            <button type="submit" class="btn btn-primary w-100 my-4">Save</button>

            <p>
                <!--  -->
                <!-- (*) -> required! -->
            </p>

        </form>


    </div>
    @endsection