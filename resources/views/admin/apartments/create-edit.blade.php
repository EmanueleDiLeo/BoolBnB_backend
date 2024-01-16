@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="text-center w-100 text-title mb-3">{{ $title }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ $route }}" method="POST" class="my-5 was-validated" enctype='multipart/form-data' novalidate>
            @csrf
            @method($method)


{{-- appartment name------------------------------------------ --}}
        <div class="mb-3">
            <label for="title" class="form-label">Nome Appartamento*</label>
            <input type="text" class="@error('title') is-invalid @enderror form-control" id="title"
            name="title" value="{{ old('title', $apartment?->title) }}" required minlength="2">
            <div class="text-danger invalid-feedback">questo campo è obbligatorio</div>
        </div>

        @error('title')
        <p class="text-danger">Il nome è un campo obbligatorio</p>
        @enderror

{{-- /appartment name------------------------------------------ --}}

{{-- room number section--------------------------------------- --}}
        <div class="mb-3">
            <label for="room_number" class="form-label">Numero stanze*</label>
            <input type="number" class="@error('room_number') is-invalid @enderror form-control" id="room_number"
            name="room_number" value="{{ old('room_number', $apartment?->room_number) }}" required min="1">
            <div class="invalid-feedback">questo campo è obbligatorio</div>
        </div>


        @error('room_number')
            <p class="text-danger">La data di creazione è un campo obbligatorio</p>
        @enderror
{{-- /room number section--------------------------------------- --}}


{{-- /bed number section--------------------------------------- --}}
        <div class="mb-3">
            <label for="bed_number" class="form-label">Posti letto*</label>
            <input type="number" class="@error('bed_number') is-invalid @enderror form-control" id="bed_number"
                name="bed_number" value="{{ old('bed_number', $apartment?->bed_number) }}" required min="1">
            <div class="invalid-feedback">questo campo è obbligatorio</div>
        </div>


        @error('bed_number')
            <p class="text-danger">La data di creazione è un campo obbligatorio</p>
        @enderror
{{-- /bed number section--------------------------------------- --}}

{{-- bathroom number section--------------------------------------- --}}
        <div class="mb-3">
            <label for="bathroom_number" class="form-label">Numero bagni*</label>
            <input type="number" class="@error('bathroom_number') is-invalid @enderror form-control"
                id="bathroom_number" name="bathroom_number"
                value="{{ old('bathroom_number', $apartment?->bathroom_number) }}" required min="1">
            <div class=" invalid-feedback">questo campo è obbligatorio</div>
        </div>


        @error('bathroom_number')
            <p class="text-danger">La data di creazione è un campo obbligatorio</p>
        @enderror
{{-- /bathroom number section--------------------------------------- --}}

{{-- sq metres section--------------------------------------- --}}
        <div class="mb-3">
            <label for="sq_metres" class="form-label">Metri quadrati*</label>
            <input type="number" class="@error('sq_metres') is-invalid @enderror form-control" id="sq_metres"
                name="sq_metres" value="{{ old('sq_metres', $apartment?->sq_metres) }}" required min="9">
            <div class=" invalid-feedback">questo campo è obbligatorio</div>
        </div>


        @error('sq_metres')
            <p class="text-danger">La data di creazione è un campo obbligatorio</p>
        @enderror
{{-- /sq metres section--------------------------------------- --}}

{{-- address section--------------------------------------- --}}
        <div class="row">
            <div class="mb-3 col-6">
                <label for="city" class="form-label">Città</label>
                <input type="text" class="@error('city') is-invalid @enderror form-control"
                    id="city" name="city" value="{{ old('city', $city) }}">
            </div>
            @error('city')
                <p class="text-danger">La data di creazione è un campo obbligatorio</p>
            @enderror

            <div class="mb-3 col-6">
                <label for="road" class="form-label">Via</label>
                <input type="text" class="@error('road') is-invalid @enderror form-control" id="road" name="road" value="{{ old('road', $road) }}">
            </div>
            @error('road')
                <p class="text-danger">La data di creazione è un campo obbligatorio</p>
            @enderror
        </div>
{{-- /address section--------------------------------------- --}}

{{-- image section--------------------------------------- --}}
        <div class="mb-3">
            <label for="img" class="form-label">Immagine*</label>
            <input id="img" class="form-control @error('img') is-invalid @enderror" name="img" type="file"
                onchange="showUpload(event)" value="{{ old('img', $apartment?->img) }}" required accept="image/jpeg, image/jpg, image/png, image/webp">

            <div class="invalid-feedback">questo campo è obbligatorio</div>
            <div class="valid-feedback"></div>

            @error('img')
                <p class="text-danger">{{ $img }}</p>
            @enderror
            <img id="thumb" width="150" onerror="this.src='/img/placeholder.webp'"
                src="{{ asset('storage/' . $apartment?->img) }}" />
        </div>

        <script>
            function showUpload(event) {
                const thumb = document.getElementById('thumb');
                thumb.src = URL.createObjectURL(event.target.files[0]);
            }
        </script>
{{-- /image section--------------------------------------- --}}

{{-- visible and checkbox services section--------------------------------------- --}}
        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="visible" id="visible" value="1" @if ($visible == 1) checked @endif>
                <label class="form-check-label" for="visible">
                    Visibile
                </label>
            </div>
        </div>

        <div class="btn-group mb-3" role="group" aria-label="Basic checkbox toggle button group">
            <div class="customCheckBoxHolder">
                @foreach ($services as $service)
                    <input type="checkbox" id="service_{{ $service->id }}" class="form-check-input ciao"
                        name="services[]" value="{{ $service->id }} "
                        @if (
                            (!$errors->any() && $apartment?->services->contains($service)) ||
                                ($errors->any() && in_array($service->id, old('services', [])))) checked @endif {{$required}}>

                    <label for="service_{{ $service->id }}" class="customCheckBoxWrapper ciao {{$text}}">
                        <div class="customCheckBox">
                            <div class="inner">{{ $service->name }}</div>
                        </div>
                    </label>
                @endforeach
            </div>
        </div>
{{-- /visible and checkbox services section--------------------------------------- --}}

{{-- description section--------------------------------------- --}}
        <div class="form-floating mb-5">
            <textarea class="form-control" placeholder="Descrizione" id="description" name="description">
            {{ old('description', $apartment?->description) }}</textarea>
            <label class="form-label" for="description">
                descrizione
            </label>
            @error('description')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
{{-- /description section--------------------------------------- --}}

{{-- buttons section --}}
        <button type="submit" class="btn bg-success">{{ $button }}</button>
        <button type="reset" class="btn bg-danger">Annulla</button>
{{-- buttons section --}}

        </form>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>

<script>

    let serviceGroup = document.querySelectorAll(".ciao");
    let i = {{$active_services}}
    let checkedServices = []
    console.log(i);
    function getCurrentURL () {
    return window.location.href
    }

    // Example
    const url = getCurrentURL()

    console.log(url);


    serviceGroup.forEach(service => {
    service.addEventListener('change', function() {
    if (this.checked) {
        serviceGroup.forEach(service =>{
            service.removeAttribute("required")
            service.classList.remove('text-danger')
            service.classList.add('text-success')
        })
        i++
        console.log(i)
    } else {
        i--
        if(i === 0){
            serviceGroup.forEach(service =>{
                service.setAttribute("required", '')
                service.classList.remove('text-success')
                service.classList.add('text-danger')
            })
        }
        console.log(i)

    }
    });
    });

    console.log(serviceGroup)

</script>


@endsection

@section('title')
    | Crea Appartamento
@endsection
