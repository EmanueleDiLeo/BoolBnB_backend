@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="text-center w-100 text-title mb-3">I Tuoi Appartamenti</h1>
        <a href="{{ route('admin.apartments.create') }}" class="btn btn-success">Aggiungi un appartamento</a>

        <div class="row">
            @if (session('success'))
                <div class="alert alert-success mt-3" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @forelse ($apartments as $apartment)
                <div class="col-12 col-md-6 col-lg-4 my-3">
                    <div class="card h-100 pb-2 position-relative ">
                        <div class=" card-img overflow-hidden" style="height: 200px;">
                            @if (in_array($apartment->id, $ids))
                                <img class="sponsored" src="/img/sponsored.webp" alt="">
                            @endif
                            @if (Str::contains($apartment->img, ['https://']))
                                <img src="{{ $apartment->img }}" class="img-fluid w-100" alt="{{ $apartment->title }}">
                            @else
                                <img src="{{ asset('storage/' . $apartment->img) }}" class="img-fluid w-100"
                                    alt="{{ $apartment->title }}">
                            @endif
                        </div>

                            @if ($apartment->visible === 1)
                                <p><i class="fa-solid fa-eye text-success pos"></i></p>
                            @else
                                <p><i class="fa-solid fa-eye-slash text-danger pos"></i></p>
                            @endif

                        <div class="card-body d-flex flex-column justify-content-between">
                            <div class="info-appartment py-1">
                                <h5 class="card-title">{{ $apartment->title }}</h5>
                                <h6 class="card-subtitle text-muted">{{ $apartment->address }}.</h6>
                            </div>
                            <div class="py-2">
                                <span class="me-1">
                                    <i class="fa-solid fa-door-closed" style="color: #525664"></i>
                                    {{ $apartment->room_number }}
                                </span>
                                <span class="me-1">
                                    <i class="fa-solid fa-bath" style="color: #525664"></i>
                                    {{ $apartment->bathroom_number }}
                                </span>
                                <span class="me-1">
                                    <i class="fa-solid fa-bed" style="color: #525664"></i> {{ $apartment->bed_number }}
                                </span>
                                <span>
                                    <i class="fa-solid fa-ruler-combined" style="color: #525664"></i>
                                    {{ $apartment->sq_metres }}mq
                                </span>
                            </div>

                            <div class="buttons-appartment my-1">
                                {{-- button show------------------------------- --}}
                                <a href="{{ route('admin.apartments.show', $apartment) }}" class="btn btn-show">
                                    <i class="fa-solid fa-circle-info"></i>
                                </a>
                                {{-- /button show------------------------------- --}}

                                {{-- button edit------------------------------- --}}
                                <a href="{{ route('admin.apartments.edit', $apartment) }}" class="btn btn-edit">
                                    <i class="fa-solid fa-pencil text-white"></i>
                                </a>
                                {{-- /button edit------------------------------- --}}

                                {{-- button delete------------------------------- --}}
                                <form class="d-inline-block" id="deleteForm{{ $apartment->id }}"
                                    action="{{ route('admin.apartments.destroy', $apartment) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a type="button" class="btn-delete position-absolute top-0 end-0 fs-3 "
                                        data-bs-toggle="modal" data-bs-target="#deleteModal{{ $apartment->id }}">
                                        <i class="fa-solid fa-xmark"></i>
                                    </a>
                                    {{-- /button delete------------------------------- --}}

                                    {{-- modale di conferma------------------------------- --}}
                                    <div class="modal" id="deleteModal{{ $apartment->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Conferma eliminazione</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Sei sicuro di voler eliminare "{{ $apartment->title }}"?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Annulla</button>
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="submitForm({{ $apartment->id }})">Elimina</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <script>
                    function submitForm(id) {
                        document.getElementById('deleteForm' + id).submit();
                    }
                </script>

            @empty
                <h4 class="text-center w-100 text-title mb-3">Non ci sono appartamenti</h4>
            @endforelse
        </div>
    </div>
@endsection

@section('title')
    | Lista Appartamenti
@endsection
