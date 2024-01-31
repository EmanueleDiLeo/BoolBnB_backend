@extends('layouts.admin')

@section('content')
    <div class="landscape">
        <div class="welcome">
            <h1 class="welcome text-center">Ciao {{ $user->name }}!</h1>
        </div>
        <div class="mountain"></div>
        <div class="mountain mountain-2"></div>
        <div class="mountain mountain-3"></div>
        <div class="sun-container sun-container-1">
        </div>
        <div class="sun-container">
            <div class="sun"></div>
        </div>
        <div class="cloud"></div>
        <div class="cloud cloud-1"></div>
        <div class="sun-container sun-container-reflection">
            <div class="sun"></div>
        </div>
        <div class="light"></div>
        <div class="light light-1"></div>
        <div class="light light-2"></div>
        <div class="light light-3"></div>
        <div class="light light-4"></div>
        <div class="light light-5"></div>
        <div class="light light-6"></div>
        <div class="light light-7"></div>
        <div class="water"></div>
        <div class="splash"></div>
        <div class="splash delay-1"></div>
        <div class="splash delay-2"></div>
        <div class="splash splash-4 delay-2"></div>
        <div class="splash splash-4 delay-3"></div>
        <div class="splash splash-4 delay-4"></div>
        <div class="splash splash-stone delay-3"></div>
        <div class="splash splash-stone splash-4"></div>
        <div class="splash splash-stone splash-5"></div>
        <div class="lotus lotus-1"></div>
        <div class="lotus lotus-2"></div>
        <div class="lotus lotus-3"></div>
        <div class="front">
            <div class="stone"></div>
            <div class="grass"></div>
            <div class="grass grass-1"></div>
            <div class="grass grass-2"></div>
            <div class="reed"></div>
            <div class="reed reed-1"></div>
        </div>
    </div>

    <div class="wrapper d-flex flex-wrap p-4">

        {{-- START Statistics --}}
        <div class="col-12 col-lg-4">
            <section class="text-gray-700 body-font">
                <div class="container px-5 py-24 mx-auto w-100">

                    <div class="d-flex flex-wrap justify-content-center text-center">
                        <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
                            <div
                                class="border-2 border-gray-600 px-4 py-6 rounded-lg transform transition duration-500 hover:scale-110">
                                <i class="fa-solid fa-house fa-2xl mb-4"></i>
                                <h2 class="title-font font-medium text-3xl text-gray-900">{{ $n_apartments }}</h2>
                                <p class="leading-relaxed">Appartamenti</p>
                            </div>
                        </div>

                        <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
                            <div
                                class="border-2 border-gray-600 px-4 py-6 rounded-lg transform transition duration-500 hover:scale-110">
                                <i class="fa-solid fa-medal fa-2xl mb-4"></i>
                                <h2 class="title-font font-medium text-3xl text-gray-900">{{ $n_sponsors }}</h2>
                                <p class="leading-relaxed">Sponsorizzati</p>
                            </div>
                        </div>

                        <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
                            <div
                                class="border-2 border-gray-600 px-4 py-6 rounded-lg transform transition duration-500 hover:scale-110">
                                <i class="fa-solid fa-envelope fa-2xl mb-4"></i>
                                <h2 class="title-font font-medium text-3xl text-gray-900">{{ $n_messages }}</h2>
                                <p class="leading-relaxed">Messaggi</p>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </div>
        {{-- END Statistics --}}

        <div class="col-lg-8">
            <div class="row d-flex">
                <div class="col-sm-6 py-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Appartamenti</h5>
                            <p class="card-text">Tieni aggiornati i tuoi appartamenti, attirerà piu clienti!</p>
                            <a href="{{ route('admin.apartments.index') }}" class="btn btn-primary">I tuoi appartamenti</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 py-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Crea Appartamenti</h5>
                            <p class="card-text">Se hai piu appartamenti puoi aggiungerli con un click</p>
                            <a href="{{ route('admin.apartments.create') }}" class="btn btn-primary">Aggiungi
                                appartamento</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 py-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Messaggi</h5>
                            <p class="card-text">Tieni d'occhio la sezione messaggi, tenersi in contatto con i propri
                                clienti è importante</p>
                            <a href="{{ route('admin.messages') }}" class="btn btn-primary">Visualizza messaggi</a>
                        </div>
                    </div>
                </div>

                {{-- <div class="col-sm-6 py-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Sponsorizzazioni</h5>
                            <p class="card-text">Sponsorizza ora i tuoi appartamenti, i clienti li visualizzeranno come primi risultati</p>
                            <a href="#" class="btn btn-primary">Sponsorizza</a>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection

@section('title')
    | Homepage
@endsection
