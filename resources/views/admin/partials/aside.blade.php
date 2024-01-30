<aside class="aside-style h-100">

    <div class="d-flex w-100 justify-content-center mt-3">
        <a class="d-md-none text-white text-center fs-1" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
            aria-controls="offcanvasExample">
            <i id="burger-menu-icon" class="fa-solid fa-bars"></i>
        </a>

    </div>


    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul id="link-menu" class="text-start py-3 px-4  d-md-block">
                <li class="my-3">
                    <a href="{{ route('admin.home') }}" @class(['active' => Route::is('admin.home')])>
                        Home</a>
                </li>
                <li class="my-3">
                    <a href="{{ route('admin.apartments.index') }}" @class(['active' => Route::is('admin.apartments.index')])>I Tuoi Appartamenti
                    </a>
                </li>
                <li class="my-3">
                    <a href="{{ route('admin.apartments.create') }}" @class(['active' => Route::is('admin.apartments.create')])>Aggiungi Appartamento
                    </a>
                </li>
                <li class="my-3">
                    <a href="{{ route('admin.messages') }}" @class(['active' => Route::is('admin.messages')])>Messaggi Ricevuti
                    </a>
                </li>
            </ul>
        </div>
    </div>


    <ul id="link-menu" class="text-start py-3 px-4 d-none d-md-block">
        <li class="my-3">
            <a href="{{ route('admin.home') }}" @class(['active' => Route::is('admin.home')])>
                Home</a>
        </li>
        <li class="my-3">
            <a href="{{ route('admin.apartments.index') }}" @class(['active' => Route::is('admin.apartments.index')])>I Tuoi Appartamenti
            </a>
        </li>
        <li class="my-3">
            <a href="{{ route('admin.apartments.create') }}" @class(['active' => Route::is('admin.apartments.create')])>Aggiungi Appartamento
            </a>
        </li>
        <li class="my-3">
            <a href="{{ route('admin.messages') }}" @class(['active' => Route::is('admin.messages')])>Messaggi Ricevuti
            </a>
        </li>
    </ul>
</aside>
