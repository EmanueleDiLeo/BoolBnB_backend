@extends('layouts.app')
@section('title')
    Registrazione
@endsection

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Registrazione') }}</div>

                    <div id="form" class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-4 row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ ('Nome *') }}</label>

                                <div class="col-md-6" id="name-div">
                                    <input id="name" type="text" class="form-control" name="name"
                                        value="{{ old('name')}}" autocomplete="name" required autofocus minlength="2">

                                        {{-- errore --}}
                                    <span class="text-danger invalid-feedback" id="name-error">Il nome è un campo obbligatorio</span>
                                </div>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                            </div>


                            <div class="mb-4 row">
                                <label for="surname"
                                class="col-md-4 col-form-label text-md-right">{{ __('Cognome *') }}</label>

                                <div class="col-md-6 validation" id="surname-div">
                                    <input id="surname" type="text"
                                    class="form-control surname-input @error('surname') is-invalid @enderror" name="surname"
                                    value="{{ old('surname') }}" required autocomplete="surname" autofocus minlength="2">

                                        {{-- errore --}}
                                        <span class="text-danger invalid-feedback " id="surname-error">Il cognome è un campo obbligatorio</span>

                                    @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo Email *') }}</label>



                                <div class="col-md-6" id="email-div">
                                    <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required pattern="[^@]+@[^@]+.[a-zA-Z]{2,}">

                                    {{-- errore --}}
                                    <span class="text-danger invalid-feedback" id="email-error">L'email è un campo obbligatorio</span>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row">
                                <label for="date_birth"
                                class="col-md-4 col-form-label text-md-right">{{ __('Data di nascita*') }}
                                </label>

                                <div class="col-md-6">
                                    <input id="date_birth" type="date"
                                    class="form-control @error('date_birth') is-invalid @enderror" name="date_birth"
                                        value="{{ old('date_birth') }}" required>

                                        {{-- errore --}}
                                        <span class="text-danger invalid-feedback">La data di nascita è un campo obbligatorio</span>

                                        @error('date_birth')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4 row" id="div-passwords">
                                <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('Password *') }}</label>

                                <div class="col-md-6" id="password-div">
                                    <input id="password" type="text"
                                    class="form-control validate-password @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                    <span class="text-danger invalid-feedback" id="password-error">La password è un campo obbligatorio</span>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    </div>
                                </div>

                                <div class="mb-4 row" id="password-confirm-div">
                                    <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Conferma Password *') }}</label>

                                    <div class="col-md-6">
                                    <input id="password-confirm" type="text" class="form-control validate-password"
                                    name="password_confirmation" required autocomplete="new-password" onclick="validatePass()">
                                    <span class="text-danger invalid-feedback" id="password-confirm-error">La conferma della password un campo obbligatorio</span>
                                </div>


                                <span class="text-danger d-none" id="password-check-error">Le password devono corrispondere</span>
                            </div>

                            <p>* Campi obbligatori</p>

                            <div class="check"></div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ ('Registrati') }}
                                    </button>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>

        let inputs = [
            ["#name",
            '#name-error',
            '#name-div'
            ],
            ['#surname',
            '#surname-error',
            '#surname-div'
            ],
            ['#email',
            '#email-error',
            '#email-div'
            ],
        ];

        $.each(inputs, function( index, value ) {

            $(document).ready(function () {
                $(value[0]).on('input', function () {
                    var nameValue = $(this).val().trim();
                    var nameError = $(value[1]);

                    if (nameValue.length < 2) {
                        nameError.show();
                        $(value[2]).addClass( 'was-validated' );
                    } else {
                        nameError.hide();
                    }
                });
        });
        })





        var passwordConfirm = document.getElementById('password-confirm');
        var password = document.getElementById('password');
        var passwordError = document.getElementById('password-check-error');
        var passwordDiv = document.getElementById('div-password');
        let arrPass = document.querySelectorAll("check");

        console.log(password.value);
        console.log(passwordConfirm.value);


        document.querySelectorAll(".validate-password").forEach(element => {
           element.addEventListener('keyup', function() {
            if (password.value === passwordConfirm.value && password.value.length > 8 && passwordConfirm.value.length > 8) {
                    passwordConfirm.classList.remove('is-invalid');
                    password.classList.remove('is-invalid');
                    passwordConfirm.classList.add('is-valid');
                    password.classList.add('is-valid');
                    passwordError.classList.remove('d-block');
                    passwordError.classList.add('d-none');
                } else {
                    passwordConfirm.classList.remove('is-valid');
                    password.classList.remove('is-valid');
                    passwordConfirm.classList.add('is-invalid');
                    password.classList.add('is-invalid');
                    passwordError.classList.remove('d-none');
                    passwordError.classList.add('d-block');
                }
           })
        });

    </script>
    @endsection
