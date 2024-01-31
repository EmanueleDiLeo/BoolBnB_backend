<aside class="aside-style h-100 d-none d-md-block">
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
