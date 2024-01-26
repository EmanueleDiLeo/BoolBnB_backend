<header>
    <div class="d-flex justify-content-between align-items-center h-100">
        <div class="img-container h-100">
            <a href="{{ route('admin.home')}}" class=" text-decoration-none h-100 d-flex align-items-center">
                <img src="/img/logo.png" class="h-75 me-2" alt="logo">
                <span class="text-white logo-title">Boolbnb</span>
            </a>
        </div>
        <form action="{{ route('logout') }}" class="d-flex" role="search" method="POST">
            @csrf
            <button class="btn btn-light" type="submit"><i
                    class="fa-solid fa-right-from-bracket"></i></button>
        </form>
    </div>
</header>
