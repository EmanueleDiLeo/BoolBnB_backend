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
            @foreach ($apartments as $apartment)
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
                            <form class="d-inline-block" action={{ route('admin.apartments.destroy', $apartment) }}
                                method="POST" onsubmit="return confirm('Confermi di voler eliminare l appartamento?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </form>
                            {{-- /button delete------------------------------- --}}

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('title')
    | Lista Appartamenti
@endsection
