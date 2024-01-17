<script>
    const query = document.getElementById("search");
    query.addEventListener('change', event => {
        let count = 0;
        if (query.length > 0) {
            count++;
            alert("Modifica " + count);
        }
    });

</script>

<div class="form-group mt-5">
    <label for="city" class="form-label">Cerca</label>
    <input autoComplete="home city" type="text" class= "form-control"
        value="" id="search" name="" >
</div>
@error('city')
    <p class="text-danger">La data di creazione è un campo obbligatorio</p>
@enderror
