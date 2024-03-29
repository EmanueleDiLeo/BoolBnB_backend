@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Dashboard') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="image">
                    <img src="./boom-turisti-stranieri-localita-balneari-italiane.jpg" alt="boom-turisti-stranieri-localita-balneari-italiane">
                    <i class="fa-regular fa-heart"></i>
                    <i class="fa-solid fa-circle-chevron-right"></i>
                    <i class="fa-solid fa-ellipsis icon-center"></i>
                </div>
                <div class="dida">
                    <p>Casteldaccia, Italia</p>
                    <span class="info">
                    Host Privato <br>
                    26-31 Agosto
                    </span>
                    <span class="vote">
                    <i class="fa-solid fa-star"></i>
                    5,0
                    </span>

                    <p>
                    <strong>186€</strong> a notte
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
