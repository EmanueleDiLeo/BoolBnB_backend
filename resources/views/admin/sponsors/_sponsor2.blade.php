@extends('layouts.admin')

@php
    $loading = false;

@endphp

@section('content')
    <h1 class="main__heading">Sponsorizza il tuo appartamento</h1>
    <h5 class="secondary__heading">Scegli uno dei seguenti pacchetti per mettere in evidenza il tuo appartamento</h5>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="main__cards cards">
        <div class="cards__inner">
            <form method="post" class="d-flex " action="{{ route('payment.create') }}">
                @csrf
                @method('POST')
                @foreach ($sponsors as $sponsor)
                    <div class="cards__card card">
                        <h2 class="card__heading">{{ $sponsor->type }}</h2>
                        <p class="card__price">&euro; {{ $sponsor->price }}</p>
                        <ul role="list" class="card__bullets flow">
                            <li>Mostra il tuo appartamento in evidenza per aumentare visibilità</li>
                            <li>Sponsorizzazione per {{ $sponsor->duration }} ore</li>
                        </ul>

                        <input type="hidden" class="form-control" id="apartment" name="apartment"
                            value="{{ $apartment->id }}">

                        <button onclick="takeValue({{ $sponsor->id }})" value="{{ $sponsor->id }}" type="button"
                            data-bs-toggle="modal" data-bs-target="#paymentModal" class="card__cta cta generateToken">
                            {{ $sponsor->id > 1 ? 'Acquista ' . $sponsor->type : 'Inizia con ' . $sponsor->type }}
                        </button>
                    </div>
                @endforeach
                <input type="hidden" class="form-control" id="sponsor" name="sponsor" value="">

                <!-- Modal -->
                <div id="paymentModal" class="modal modal-lg" tabindex="-1">

                    <div class="modal-dialog modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Metodo di pagamento</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            {{-- payment custom --}}
                            <div class="modal-body">
                                <div class="form-group">
                                   {{-- DROPIN --}}
                                    {{-- <div id="dropin-container"></div>
                                    <input type="hidden" id="nonce" name="payment_method_nonce"> --}}


                                    <div class="cards-body">
                                        <div class="card-img row">

                                            <img class="col-4" src="https://icons.iconarchive.com/icons/designbolts/credit-card-payment/256/Visa-icon.png" alt="">

                                            <img class="col-4" src="https://icons.iconarchive.com/icons/designbolts/credit-card-payment/256/Master-Card-icon.png" alt="">

                                            <img class="col-4" src="https://icons.iconarchive.com/icons/designbolts/credit-card-payment/256/American-Express-icon.png" alt="">

                                        </div>
                                        <form class="form-card" action="" method="">
                                            {{-- nome proprietario --}}
                                            <div class="name-card ">
                                                <div class="mb-4 row">

                                                    <div class="col-md-6" id="name-div">
                                                        <label for="name" class="col-md-4 col-form-label">Nome</label>
                                                        <input id="name" type="text" class="form-control is-valid" name="name"
                                                            value="{{ $user->name }}" autocomplete="name" required autofocus minlength="2">

                                                        {{-- errore --}}
                                                        <span class="text-danger invalid-feedback" id="name-error">Il nome è un campo
                                                            obbligatorio</span>
                                                    </div>
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <div class="col-md-6" id="name-div">
                                                        <label for="surname" class="col-md-4 col-form-label">Cognome</label>
                                                        <input id="surname" type="text" class="form-control is-valid" name="surname"
                                                            value="{{ $user->surname }}" autocomplete="name" required autofocus minlength="2">

                                                        {{-- errore --}}
                                                        <span class="text-danger invalid-feedback" id="name-error">Il nome è un campo
                                                            obbligatorio</span>
                                                    </div>
                                                    @error('surname')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- nome proprietario --}}

                                            <div class="info-card">

                                                 {{-- numero carta --}}
                                                <div class="info-card-number">
                                                    <div class="card-label">
                                                        <label for="cardName">Numero carta</label>
                                                    </div>
                                                    <input
                                                        id="ccn"
                                                        type="tel"
                                                        class="form-control is-valid"
                                                        inputmode="numeric"
                                                        pattern="[0-9\s]{13,19}"
                                                        autocomplete="cc-number"
                                                        maxlength="16"
                                                        placeholder="xxxx xxxx xxxx xxxx"
                                                        required
                                                    >
                                                </div>
                                                 {{-- /numero carta --}}

                                                {{-- scadenza carta --}}
                                                <div class="info-card-payment">
                                                    <div class="mb-4 row">

                                                        <div class="col-md-6" id="month-div">
                                                            <label for="name" class="col-md-4 col-form-label">Scadenza</label>
                                                            <div class="d-flex">

                                                                <input
                                                                    id="ccn"
                                                                    type="tel"
                                                                    class="form-control is-valid"
                                                                    inputmode="numeric"
                                                                    pattern="[0-9\s]{13,19}"
                                                                    autocomplete="cc-number"
                                                                    maxlength="2"
                                                                    placeholder="MM*"
                                                                    required
                                                                >
                                                                <input
                                                                    id="ccn"
                                                                    type="tel"
                                                                    class="ms-1 form-control is-valid"
                                                                    inputmode="numeric"
                                                                    pattern="[0-9\s]{13,19}"
                                                                    autocomplete="cc-number"
                                                                    maxlength="2"
                                                                    placeholder="YY*"
                                                                    required
                                                                >
                                                            </div>

                                                            {{-- errore --}}
                                                            <span class="text-danger invalid-feedback" id="card-error">
                                                                Il nome è un campo obbligatorio
                                                            </span>
                                                        </div>
                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror

                                                        {{-- ccv --}}
                                                        <div class="col-md-6" id="ccv-div">
                                                            <label for="ccv" class="col-md-4 col-form-label">CCV</label>
                                                            <input
                                                                id="ccv"
                                                                type="tel"
                                                                class="form-control is-valid"
                                                                inputmode="numeric"
                                                                pattern="[0-9\s]{13,19}"
                                                                autocomplete="cc-number"
                                                                maxlength="3"
                                                                placeholder="CCV"
                                                                required
                                                            >

                                                            {{-- errore --}}
                                                            <span class="text-danger invalid-feedback" id="name-error">
                                                                Il nome è un campo obbligatorio
                                                            </span>
                                                        </div>
                                                        @error('surname')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                        {{-- /ccv --}}
                                                    </div>
                                                </div>
                                                 {{-- /scadenza carta --}}


                                            </div>
                                        </form>
                                    </div>


                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-between">
                                <div class="d-flex w-75">
                                    <i class="fas fa-info-circle fa-2x"></i>
                                    <p class=" ms-2">L'elaborazione dei pagamenti con carta di credito può richiedere fino a 24h</p>
                                </div>
                                <button
                                    type="submit"
                                    class="btn btn-success"
                                >
                                    Procedi con l'aquisto
                                </button>
                            </div>
                            {{-- payment custom --}}


                        </div>
                    </div>
                </div>
                <!-- /Modal -->
            </form>
        </div>
        <div class="overlay cards__inner"></div>
    </div>






    <script src="https://js.braintreegateway.com/web/dropin/1.35.0/js/dropin.min.js"></script>
    <script>
        var generateToken = document.getElementsByClassName("generateToken");
        let sponsor = document.getElementById("sponsor");
        let token
        var form = document.querySelector('form');
        let isDisabled = true;
        let isLoading = true;


        function takeValue(value) {
            sponsor.value = value;
            console.log(sponsor.value);
        }
        for (var i = 0; i < generateToken.length; i++) {
            generateToken[i].addEventListener("click", function() {
                token = ''
                //richiesta AJAX
                fetch('http://127.0.0.1:8000/api/generate')
                    .then(response => response.json())
                    .then(data => {
                        token = data.token;
                        isLoading = false;
                        isDisabled = false;
                        console.log(token);
                        braintree.dropin.create({
                            authorization: token,
                            container: '#dropin-container'
                        }, function(createErr, instance) {
                            if (createErr) {
                                console.error(createErr);
                                return;
                            }
                        })
                    });


                form.addEventListener('submit', function(event) {
                    event.preventDefault();

                    instance.requestPaymentMethod(function(err, payload) {
                        if (err) {
                            console.error(err);
                            return;
                        }

                        document.querySelector('#nonce').value = payload.nonce;
                        form.submit();
                    });
                });
            });
        }
    </script>
@endsection
