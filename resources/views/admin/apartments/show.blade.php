@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card">
            <img src="{{$apartment->img}}" alt="{{$apartment->title}}">
            <h4>{{$apartment->title}}</h4>
            <h6>pippo</h6>
        </div>
    </div>
@endsection

@section('title')
    | Lista Appartamenti show
@endsection
