<header>
    <div class="d-flex justify-content-between align-items-center h-100">
        {{-- burger menu --}}
        <div class="d-md-none">
            <div class="d-flex justify-content-center">
                <a class="text-white text-center fs-1" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                    aria-controls="offcanvasExample">
                    <i id="burger-menu-icon" class="fa-solid fa-bars"></i>
                </a>
            </div>

            {{-- offcanvass view --}}
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header offcanvas-header-pr">
                    <button type="button" class="btn-close text-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    <div class="text-white">
                        <i class="fa-solid fa-user"></i>
                        <span>{{$user->name}}</span>
                    </div>
                    <form action="{{ route('logout') }}" class="d-flex" role="search" method="POST">
                        @csrf
                        <button class="btn btn-light button-logout-header" type="submit"><i
                                class="fa-solid fa-right-from-bracket"></i></button>
                    </form>
                </div>
                <div class="offcanvas-body">
                    <ul id="link-menu" class="text-start py-3 px-4 d-md-block">
                        <li class="my-2 d-flex">
                            <div class="square-icon">
                                <i class="fa-solid fa-house"></i>
                            </div>
                            <a href="{{ route('admin.home') }}" @class(['active' => Route::is('admin.home')])>
                                Home</a>
                        </li>
                        <li class="my-2 d-flex">
                            <div class="square-icon">
                                <i class="fa-solid fa-building-user"></i>
                            </div>
                            <a href="{{ route('admin.apartments.index') }}" @class(['active' => Route::is('admin.apartments.index')])>I Tuoi Appartamenti
                            </a>
                        </li>
                        <li class="my-2 d-flex">
                            <div class="square-icon">
                                <i class="fa-solid fa-plus"></i>
                            </div>
                            <a href="{{ route('admin.apartments.create') }}" @class(['active' => Route::is('admin.apartments.create')])>Aggiungi Appartamento
                            </a>
                        </li>
                        <li class="my-2 d-flex">
                            <div class="square-icon">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <a href="{{ route('admin.messages') }}" @class(['active' => Route::is('admin.messages')])>Messaggi Ricevuti
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="offcanvas-bottom">
                    <span class="d-block version-software">versione 1.2.3</span>
                    <span class="d-block fs-5"> <i class="fa-solid fa-mug-hot"></i> Team 2</span>
                </div>
            </div>
            {{-- offcanvass view --}}

        </div>
        {{-- burger menu --}}

        <div class="img-container h-100">
            <a href="{{ route('admin.home')}}" class=" text-decoration-none h-100 d-flex align-items-center">
                <img src="/img/logo.png" class="h-75 me-md-2" alt="logo">
                <span class="text-white logo-title d-none d-md-block">Boolbnb</span>
            </a>
        </div>

        <form action="{{ route('logout') }}" class="d-flex d-none d-md-block" role="search" method="POST">
            @csrf
            <button class="btn btn-light" type="submit">
                <i class="fa-solid fa-right-from-bracket"></i>
            </button>
        </form>
    </div>
</header>
