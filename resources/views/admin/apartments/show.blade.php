<?php
use Carbon\Carbon;
$date = Carbon::parse($max_date);
$formattedDate = $date->format('M d, Y H:i:s');
?>
@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card p-2 ">
            @if ($max_date != null)
                <script>
                    let clock = "<?php echo $formattedDate; ?>"
                    // Aggiungi a new date la data della fine countdown e ne prendi il tempo
                    let countDownDate = new Date(clock).getTime();
                    // imposto let timer per fare il clear interval al momento che diventa zero
                    let timer = setInterval(() => {
                        // prendo ora di data ora di adesso e faccio la differenza
                        let now = new Date().getTime();
                        let distance = countDownDate - now;

                        // formule per estrapolare giorni more minuti e secondi convertendo a stringa e aggiongendo con pad uno zero
                        let days = Math.floor(distance / (1000 * 60 * 60 * 24)).toString().padStart(2, '0');
                        let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)).toString()
                            .padStart(2, '0');
                        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)).toString().padStart(2,
                            '0');
                        let seconds = Math.floor((distance % (1000 * 60)) / 1000).toString().padStart(2, '0');
                        clock = ` ${days} : ${hours} : ${minutes} : ${seconds}`
                        document.getElementById('timer').innerHTML = clock;
                        // Countdown output
                        // console.log(days + "d " + hours + "h " + minutes + "m " + seconds + "s");
                        if (distance < 0) {
                            clearInterval(timer);
                            // Text at the end of the countdown
                            console.log("Too late!")
                        }
                    }, 1000)
                </script>
                <h4>Sponsorizzato per:</h4>
                <div id="timer"></div>
                <div>
                    <a href="{{ route('selectPayment', $apartment) }}" class="btn btn-info mb-2">Incrementa la tua
                        sponsorizzazione</a>
                </div>
            @else
                <h4>Non sei sponsorizzato sponsorizzati ora!</h4>
                <div>
                    <a href="{{ route('selectPayment', $apartment) }}" class="btn btn-info mb-2">Sponsorizza il tuo
                        appartamento</a>
                </div>
            @endif


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



        </div>
    </div>
@endsection

@section('title')
    | Lista Appartamenti show
@endsection
