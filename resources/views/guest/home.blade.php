@extends('layouts.guest')

@section('content')
    <h1 class='text-center text-title'>Home Pubblica</h1>
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">
        </h2>
        <div class="row justify-content-center">
            @foreach ($apartments as $apartment)
                <div class="col-4 my-3">
                    <div class="card h-100">
                        @if (Str::contains($apartment->img, ['https://']))
                            <img src="{{ $apartment->img }}" alt="{{ $apartment->title }}">
                        @else
                            <img src="{{ asset('storage/' . $apartment->img) }}" alt="{{ $apartment->title }}">
                        @endif
                        <div class="card-body ">
                            <h5 class="card-title">{{ $apartment->title }}</h5>
                            <a href="#" class="btn btn-success">Info</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
