<aside class="aside-style h-100" >
    <ul class="text-start py-3">
        <li class="my-2">
            <a href="{{ route('admin.home') }}" @class(['active' => Route::is('admin.home')])>
            Home</a>
        </li>
        <li class="my-2">
            <a href="{{ route('admin.apartments.index') }}" @class(['active' => Route::is('admin.apartments.index')])>I Tuoi Appartamenti
            </a>
        </li>
        <li class="my-2">
            <a href="{{ route('admin.apartments.create') }}" @class(['active' => Route::is('admin.apartments.create')])>Aggiungi Appartamento
            </a>
        </li>
    </ul>

</aside>
