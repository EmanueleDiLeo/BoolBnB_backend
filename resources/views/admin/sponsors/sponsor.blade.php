@extends('layouts.admin')

@section('content')

<h1>SPONSOR PAGA E SORRIDI</h1>
<form action="">

    <select class="form-select" aria-label="Default select example">
        <option selected>Open this select menu</option>
        @foreach ($sponsors as $sponsor)
            <option value="{{$sponsor->id}}">{{$sponsor->type}}</option>
        @endforeach
    </select>

    <button class="btn btn-dark" type="submit">PAGA E SORRIDI</button>
</form>

@endsection
