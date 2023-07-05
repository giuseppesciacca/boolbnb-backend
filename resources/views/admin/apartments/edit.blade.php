@extends('layouts.admin')

@section('content')

<div class="bg-light py-3">

    <div class="container">
        @include('admin.partials.validation_errors')
        <h5 class="text-uppercase text-muted my-4">Add a new Apartment</h5>

        <form action="{{route('admin.apartments.update', $apartment)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Nome Casa <!-- (*) --></label>
                <input value="{{ old('name', $apartment->title) }} " type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="esempio Villa Francesca" aria-describedby="nameHelper" required>

                @error('title')
                <div class="alert alert-danger" role="alert">
                    <strong>Errore: </strong>{{$message}}
                </div>
                @enderror

            </div>

            <div class="mb-3">
                <label for="image" class="form-label pb-3">Immagine</label>
                <br>

                @if ($apartment->image)
                @foreach($apartment->image as $image)
                <img class="img-fluid" style="height: 75px; width:75px; object-fit:cover;" src=" {{ asset('storage/' . $image) }}">
                @endforeach

                @else
                <p>Nessuna immagine precedentemente caricata</p>
                @endif

                <input type="file" name="image[]" id="image" class="mt-3 form-control @error('image') is-invalid @enderror" placeholder="Apartment image here " aria-describedby="imageHelper" accept="image/*" multiple>

                @error('image')
                <div class="alert alert-danger" role="alert">
                    <strong>Errore: </strong>{{$message}}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea cols="30" rows="5" name="description" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="Apartment description here " aria-describedby="nameHelper">{{ old('description', $apartment->description) }} </textarea>

                @error('description')
                <div class="alert alert-danger" role="alert">
                    <strong>Errore: </strong>{{$message}}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="rooms" class="form-label">Stanze</label>
                <input type="number" name="rooms" id="rooms" class="form-control @error('rooms') is-invalid @enderror" placeholder="N. Apartment rooms here " aria-describedby="imageHelper" value="{{ old('rooms', $apartment->rooms) }}" min="1" max="50" step="1">

                @error('rooms')
                <div class="alert alert-danger" role="alert">
                    <strong>Errore: </strong>{{$message}}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="bathrooms" class="form-label">Bagni</label>
                <input type="number" name="bathrooms" id="bathrooms" class="form-control @error('bathrooms') is-invalid @enderror" placeholder="N. bathrooms here " aria-describedby="imageHelper" value="{{ old('bathrooms', $apartment->bathrooms) }}" min="1" max="25" step="1">

                @error('bathrooms')
                <div class="alert alert-danger" role="alert">
                    <strong>Errore: </strong>{{$message}}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="beds" class="form-label">Posti Letto</label>
                <input type="number" name="beds" id="beds" class="form-control @error('beds') is-invalid @enderror" placeholder="N. beds here " aria-describedby="imageHelper" value="{{ old('beds', $apartment->beds) }}" min="1" max="25" step="1">

                @error('beds')
                <div class="alert alert-danger" role="alert">
                    <strong>Errore: </strong>{{$message}}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="square_meters" class="form-label">Metri Quadrati</label>
                <input type="number" name="square_meters" id="square_meters" class="form-control @error('square_meters') is-invalid @enderror" placeholder="N. square_meters here " aria-describedby="imageHelper" value="{{ old('square_meters', $apartment->square_meters)}}" min="1" max="9999" step="1">
                <small>MQ</small>

                @error('square_meters')
                <div class="alert alert-danger" role="alert">
                    <strong>Errore: </strong>{{$message}}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Indirizzo</label>
                <input value="{{ old('address', $apartment->address) }} " type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="Apartment address here " aria-describedby="nameHelper" required>
                <small>complete address here</small>
                @error('address')
                <div class="alert alert-danger" role="alert">
                    <strong>Errore: </strong>{{$message}}
                </div>
                @enderror
            </div>

            <p>Cambia i servizi</p>
            <div class='form-check d-flex row row-cols-4 mb-3 ps-2'>
                @foreach ($services as $service)
                <div class="form-check @error('services') is-invalid @enderror">
                    <label class='form-check-label'>
                        @if($errors->any())
                        <input name="services[]" type="checkbox" value="{{ $service->id }}" class="form-check-input" {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}>
                        @else
                        <input name='services[]' type='checkbox' value='{{ $service->id }}' class='form-check-input' {{ $apartment->services->contains($service) ? 'checked' : '' }}>
                        @endif
                        {{ $service->name }}
                    </label>
                </div>
                @endforeach
                @error('services')
                <div class='invalid-feedback'>{{ $message}}</div>
                @enderror
            </div>

            <div>
                <label>
                    <input type="radio" name="visibility" id="visibility" value="1" {{ old('visibility', $apartment->visibility) === 1 ? 'checked' : '' }}>Visible
                </label>
                <label>
                    <input type="radio" name="visibility" id="visibility" value="0" {{ old('visibility', $apartment->visibility) === 0 ? 'checked' : '' }}>Non visibile
                </label>
                <button type="submit" class="btn btn-primary w-100 my-4">Salva</button>
            </div>
        </form>
    </div>

    @endsection