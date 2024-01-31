@php
    use App\Functions\Helper;
@endphp
@extends('layouts.admin')
@section('content')
    <div>
        @if ($number_messages > 1)
            <h2>Hai <span class="number-email text-center">{{ $number_messages }}</span> messaggi riguardanti "{{$apartment->title}}"</h2>
        @elseif($number_messages == 1)
            <h2>Hai <span class="number-email text-center">{{ $number_messages }}</span> messaggio riguardanti "{{$apartment->title}}"</h2>
        @endif

        @forelse ($messages as $message)
        <div class="accordion accordion-flush email-box" id="accordionFlushExample{{ $message->id }}">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne{{ $message->id }}" aria-expanded="false" aria-controls="flush-collapseOne">
                        <i class="fa-solid fa-envelope text-primary me-2">
                        <strong class="me-2 d-none d-md-block"></i>Messaggio da:</strong>
                        {{ $message->sender_email }}
                    </button>
                </h2>
                <div id="flush-collapseOne{{ $message->id }}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <span class="text-secondary">Inviato il: {{Helper::formatDate($message->sended_at)}}</span>
                        <p>{{ $message->text }}</p>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center">
            <h2 class="py-4">Non hai messaggi riguardanti "{{$apartment->title}}"</h2>
            <img class="w-50" src="{{asset('icons/Paul-16-512.webp')}}" alt="">

        </div>
        @endforelse
    </div>
@endsection
