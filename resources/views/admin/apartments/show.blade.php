@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card p-2 ">
            <img src="{{$apartment->img}}" alt="{{$apartment->title}}">
            <h4>{{$apartment->title}}</h4>
            <p>Indirizzo: {{$apartment->address}}</p>
            <p>Stanze: {{$apartment->room_number}}</p>
            <p>Posti letto: {{$apartment->bed_number}}</p>
            <p>Bagni: {{$apartment->bathroom_number}}</p>
            <p>MQ: {{$apartment->sq_metres}}</p>
            <h5>I tuoi messaggi</h5>
            @foreach ($apartment->messages as $message )
            <p></p>
            <p>inviato da {{$message->sender_email}} <br>{{$message->text}}</p>
            @endforeach

        </div>
    </div>
@endsection

@section('title')
    | Lista Appartamenti show
@endsection
