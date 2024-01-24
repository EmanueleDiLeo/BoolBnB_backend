@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card p-2 ">

            @if (Str::contains($apartment->img, ['https://']))
                <img src="{{ $apartment->img }}" alt="{{ $apartment->title }}">
            @else
                <img src="{{ asset('storage/' . $apartment->img) }}" alt="{{ $apartment->title }}">
            @endif

            <div class="card-body">
                <h4>{{ $apartment->title }}</h4>

                <div class=" float-end">
                    {{-- button edit------------------------------- --}}
                    <a href="{{ route('admin.apartments.edit', $apartment) }}" class="btn btn-warning">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                    {{-- /button edit------------------------------- --}}
                    {{-- button delete------------------------------- --}}
                    <form class="d-inline-block" action={{ route('admin.apartments.destroy', $apartment) }} method="POST"
                        onsubmit="return confirm('Confermi di voler eliminare l appartamento?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </form>
                    {{-- /button delete------------------------------- --}}
                </div>
                <p>Indirizzo: {{ $apartment->address }}</p>
                <p>lat: {{ $apartment->lat }}</p>
                <p>lon: {{ $apartment->lon }}</p>

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
                    @forelse ($apartment->services as $service)
                        <li>{{ $service->name }}</li>
                    @empty
                        <li>Nessun Servizio</li>
                    @endforelse
                </ul>

                <h4>Descrizione</h4>
                @if ($apartment->description)
                    <p>{!! $apartment->description !!}</p>
                @else
                    <p>Nessuna descrizione</p>
                @endif

                <a href="{{ route('admin.message', $apartment) }}" class="btn btn-success">
                    <i class="fa-solid fa-circle-info">Messaggi</i>
                </a>

            </div>
            <a href="{{ route('selectPayment', $apartment) }}" class="btn btn-info">Sponsorizza il tuo appartamento</a>


        </div>
    </div>
@endsection

@section('title')
    | Lista Appartamenti show
@endsection
