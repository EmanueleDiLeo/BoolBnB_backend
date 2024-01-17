@extends('layouts.guest')

@section('content')
{{-- title home guest --}}
    <h1 class='text-center text-title'>Boolbnb</h1>

{{-- card view --}}
    <div class="container">
        @include('admin.partials.auto-complete')
    </div>
@endsection
