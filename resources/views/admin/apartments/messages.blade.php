@php
    use App\Functions\Helper;
@endphp
@extends('layouts.admin')
@section('content')
    <div>
        @if ($number_messages > 0)
            <h2>Hai <span class="number-email text-center">{{ $number_messages }}</span> messaggi</h2>
        @endif

        @forelse ($messages as $message)
        <div class="accordion accordion-flush email-box" id="accordionFlushExample">
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    <strong class="me-2">Messaggio da:</strong> {{ $message->sender_email }}
                </button>
              </h2>
              <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <span class="text-secondary">Inviato il: {{$message->sended_at}}</span>
                    <p>{{ $message->text }}</p>
                </div>
              </div>
            </div>
        </div>
        @empty
            <h2>Non hai messaggi</h2>
        @endforelse
    </div>
@endsection
