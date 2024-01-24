@extends('layouts.admin')

@php
    $loading = false;

@endphp

@section('content')
    <h1>SPONSOR PAGA E SORRIDI</h1>
    {{-- <form action="{{route('makePayment')}}" method="POST">
    @csrf
    @method('POST')
    <div class="container d-flex">
        @foreach ($sponsors as $sponsor)
        <div class="card col-4">
            <div class="cardtext">
                {{$sponsor->type}}
            </div>
            <div class="cardtext col-4">
                {{$sponsor->price}}$$$
            </div>
            <div class="cardtext col-4">
                {{$sponsor->duration}}H
            </div>
            <input type="radio" name="sponsor-radio" value="{{$sponsor->id}}">
        </div>
        @endforeach
    </div>
    <button class="btn btn-dark" type="submit">PAGA E SORRIDI</button>
</form> --}}


    <!-- Modal -->
    <button id="token" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        You Pay
    </button>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Make a Payment</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form method="post" action="{{ route('payment.create') }}">
                            @csrf
                            @foreach ($sponsors as $sponsor)
                                <div class="form-group">
                                    <span>{{ $sponsor->type }}</span>
                                    <input type="radio" id="{{ $sponsor->id }}" name="sponsor"
                                        value='{{ $sponsor->id }}' checked>
                                </div>
                            @endforeach
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="apartment" name="apartment"
                                    value="{{ $apartment->id }}">
                            </div>

                            <div class="form-group">
                                <label for="nonce">Payment Method Nonce</label>
                                <div id="dropin-container"></div>
                                <input type="hidden" id="nonce" name="payment_method_nonce">
                            </div>

                            <button type="submit" class="btn btn-primary">Submit Payment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Modal -->









    <script src="https://js.braintreegateway.com/web/dropin/1.35.0/js/dropin.min.js"></script>
    <script>
        var form = document.querySelector('form');


        braintree.dropin.create({
            authorization: "eyJ2ZXJzaW9uIjoyLCJhdXRob3JpemF0aW9uRmluZ2VycHJpbnQiOiJleUowZVhBaU9pSktWMVFpTENKaGJHY2lPaUpGVXpJMU5pSXNJbXRwWkNJNklqSXdNVGd3TkRJMk1UWXRjMkZ1WkdKdmVDSXNJbWx6Y3lJNkltaDBkSEJ6T2k4dllYQnBMbk5oYm1SaWIzZ3VZbkpoYVc1MGNtVmxaMkYwWlhkaGVTNWpiMjBpZlEuZXlKbGVIQWlPakUzTURZeE9UUXlORGNzSW1wMGFTSTZJbVprWldaaFpERmlMVFl5WXpZdE5ETmlZaTA0TWprM0xXSXdaamd6Tm1VeE1UYzVaaUlzSW5OMVlpSTZJbkZpZERkNmRITTBPVFV5YzJwa05tWWlMQ0pwYzNNaU9pSm9kSFJ3Y3pvdkwyRndhUzV6WVc1a1ltOTRMbUp5WVdsdWRISmxaV2RoZEdWM1lYa3VZMjl0SWl3aWJXVnlZMmhoYm5RaU9uc2ljSFZpYkdsalgybGtJam9pY1dKME4zcDBjelE1TlRKemFtUTJaaUlzSW5abGNtbG1lVjlqWVhKa1gySjVYMlJsWm1GMWJIUWlPbVpoYkhObGZTd2ljbWxuYUhSeklqcGJJbTFoYm1GblpWOTJZWFZzZENKZExDSnpZMjl3WlNJNld5SkNjbUZwYm5SeVpXVTZWbUYxYkhRaVhTd2liM0IwYVc5dWN5STZlMzE5LkoxWlJtU2o2QXQ0d1RKd2ljelRhZkE0QnZoZmZCdlZJb2wzNDBvSXl4UXJhRUsyMU1DeE40YmpuVlA0MHBRS2RxMVJNcHN2Q2J2QWwzVXJZYnFuQ1B3IiwiY29uZmlnVXJsIjoiaHR0cHM6Ly9hcGkuc2FuZGJveC5icmFpbnRyZWVnYXRld2F5LmNvbTo0NDMvbWVyY2hhbnRzL3FidDd6dHM0OTUyc2pkNmYvY2xpZW50X2FwaS92MS9jb25maWd1cmF0aW9uIiwiZ3JhcGhRTCI6eyJ1cmwiOiJodHRwczovL3BheW1lbnRzLnNhbmRib3guYnJhaW50cmVlLWFwaS5jb20vZ3JhcGhxbCIsImRhdGUiOiIyMDE4LTA1LTA4IiwiZmVhdHVyZXMiOlsidG9rZW5pemVfY3JlZGl0X2NhcmRzIl19LCJjbGllbnRBcGlVcmwiOiJodHRwczovL2FwaS5zYW5kYm94LmJyYWludHJlZWdhdGV3YXkuY29tOjQ0My9tZXJjaGFudHMvcWJ0N3p0czQ5NTJzamQ2Zi9jbGllbnRfYXBpIiwiZW52aXJvbm1lbnQiOiJzYW5kYm94IiwibWVyY2hhbnRJZCI6InFidDd6dHM0OTUyc2pkNmYiLCJhc3NldHNVcmwiOiJodHRwczovL2Fzc2V0cy5icmFpbnRyZWVnYXRld2F5LmNvbSIsImF1dGhVcmwiOiJodHRwczovL2F1dGgudmVubW8uc2FuZGJveC5icmFpbnRyZWVnYXRld2F5LmNvbSIsInZlbm1vIjoib2ZmIiwiY2hhbGxlbmdlcyI6W10sInRocmVlRFNlY3VyZUVuYWJsZWQiOnRydWUsImFuYWx5dGljcyI6eyJ1cmwiOiJodHRwczovL29yaWdpbi1hbmFseXRpY3Mtc2FuZC5zYW5kYm94LmJyYWludHJlZS1hcGkuY29tL3FidDd6dHM0OTUyc2pkNmYifSwicGF5cGFsRW5hYmxlZCI6dHJ1ZSwicGF5cGFsIjp7ImJpbGxpbmdBZ3JlZW1lbnRzRW5hYmxlZCI6dHJ1ZSwiZW52aXJvbm1lbnROb05ldHdvcmsiOnRydWUsInVudmV0dGVkTWVyY2hhbnQiOmZhbHNlLCJhbGxvd0h0dHAiOnRydWUsImRpc3BsYXlOYW1lIjoiQm9vbGVhbiIsImNsaWVudElkIjpudWxsLCJiYXNlVXJsIjoiaHR0cHM6Ly9hc3NldHMuYnJhaW50cmVlZ2F0ZXdheS5jb20iLCJhc3NldHNVcmwiOiJodHRwczovL2NoZWNrb3V0LnBheXBhbC5jb20iLCJkaXJlY3RCYXNlVXJsIjpudWxsLCJlbnZpcm9ubWVudCI6Im9mZmxpbmUiLCJicmFpbnRyZWVDbGllbnRJZCI6Im1hc3RlcmNsaWVudDMiLCJtZXJjaGFudEFjY291bnRJZCI6ImJvb2xlYW4iLCJjdXJyZW5jeUlzb0NvZGUiOiJFVVIifX0=",
            container: '#dropin-container'
        }, function(createErr, instance) {
            if (createErr) {
                console.error(createErr);
                return;
            }

            form.addEventListener('submit', function(event) {
                event.preventDefault();

                instance.requestPaymentMethod(function(err, payload) {
                    if (err) {
                        console.error(err);
                        return;
                    }

                    document.querySelector('#nonce').value = payload.nonce;
                    form.submit();
                });
            });
        });
    </script>
@endsection
