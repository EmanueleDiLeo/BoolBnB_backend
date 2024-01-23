@extends('layouts.admin')

@php
    $loading = false;

@endphp

@section('content')

<h1>SPONSOR PAGA E SORRIDI</h1>
<form action="" method="POST">
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

    {{-- <button class="btn btn-dark" data-toggle="modal" data-target="#modal-pagamento">PAGA E SORRIDI</button> --}}
</form>


<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        ...
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
    </div>
    </div>
</div>
</div>


{{-- <div class="modal" id="modal-pagamento">

    <div class="card w-50">
        <div class="header">
            <div class="title">Payment method</div>
            <i class="far fa-question-circle fa-2x"></i>
            </div>

            <div class="cards-body">
                <div class="cards row">

                    <a class="col-auto" href="#">
                        <img class="card" src="https://icons.iconarchive.com/icons/designbolts/credit-card-payment/256/Visa-icon.png" alt="">
                    </a>
                    <a class="col-auto" href="#">
                        <img class="card" src="https://icons.iconarchive.com/icons/designbolts/credit-card-payment/256/Master-Card-icon.png" alt="">
                    </a>
                <a class="col-auto" href="#">
                    <img class="card" src="https://icons.iconarchive.com/icons/designbolts/credit-card-payment/256/American-Express-icon.png" alt="">
                </a>
            </div>
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
            <div class="footer">
                <i class="fas fa-info-circle fa-2x"></i>
            <p class="text"> Credit Card payments may take up to 24h to processed </p>
            </div>
        </div>
    </div> --}}


    @endsection
