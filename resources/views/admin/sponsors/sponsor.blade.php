@extends('layouts.admin')

@php
    $loading = false;

@endphp

@section('content')
    <h1 class="main__heading">SPONSOR PAGA E SORRIDI</h1>
    <div class="main__cards cards">
        <div class="cards__inner">
            @foreach ($sponsors as $sponsor)
                <div class="cards__card card">
                    <h2 class="card__heading">{{ $sponsor->type }}</h2>
                    <p class="card__price">&euro; {{ $sponsor->price }}</p>
                    <ul role="list" class="card__bullets flow">
                        <li>Sponsorizzazione per {{ $sponsor->duration }} ore</li>
                    </ul>
                    <input type="hidden" class="form-control" id="apartment" name="apartment" value="{{ $sponsor->id }}">

                    <button type="button" data-bs-toggle="modal" data-bs-target="#paymentModal{{ $sponsor->id }}"
                        class="card__cta cta generateToken">
                        {{ $sponsor->id > 1 ? 'Acquista ' . $sponsor->type : 'Inizia con ' . $sponsor->type }}
                    </button>
                </div>

                <!-- Modal -->

                <form id="paymentModal{{ $sponsor->id }}" class="modal " tabindex="-1">
                    <div class="modal-dialog modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Modal title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="nonce">Payment Method</label>
                                    <div id="dropin-container"></div>
                                    <input type="hidden" id="nonce" name="payment_method_nonce">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Procedi con</button>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- /Modal -->
            @endforeach
        </div>
        <div class="overlay cards__inner"></div>
    </div>






    <script src="https://js.braintreegateway.com/web/dropin/1.35.0/js/dropin.min.js"></script>
    <script>
        var generateToken = document.getElementsByClassName("generateToken");
        let token
        var form = document.querySelector('form');

        for (var i = 0; i < generateToken.length; i++) {
            generateToken[i].addEventListener("click", function(i) {
                token = ''
                //richiesta AJAX
                fetch('http://127.0.0.1:8000/api/generate')
                    .then(response => response.json())
                    .then(data => {
                        token = data.token;
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
