<?php
use Carbon\Carbon;
$date = Carbon::parse($max_date);
$formattedDate = $date->format('M d, Y H:i:s');
?>
@extends('layouts.admin')

@section('content')
    <div class="container">
        {{-- titolo --}}
        <div>
            <h4 class="m-0">{{ $apartment->title }}</h4>
            <p class="text-secondary m-0">{{ $apartment->address }}</p>
        </div>
        {{-- /titolo --}}

        <div class="card">
          {{-- sezione immagine --}}
            <div class="card-img overflow-hidden position-relative">
                @if (Str::contains($apartment->img, ['https://']))
                    <img src="{{ $apartment->img }}" alt="{{ $apartment->title }}" class="card-img-top">
                @else
                    <img src="{{ asset('storage/' . $apartment->img) }}" alt="{{ $apartment->title }}" class="card-img-top">
                @endif

                {{-- bottoni --}}
                <div class="position-absolute top-0 end-0 p-2">
                    {{-- button edit------------------------------- --}}
                    <a href="{{ route('admin.apartments.edit', $apartment) }}" class="btn btn-edit">
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
              {{-- /bottoni --}}

              {{-- pubblico/privato --}}
              <div class="position-absolute bottom-0 end-0 p-2">
                  @if ($apartment->visible === 1)
                  <span class="badge-show public">
                    <i class="fa-solid fa-eye"></i>
                  </span>
                  @else
                  <span class="badge-show private">
                    <i class="fa-solid fa-eye-slash"></i>
                  </span>
                  @endif
              </div>
              {{-- pubblico/privato --}}
            </div>
            {{-- /sezione immagine --}}
        </div>

        {{-- section info --}}
        <section class="info row p-1 ">
            <div class="card col-12 col-md-6 p-2 border-0 h-100">

                {{-- dettagli appartamento --}}
                <h5>Dettagli</h5>
                <ul class="list-unstyled d-flex">
                    <li class="d-flex me-3">
                        <div class=" me-2" style="width: 20px">
                            <i class="fa-solid fa-door-closed fs-5" style="color: #525664"></i>
                        </div>
                        <span>{{ $apartment->room_number }}</span>
                    </li>
                    <li class="d-flex me-3">
                        <div class=" me-2" style="width: 20px">
                            <i class="fa-solid fa-bath fs-5" style="color: #525664"></i>
                        </div>
                        <span>{{ $apartment->bathroom_number }}</span>
                    </li>
                    <li class="d-flex me-3">
                        <div class=" me-2" style="width: 20px">
                            <i class="fa-solid fa-bed fs-5" style="color: #525664"></i>
                        </div>
                        <span>{{ $apartment->bed_number }}</span>
                    </li>
                    <li class="d-flex me-3">
                        <div class=" me-2" style="width: 20px">
                            <i class="fa-solid fa-ruler-combined fs-5" style="color: #525664"></i>
                        </div>
                        <span>{{ $apartment->sq_metres }}mq</span>
                    </li>
                </ul>
                {{-- /dettagli appartamento --}}

                {{-- servizi appartamento --}}
                <h5 class="pt-4">Servizi</h5>
                <div class="list-unstyled row">
                    @forelse ($apartment->services as $service)
                        <div class="col-6">
                            <img src="{{asset('icons/' . $service->icon)}}" alt="{{ $service->name }}" style="width: 50px">
                            <span>{{ $service->name }}</span>
                        </div>
                    @empty
                        <li>Nessun Servizio</li>
                    @endforelse
                </div>
                {{-- /servizi appartamento --}}

                 {{-- sponsorizzazione --}}
                <div class="timer-sponsorship pt-4">
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
                        <h4>Sponsorizzazione</h4>
                        <span class="text-secondary">gg : hh : mm : ss</span>
                        <div id="timer"></div>
                        <div>
                            <a href="{{ route('selectPayment', $apartment) }}" class="btn mb-2" style="background-color: #4EA8CE; color:white;">
                                Incrementa la tua sponsorizzazione
                            </a>
                        </div>
                    @else
                        <h4>Non sei ancora sponsorizzato</h4>
                        <div>
                            <a href="{{ route('selectPayment', $apartment) }}" class="btn mb-2" style="background-color: #4EA8CE; color:white;">
                                Sponsorizza ora
                            </a>
                        </div>
                    @endif
                </div>
                {{-- /sponsorizzazione --}}
            </div>

            <div class="card col-12 col-md-6 p-2 border-0">
                <h4 class="m-0">Descrizione</h4>
                @if ($apartment->description)
                    <p>{!! $apartment->description !!}</p>
                @else
                    <p class="text-secondary">Nessuna descrizione</p>
                @endif
                <a href="{{ route('admin.message', $apartment) }}" class="btn btn-success">
                    <i class="fa-solid fa-circle-info"> Messaggi</i>
                </a>
            </div>
        </section>
        {{-- /section info --}}

    </div>
@endsection

@section('title')
    | Lista Appartamenti show
@endsection
