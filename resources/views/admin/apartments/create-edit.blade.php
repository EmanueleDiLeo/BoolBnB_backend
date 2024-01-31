@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="text-center w-100 text-title mb-3">{{ $title }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ $route }}" method="POST" class="my-5" enctype='multipart/form-data'>
            @csrf
            @method($method)

            {{-- appartment name------------------------------------------ --}}
            <div id="title-div" class="mb-3">
                <label for="title" class="form-label">Nome Appartamento*</label>
                <input type="text" class="form-control" id="title"
                    name="title" value="{{ old('title', $apartment?->title) }}" autocomplete="title" required autofocus minlength="2">
                <div id="title-error" class="text-danger invalid-feedback">questo campo è obbligatorio</div>
                <div id="title-lengthError" class="text-danger invalid-feedback">scrivi almeno 2 caratteri</div>
            </div>

            @error('title')
                <p class="text-danger">Il nome è un campo obbligatorio</p>
            @enderror
            {{-- /appartment name------------------------------------------ --}}

            {{-- room number section--------------------------------------- --}}
            <div id="room_number-div" class="mb-3">
                <label for="room_number" class="form-label">Numero stanze*</label>
                <input type="number" class="@error('room_number') is-invalid @enderror form-control" id="room_number"
                    name="room_number" value="{{ old('room_number', $apartment?->room_number) }}" required min="1">
                <div id="room_number-error" class="invalid-feedback">questo campo è obbligatorio</div>
                <div id="room_number-validationError" class="text-danger invalid-feedback">non può contenere numeri negativi o lettere</div>
            </div>

            @error('room_number')
                <p class="text-danger">Il numero delle stanze è un campo obbligatorio</p>
            @enderror
            {{-- /room number section--------------------------------------- --}}

            {{-- /bed number section--------------------------------------- --}}
            <div id="bed_number-div" class="mb-3">
                <label for="bed_number" class="form-label">Posti letto*</label>
                <input type="number" class="@error('bed_number') is-invalid @enderror form-control" id="bed_number"
                    name="bed_number" value="{{ old('bed_number', $apartment?->bed_number) }}" required min="1" pattern="[0-9]+">
                <div id="bed_number-error" class="invalid-feedback">questo campo è obbligatorio</div>
                <div id="bed_number-validationError" class="text-danger invalid-feedback">non può contenere numeri negativi o lettere</div>
            </div>

            @error('bed_number')
                <p class="text-danger">Il numero dei posti letto è un campo obbligatorio</p>
            @enderror
            {{-- /bed number section--------------------------------------- --}}

            {{-- bathroom number section--------------------------------------- --}}
            <div id="bathroom_number-div" class="mb-3">
                <label for="bathroom_number" class="form-label">Numero bagni*</label>
                <input type="number" class="@error('bathroom_number') is-invalid @enderror form-control"
                    id="bathroom_number" name="bathroom_number"
                    value="{{ old('bathroom_number', $apartment?->bathroom_number) }}" required min="1">
                <div id="bathroom_number-error" class=" invalid-feedback">questo campo è obbligatorio</div>
                <div id="bathroom_number-validationError" class="text-danger invalid-feedback">non può contenere numeri negativi o lettere</div>
            </div>

            @error('bathroom_number')
                <p class="text-danger"> Il numero dei bagni è un campo obbligatorio</p>
            @enderror
            {{-- /bathroom number section--------------------------------------- --}}

            {{-- sq metres section--------------------------------------- --}}
            <div id="sq_metres-div" class="mb-3">
                <label for="sq_metres" class="form-label">Metri quadrati*</label>
                <input type="number" class="@error('sq_metres') is-invalid @enderror form-control" id="sq_metres"
                    name="sq_metres" value="{{ old('sq_metres', $apartment?->sq_metres) }}" required min="9">
                <div id="sq_metres-error" class=" invalid-feedback">questo campo è obbligatorio</div>
                <div id="sq_metres-validationError" class="text-danger invalid-feedback">non può contenere lettere e deve essere maggiore o uguale a 9</div>
            </div>

            @error('sq_metres')
                <p class="text-danger">Il metraggio è un campo obbligatorio</p>
            @enderror
            {{-- /sq metres section--------------------------------------- --}}

            {{-- address section--------------------------------------- --}}
            <div class="mb-3">
                <label class="form-label">Indirizzo*</label>
                <input type="text" name="address" id="autocomplete-address" placeholder="Inserisci l'indirizzo"
                    value="{{ old('address', $address) }}" class="@error('address') is-invalid @enderror form-control"
                    required minlength="3">

                <div id="address-results" class="bg-white  px-3">
                    <!--inserimento risultati in tempo reale-->
                </div>

                <div id="address-error" class="text-danger"></div>

                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var addressInput = document.getElementById('autocomplete-address');
                    var resultsContainer = document.getElementById('address-results');
                    var errorContainer = document.getElementById('address-error');

                    addressInput.addEventListener('input', function() {
                        let searchValue = addressInput.value;

                        //richiesta AJAX
                        fetch('https://api.tomtom.com/search/2/search/' + searchValue +
                                '.json?key=mqY8yECF75lXPuk7LVSI3bFjFtyEAbEX&language=it-IT&idxSets=Str&countrySet=IT&typeahead=true'
                            )
                            .then(response => response.json())
                            .then(data => {
                                resultsContainer.innerHTML = ''; //cancella i risultati precedenti
                                let button = document.querySelector('.btn')

                                if (data.results && data.results.length > 0) {
                                    data.results.forEach(result => {
                                        let resultItem = document.createElement('div');
                                        resultItem.textContent = result.address
                                            .freeformAddress; //mostra il risultato
                                        resultItem.classList.add('address-result-item');
                                        resultsContainer.appendChild(resultItem);
                                    });
                                    errorContainer.textContent =
                                        ''; // Cancella il messaggio di errore se presente
                                    button.disabled = false
                                } else {
                                    errorContainer.textContent =
                                        'Nessun risultato trovato. Inserisci un indirizzo valido.';
                                    button.disabled = true
                                }
                            });
                    });

                    // click sui risultiti
                    resultsContainer.addEventListener('click', function(event) {
                        if (event.target && event.target.tagName == 'DIV') {
                            var selectedAddress = event.target.textContent;
                            addressInput.value = selectedAddress;
                            addressInput.focus(); //focus su input
                            resultsContainer.innerHTML = ''; //svuoto i risultati proposti
                            document.activeElement.blur(); //simula il click fuori dall'area dei risultati
                        }
                    });
                });
            </script>
            {{-- /address section--------------------------------------- --}}

            {{-- image section--------------------------------------- --}}
            <div id="img-div" class="mb-3">
                <label for="img" class="form-label">Immagine*</label>
                <input id="img" class="form-control @error('img') is-invalid @enderror" name="img" type="file"
                    onchange="showUpload(event)" value="{{ old('img', $apartment?->img) }}" {{ $required }} multiple
                    accept="image/jpeg, image/jpg, image/png, image/webp">

                <div id="img-error" class="valid-feedback"></div>

                @error('img')
                    <p class="text-danger">{{ $img }}</p>
                @enderror
                <img id="thumb" width="150" onerror="this.src='/img/placeholder.webp'"
                    src="{{ asset('storage/' . $apartment?->img) }}" />
                <div class="invalid-feedback">questo campo è obbligatorio</div>
            </div>

            <script>
                function showUpload(event) {
                    const thumb = document.getElementById('thumb');
                    thumb.src = URL.createObjectURL(event.target.files[0]);
                }
            </script>

            {{-- /image section--------------------------------------- --}}


            {{-- visible and checkbox services section--------------------------------------- --}}

            <div class="btn-group mb-3" role="group" aria-label="Basic checkbox toggle button group">
                <div class="customCheckBoxHolder row">
                    @foreach ($services as $service)
                    <div class="col-12 col-md-4 col-lg-3">
                        <input type="checkbox" id="service_{{ $service->id }}" class="form-check-input ciao"
                        name="services[]" value="{{ $service->id }} "
                                @if (
                                    (!$errors->any() && $apartment?->services->contains($service)) ||
                                        ($errors->any() && in_array($service->id, old('services', [])))) checked @endif {{ $required }}>

                        <label for="service_{{ $service->id }}" class="customCheckBoxWrapper ciao {{ $text }}">
                            <div class="customCheckBox">
                                <div class="inner">{{ $service->name }}</div>
                            </div>
                        </label>
                    </div>
                        @endforeach
                </div>
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="visible" id="visible" value="1"
                        @if ($visible == 1) checked @endif>
                    <label class="form-check-label text-secondary" for="visible">
                        Rendi pubblico
                    </label>
                </div>
            </div>

            {{-- /visible and checkbox services section--------------------------------------- --}}


            {{-- description section--------------------------------------- --}}
            <div class="form-floating mb-5">
                <textarea class="form-control" placeholder="Descrizione" id="description" name="description">
                    {{ old('description', $apartment?->description) }}</textarea>
                <label class="form-label" for="description">
                </label>
                @error('description')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <span class="text-secondary d-block">*Campi obbligatori</span>
            </div>
            {{-- /description section--------------------------------------- --}}

            {{-- buttons section --}}
            <button type="submit" class="btn bg-success text-white">{{ $button }}</button>
            <button type="reset" class="btn bg-danger text-white">Annulla</button>
            {{-- buttons section --}}
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        let inputs = [
            ["#title",
            '#title-error',
            '#title-div',
            '#title-lengthError'
            ],
            ["#room_number",
            '#room_number-error',
            '#room_number-div'
            ],
            ["#bed_number",
            '#bed_number-error',
            '#bed_number-div'
            ],
            ["#bathroom_number",
            '#bathroom_number-error',
            '#bathroom_number-div'
            ],
            ["#sq_metres",
            '#sq_metres-error',
            '#sq_metres-div'
            ],
            ["#img",
            '#img-error',
            '#img-div'
            ]
        ];

        $.each(inputs, function( index, value ) {

            $(document).ready(function () {
                $(value[0]).on('input', function () {
                    var nameValue = $(this).val().trim();
                    var nameError = $(value[1]);
                    var lengthError = $(value[3]);

                    if ( nameValue.length < 1) {
                        lengthError.hide();
                        nameError.show();
                        $(value[2]).addClass( 'was-validated' );
                    } else if(nameValue.length >= 1 && nameValue.length < 2){
                        nameError.hide();
                        lengthError.show()
                        $(value[2]).addClass( 'was-validated' );
                    } else {
                        nameError.hide();
                        lengthError.hide();
                    }
                    console.log(nameValue)
                });
            });
        })
    </script>



    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        let serviceGroup = document.querySelectorAll(".ciao");
        let i = {{ $active_services }}
        let checkedServices = []
        console.log(i);

        function getCurrentURL() {
            return window.location.href
        }

        // Example
        const url = getCurrentURL()

        console.log(url);


        serviceGroup.forEach(service => {
            service.addEventListener('change', function() {
                if (this.checked) {
                    serviceGroup.forEach(service => {
                        service.removeAttribute("required")
                        service.classList.remove('text-danger')
                        service.classList.add('text-success')
                    })
                    i++
                    console.log(i)
                } else {
                    i--
                    if (i === 0) {
                        serviceGroup.forEach(service => {
                            service.setAttribute("required", '')
                            service.classList.remove('text-success')
                            service.classList.add('text-danger')
                        })
                    }
                    console.log(i)

                }
            });
        });

        console.log(serviceGroup)
    </script>


@endsection

@section('title')
    | Crea Appartamento
@endsection
