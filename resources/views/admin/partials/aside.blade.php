<aside class="aside-style h-100" >
    <div class=" d-md-none text-white pt-4 px-4 fs-2">
        <i id="burger-menu-icon" class="fa-solid fa-bars"></i>
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

<script>
    let burgerMenu= document.getElementById('burger-menu-icon');
    let linkMenu= document.getElementById('link-menu');
    let aside= document.querySelector('.aside-style');

    burgerMenu.addEventListener('click', function(){
        linkMenu.classList.toggle("d-none");
        aside.classList.toggle("w-50")
    })
</script>
