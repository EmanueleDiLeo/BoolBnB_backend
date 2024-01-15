@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card p-2 ">
            @if (Str::contains($apartment->img, ['https://']))
            <img src="{{ $apartment->img }}" alt="{{ $apartment->title }}">
            @else
                <img src="{{ asset('storage/' . $apartment->img) }}" alt="{{ $apartment->title }}">
            @endif
            <h4>{{ $apartment->title }}</h4>
            <p>Indirizzo: {{ $apartment->address }}</p>
            <p>lat: {{$apartment->lat}}</p>
            <p>lon: {{$apartment->lon}}</p>

            <p>Stanze: {{ $apartment->room_number }}</p>
            <p>Posti letto: {{ $apartment->bed_number }}</p>
            <p>Bagni: {{ $apartment->bathroom_number }}</p>
            <p>MQ: {{ $apartment->sq_metres }}</p>

            @if ($apartment->visible === 1)
            <p>Pubblico</p>
            @else
            <p>Privato</p>
            @endif


            <ul>
                @forelse ( $apartment->services as $service )
                    <li>{{$service->name}}</li>
                @empty
                    <p>Nessun Servizio</p>
                @endforelse
            </ul>

            <p>{{$apartment->description}}</p>

            <h5>I tuoi messaggi</h5>

            @foreach ($apartment->messages as $message)
                <p></p>
                <p>inviato da {{ $message->sender_email }} <br>{{ $message->text }}</p>
            @endforeach



        </div>
    </div>
@endsection

@section('title')
    | Lista Appartamenti show
@endsection
