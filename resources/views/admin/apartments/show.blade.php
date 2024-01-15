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

            <h4>Info appartamento</h4>
            <p>Stanze: {{ $apartment->room_number }}</p>
            <p>Posti letto: {{ $apartment->bed_number }}</p>
            <p>Bagni: {{ $apartment->bathroom_number }}</p>
            <p>MQ: {{ $apartment->sq_metres }}</p>

            <h4>Stato</h4>
            @if ($apartment->visible === 1)
            <p>Pubblico</p>
            @else
            <p>Privato</p>
            @endif

            <h4>Servizi</h4>
            <ul>
                @forelse ( $apartment->services as $service )
                    <li>{{$service->name}}</li>
                @empty
                    <li>Nessun Servizio</li>
                @endforelse
            </ul>

            <h4>Descrizione</h4>
            <p>{{$apartment->description}}</p>

            <h4>I tuoi messaggi</h4>
            @forelse ($apartment->messages as $message)
                <p>Inviato da: {{ $message->sender_email }} <br>{{ $message->text }}</p>
            @empty
                <p>Non hai messaggi</p>
            @endforelse

        </div>
    </div>
@endsection

@section('title')
    | Lista Appartamenti show
@endsection
