@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="text-center w-100 text-title mb-3">I Tuoi Appartamenti</h1>
        <div class="row">
            @foreach ($apartments as $apartment)
            <div class="col-4 my-3">
                <div class="card h-100">
                    <img src="{{$apartment->img}}" class="card-img-top w-100" alt="{{$apartment->title}}">
                    <div class="card-body">
                      <h5 class="card-title">{{$apartment->title}}</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <a href="{{route('admin.apartments.show', $apartment)}}" class="btn btn-success">Info</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection

@section('title')
    | Lista Appartamenti
@endsection
