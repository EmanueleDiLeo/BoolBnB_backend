<header class="">
    <div class="container-fluid">
        <nav class="navbar w-100 d-flex justify-content-around ">
            <ul class="list-unstyled d-flex">
                <li class="mx-3"><a href="{{ route('admin.home') }}" @class(['active' => Route::is('admin.home')])>Home</a></li>
                <li><a href="{{ route('admin.apartments.index') }}" @class(['active' => Route::is('admin.apartments.index')])>I Tuoi Appartamenti</a>
                </li>
            </ul>
            <form action="{{ route('logout') }}" class="d-flex" role="search" method="POST">
                @csrf
                <button class="btn btn-light mb-3" type="submit"><i
                        class="fa-solid fa-right-from-bracket"></i></button>
            </form>
        </nav>
    </div>
</header>
