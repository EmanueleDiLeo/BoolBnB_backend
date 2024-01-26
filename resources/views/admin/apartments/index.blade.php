@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="text-center w-100 text-title mb-3">I Tuoi Appartamenti</h1>
        <a href="{{ route('admin.apartments.create') }}" class="btn btn-success">Aggiungi un appartamento</a>

        <div class="row">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @forelse ($apartments as $apartment)
                <div class="col-4 my-3">
                    <div class="card h-100">
                        <div class=" card-img w-100 overflow-hidden" style="height: 220px;">
                            @if (Str::contains($apartment->img, ['https://']))
                                <img src="{{ $apartment->img }}" class="img-fluid w-100" alt="{{ $apartment->title }}">
                            @else
                                <img src="{{ asset('storage/' . $apartment->img) }}" class="img-fluid w-100"
                                    alt="{{ $apartment->title }}">
                            @endif
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $apartment->title }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $apartment->address }}.</h6>

                            {{-- button show------------------------------- --}}
                            <a href="{{ route('admin.apartments.show', $apartment) }}" class="btn btn-success">
                                <i class="fa-solid fa-circle-info"></i>
                            </a>
                            {{-- /button show------------------------------- --}}

                            {{-- button edit------------------------------- --}}
                            <a href="{{ route('admin.apartments.edit', $apartment) }}" class="btn btn-warning">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                            {{-- /button edit------------------------------- --}}

                            {{-- button delete------------------------------- --}}
                            <form class="d-inline-block" id="deleteForm{{ $apartment->id }}"
                                action="{{ route('admin.apartments.destroy', $apartment) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="button"
                                    class="btn btn-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $apartment->id }}"
                                >
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
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
