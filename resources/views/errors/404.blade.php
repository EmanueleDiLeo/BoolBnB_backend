@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center text-title">Ooops, la pagina non esiste, torna ai tuoi appartamenti</h1>
        <a class="btn btn-success" href="{{route('admin.apartments.index')}}">I tuoi appartamenti</a>
    </div>
@endsection

@section('title')
    | Homepage
@endsection
