@extends('layouts.admin')

@php
    $loading = false;

@endphp

@section('content')

<h1>SPONSOR PAGA E SORRIDI</h1>
<form action="{{route('makePayment')}}" method="POST">
    @csrf
    @method('POST')
    <div class="container d-flex">
        @foreach ($sponsors as $sponsor)
        <div class="card col-4">
            <div class="cardtext">
                {{$sponsor->type}}
            </div>
            <div class="cardtext col-4">
                {{$sponsor->price}}$$$
            </div>
            <div class="cardtext col-4">
                {{$sponsor->duration}}H
            </div>
            <input type="radio" name="sponsor-radio" value="{{$sponsor->id}}">
        </div>
        @endforeach
    </div>
    <button class="btn btn-dark" type="submit">PAGA E SORRIDI</button>
</form>


<!-- Modal -->
<button id="token" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
You Pay
</button>
<div class="modal fade w-100" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog w-100">
        <div class="modal-content w-75">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                {{-- immagini carte --}}
                <div class="cards d-flex">

                    <label class="me-2">
                        <input type="radio" name="test" value="small" checked class="radio-payment">
                        <img class="img-card" src="https://icons.iconarchive.com/icons/designbolts/credit-card-payment/256/Visa-icon.png" alt="">
                    </label>
                    <label class="me-2">
                        <input type="radio" name="test" value="small" checked class="radio-payment">
                        <img class="img-card" src="https://icons.iconarchive.com/icons/designbolts/credit-card-payment/256/Master-Card-icon.png" alt="">
                    </label>
                    <label class="me-2">
                        <input type="radio" name="test" value="small" checked class="radio-payment">
                        <img class="img-card" src="https://icons.iconarchive.com/icons/designbolts/credit-card-payment/256/American-Express-icon.png" alt="">
                    </label>

                </div>
                {{-- immagini carte --}}

                <form class="form-card" action="" method="">
                    <div class="name-card ">
                        <div class="card-label">
                            <label for="name">Cardholder name</label>
                        </div>
                            <input class="form-group" type="text" name="name-card" placeholder="Diane Miles"/>
                        </div>
                    <div class="info-card">
                        <div class="info-card-number">
                            <div class="card-label">
                                <label for="cardName">Card number</label>
                            </div>
                                <input class="form-group" type="text" name="cardnumber" placeholder="1234 6573 8228 7373"/>
                        </div>
                        <div class="info-card-payment">
                    <div class="card-label">
                        <label for="date">Date</label>
                    </div>
                    <input class="form-group" type="text" name="date" placeholder="10/25"/>
                </div>
                <div class="info-card-payment">
                    <div class="card-label">
                        <label for="ccv">CCV</label>
                    </div>
                    <input class="form-group" type="text" name="ccv" placeholder="329"/>
                </div>
            </div>
        </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- /Modal -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    var generateToken = document.getElementById('token');
    let token

    generateToken.addEventListener('click', function() {
        //richiesta AJAX
        $.ajax({
            method: "GET",
            url: "http://127.0.0.1:8000/api/generate",
            success: (result) => {
                token = result.token;
                console.log(token);


            },
            error: (error) => {
                if(error.status === 422) { // "Unprocessable Entity" - Form data invalid
                    $("#successMessage").addClass('visually-hidden');
                    var message = error.responseJSON.errors ? error.responseJSON.errors.comment ?  error.responseJSON.errors.comment[0] : '' : '';
                    $("#comment-errors-data").html(message);
                    submitButton.html('Save');
                }
            }
        });
    });



</script>



@endsection
