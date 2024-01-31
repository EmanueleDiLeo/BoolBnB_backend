@extends('layouts.admin')

@section('content')
    <div class="container mt-5 text-center">

            <h1 class="text-center text-title">Ooops, la pagina non esiste, torna ai tuoi appartamenti</h1>
            <img class="d-block my-0 mx-auto w-75" src="{{asset('icons/404.png')}}" alt="">
            <a class="btn btn-success" href="{{route('admin.apartments.index')}}">I tuoi appartamenti</a>

    </div>
@endsection

@section('title')
    | Homepage
@endsection
