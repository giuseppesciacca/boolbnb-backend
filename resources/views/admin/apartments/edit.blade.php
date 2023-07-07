@extends('layouts.admin')

@section('script')
@vite(['resources/js/apartment.js'])
@endsection

@section('content')

<div class="container">
    @include('admin.partials.validation_errors')
    <h5 class="text-uppercase text-muted pb-3">Modifica il tuo appartamento</h5>

    <form id="custom-form" action="{{route('admin.apartments.update', $apartment)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Titolo (*)</label>

            <input value="{{ old('name', $apartment->title) }} " type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Titolo dell'appartamento" aria-describedby="nameHelper" required>
            <small>Massimo 255 caratteri</small>

            <span id="span-title" class="d-none bg-danger text-dark" role="alert">
                <strong>Il titolo non è valido</strong>
            </span>

            @error('title')
            <div class="alert alert-danger" role="alert">
                <strong>Errore: </strong>{{$message}}
            </div>
            @enderror
        </div>
        <!-- /title -->

        <div class="mb-3">
            <label for="image" class="form-label">Immagine</label>
            <br>

            @if ($apartment->image)
            @foreach($apartment->image as $image)
            <img class="img-fluid" style="height: 75px; width:75px; object-fit:cover;" src=" {{ asset('storage/' . $image) }}">
            @endforeach

            @else
            <p>Nessuna immagine precedentemente caricata</p>
            @endif

            <input type="file" name="image[]" id="image" class="mt-3 form-control @error('image') is-invalid @enderror" placeholder="Inserisci la foto dell'appartamento" aria-describedby="imageHelper" accept="image/*" multiple>
            <small>Puoi inserire più immagini dei seguenti formati: JPG, JPEG, PNG, BMP.</small>

            <span id="span-image" class="d-none bg-danger text-dark" role="alert">
                <strong>Il file caricato non è valido</strong>
            </span>

            @error('image')
            <div class="alert alert-danger" role="alert">
                <strong>Errore: </strong>{{$message}}
            </div>
            @enderror
        </div>
        <!-- /image -->

        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>

            <textarea cols="30" rows="5" name="description" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="Descrizione dell'appartamento" aria-describedby="nameHelper">{{ old('description', $apartment->description) }} </textarea>
            <span id="span-description" class="d-none bg-danger text-dark" role="alert">
                <strong>La descrizione inserita non è valida</strong>
            </span>

            @error('description')
            <div class="alert alert-danger" role="alert">
                <strong>Errore: </strong>{{$message}}
            </div>
            @enderror
        </div>
        <!-- /description -->

        <div class="mb-3">
            <label for="rooms" class="form-label">Numero stanze (*)</label>

            <input type="number" name="rooms" id="rooms" class="form-control @error('rooms') is-invalid @enderror" placeholder="Inserire numero stanze" aria-describedby="imageHelper" value="{{ old('rooms', $apartment->rooms) }}" min="1" max="50" step="1">
            <span id="span-rooms" class="d-none bg-danger text-dark" role="alert">
                <strong>Il numero delle camere non è valido</strong>
            </span>

            @error('rooms')
            <div class="alert alert-danger" role="alert">
                <strong>Errore: </strong>{{$message}}
            </div>
            @enderror
        </div>
        <!-- /n_stanze -->

        <div class="mb-3">
            <label for="bathrooms" class="form-label">Numero bagni (*)</label>

            <input type="number" name="bathrooms" id="bathrooms" class="form-control @error('bathrooms') is-invalid @enderror" placeholder="Inserire numero bagni" aria-describedby="imageHelper" value="{{ old('bathrooms', $apartment->bathrooms) }}" min="1" max="25" step="1">
            <span id="span-bathrooms" class="d-none bg-danger text-dark" role="alert">
                <strong>Il numero dei bagni non è valido</strong>
            </span>

            @error('bathrooms')
            <div class="alert alert-danger" role="alert">
                <strong>Errore: </strong>{{$message}}
            </div>
            @enderror
        </div>
        <!-- /n_bagni -->

        <div class="mb-3">
            <label for="beds" class="form-label">Numero posti letto (*)</label>

            <input type="number" name="beds" id="beds" class="form-control @error('beds') is-invalid @enderror" placeholder="Numero posti letto" aria-describedby="imageHelper" value="{{ old('beds', $apartment->beds) }}" min="1" max="25" step="1">
            <span id="span-beds" class="d-none bg-danger text-dark" role="alert">
                <strong>Il numero dei letti non è valido</strong>
            </span>

            @error('beds')
            <div class="alert alert-danger" role="alert">
                <strong>Errore: </strong>{{$message}}
            </div>
            @enderror
        </div>
        <!-- n_letti -->

        <div class="mb-3">
            <label for="square_meters" class="form-label">Metri quadri dell'appartamento (*)</label>

            <input type="number" name="square_meters" id="square_meters" class="form-control @error('square_meters') is-invalid @enderror" placeholder="Metri quadri dell'appartamento" aria-describedby="imageHelper" value="{{ old('square_meters', $apartment->square_meters)}}" min="1" max="9999" step="1">
            <span id="span-square_meters" class="d-none bg-danger text-dark" role="alert">
                <strong>Il numero dei metri quadrati non è valido</strong>
            </span>
            <small>Minimo 30 mq</small>

            @error('square_meters')
            <div class="alert alert-danger" role="alert">
                <strong>Errore: </strong>{{$message}}
            </div>
            @enderror
        </div>
        <!-- /mq -->

        <!-- 
        <div class="mb-3">
            <label for="address" class="form-label">Indirizzo</label>
            <input value="{{ old('address', $apartment->address) }} " type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="Apartment address here " aria-describedby="nameHelper" required>
            <span id="span-address" class="d-none bg-danger text-dark" role="alert">
                <strong>L'indirizzo inserito non è valido</strong>
            </span>
            <small>complete address here</small>

            @error('address')
            <div class="alert alert-danger" role="alert">
                <strong>Errore: </strong>{{$message}}
            </div>
            @enderror
        </div> -->

        <div class="mb-3">
            <label for="address" class="form-label m-0">Indirizzo completo (*)</label>

            <div id="search_container">
                <!-- qui si appende la searchBoxHTML di TomTom -->
            </div>
            <small>Inserire Via e numero civico, CAP, Comune</small>

            <span id="span-address" class="d-none bg-danger text-dark" role="alert">
                <strong>L'indirizzo inserito non è valido</strong>
            </span>

            @error('address')
            <div class="alert alert-danger" role="alert">
                <strong>Errore: </strong>{{ $message }}
            </div>
            @enderror

            <script>
                const options = {
                    searchOptions: {
                        key: "vPuUkOEvt9S93r8E98XRbrHJJG1Mz6Tr",
                        language: "it-IT",
                        limit: 5,
                        typeahead: true, //If the typeahead flag is set, the query will be interpreted as a partial input, and the search will enter predictive mode.
                        countrySet: 'IT',
                        idxSet: 'Str', //cerca indirizzi
                    },
                    autocompleteOptions: {
                        key: "vPuUkOEvt9S93r8E98XRbrHJJG1Mz6Tr",
                        language: "it-IT",
                    },
                }

                const searchContainer = document.getElementById('search_container');

                const ttSearchBox = new tt.plugins.SearchBox(tt.services, options);
                const searchBoxHTML = ttSearchBox.getSearchBoxHTML();

                searchContainer.append(searchBoxHTML);

                /* prendo l'input del tomtom */
                const inputAddress = document.querySelector('.tt-search-box-input');
                inputAddress.setAttribute("id", "address") //aggiungo id="address"
                inputAddress.setAttribute("name", "address") //aggiungo name="address"
                inputAddress.setAttribute("placeholder", "Inserire indirizzo qui") //aggiungo placeholder
                inputAddress.setAttribute("value", "{{ old('address', $apartment->address) }} ") //aggiungo vecchio indirizzo
                inputAddress.setAttribute("required", ""); //aggiungo required
            </script>

        </div>
        <!-- /indirizzo -->

        <div class="mb-3">
            <label for="services" class="form-label">Cambia i servizi</label>
            <div class="form-check row row-cols-4 d-flex">
                @foreach ($services as $service)
                <div class="form-check @error('services') is-invalid @enderror">
                    <label class='form-check-label'>
                        @if($errors->any())
                        <input name="services[]" type="checkbox" value="{{ $service->id }}" class="multi-check-box form-check-input" {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}>
                        @else
                        <input name='services[]' type='checkbox' value='{{ $service->id }}' class='multi-check-box form-check-input' {{ $apartment->services->contains($service) ? 'checked' : '' }}>
                        @endif
                        {{ $service->name }}
                    </label>
                </div>
                @endforeach
                <span id="span-multi-check-box" class="d-none bg-danger text-dark" role="alert">
                    <strong>Selezionare almeno un servizio da includere</strong>
                </span>
                @error('services')
                <div class='invalid-feedback'>{{ $message}}</div>
                @enderror
            </div>
        </div>
        <!-- /servizi -->

        <div class="mb-3">
            <label for="visibility" class="form-label">Rendi visibile l'appartmento?</label>
            <br>

            <input type="radio" name="visibility" id="visibility" value="1" {{ old('visibility', $apartment->visibility) === 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="visibility">Si, rendilo visibile</label>

            <input type="radio" name="visibility" id="visibility" value="0" {{ old('visibility', $apartment->visibility) === 0 ? 'checked' : '' }}>
            <label class="form-check-label" for="visibility">No, non renderlo visibile</label>

            <br>
            <small>Di default è settato su "visibile"</small>
        </div>
        <!-- /visibile -->

        <button type="submit" class="btn btn-primary w-100 my-4">Salva modifiche</button>
    </form>
</div>

@endsection