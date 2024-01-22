@extends('layouts.admin')
@section('content')
    <div>
        @if ($number_messages > 0)
            <h2>Hai {{ $number_messages }} messaggi</h2>
        @endif
        @forelse ($messages as $message)
            <p>Inviato da: {{ $message->sender_email }} </p>
            <p><strong>Messaggio:</strong><br>{{ $message->text }}</p>
            <hr>
        @empty
            <h2>Non hai messaggi</h2>
        @endforelse

    </div>
@endsection
