@extends('layouts.guest')

@section('content')
{{-- title home guest --}}
    <h1 class='text-center text-title'>Boolbnb</h1>

{{-- card view --}}
    <div class="container">
        <div class="row justify-content-center">
            @foreach ($apartments as $apartment)
                <div class="col-4 my-3">
                    <div class="card h-100">

                        {{-- image card---------------------------------- --}}
                        <div class=" card-img w-100 overflow-hidden" style="height: 220px;">
                            @if (Str::contains($apartment->img, ['https://']))
                            <img src="{{ $apartment->img }}" class="img-fluid w-100" alt="{{ $apartment->title }}">
                            @else
                            <img src="{{ asset('storage/' . $apartment->img) }}" class="img-fluid w-100" alt="{{ $apartment->title }}">
                            @endif
                        </div>
                        {{-- /image card---------------------------------- --}}

                        {{-- section description appartment--------------- --}}
                        <div class="card-body">
                            <h5 class="card-title">{{ $apartment->title }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $apartment->address }}.</h6>
                            <p style="font-size: .7rem;">{!! $apartment->description !!}</p>
                            <a href="#" class="btn btn-success">Info</a>
                        </div>
                        {{-- /section description appartment--------------- --}}

                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
