<div class="container mt-4">
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Types</h1>
            <p class="lead text-muted">Deze pagina geeft alle types weer.</p>
            <br>
            <div class="form-inline justify-content-center">
                <label class="sr-only" for="serialnumber">Serialnumber</label>
                <input type="text" wire:model="name" class="form-control m-2" placeholder="Naam van het type">
                                @error('name') <span class="error">{{ $name }}</span> @enderror

                <input type="text" wire:model="brand" class="form-control m-2" placeholder="Merk van het type">
                                @error('brand') <span class="error">{{ $brand }}</span> @enderror

                <button wire:click="addType" class="btn btn-primary m-2" type="submit">Voeg type toe</button>
            </div>
        </div>
    </section>
    <section>
        <input type="text" wire:model="typeSearch" class="form-control" placeholder="Typ om te zoeken">
        <br>
        <div class="row">
            @foreach($types->sortByDesc('updated_at')->take(6) as $type)
                @include('types.includes.indexType', ['type' => $type])
            @endforeach
        </div>
    </section>
</div>
