@extends('layouts.guest')

@section('content')
    <h1>Home Pubblica</h1>
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">
        </h2>
        <div class="row justify-content-center">
            @foreach ($apartments as $apartment)
                <div class="col-4">
                    <div class="card">
                        <div class="image">
                            <img src="{{$apartment->img}}" alt="{{$apartment->title}}">
                            <i class="fa-regular fa-heart"></i>
                            <i class="fa-solid fa-circle-chevron-right"></i>
                            <i class="fa-solid fa-ellipsis icon-center"></i>
                        </div>
                        <div class="dida">
                            <p>{{$apartment->address}}</p>
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
            @endforeach

        </div>
    </div>
@endsection
