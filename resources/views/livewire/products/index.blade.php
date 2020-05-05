<div class="container mt-4">
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Producten</h1>
            <p class="lead text-muted">Deze pagina geeft alle huidige producten weer.</p>
            <br>
            <div class="form-inline justify-content-center">
                <label class="sr-only" for="serialnumber">Serialnumber</label>
                <input type="text" wire:model="serialnumber" class="form-control m-2" placeholder="Serienummer">

{{--                @error('serialnumber') <span class="error">{{ $serialnumber }}</span> @enderror--}}

                <input type="date" wire:model="buyed_at" class="form-control m-2" placeholder="Gekocht op">
{{--                @error('buyed_at') <span class="error">{{ $buyed_at }}</span> @enderror--}}
                <div class="position-relative">
                    <input type="text" wire:model="type" class="form-control m-2" placeholder="Typ of selecteer">
                    <div class="position-absolute list-group bg-white w-100 m-2 align-top" style="z-index: 2">
                        <a wire:loading wire:target="updatedType" class="list-group-item">Laden....</a>
                        <div wire:loading.remove>
                            @foreach($types as $type)
                                <a href="#" class="list-group-item" wire:click="$set('type', '{{$type['name']}}')">{{ $type['name'] }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
{{--                @error('type') <span class="error">{{ $type }}</span> @enderror--}}

                <button wire:click="addProduct" class="btn btn-primary m-2" type="submit">Voeg product toe</button>
            </div>
        </div>
    </section>
    <section>
        <input type="text" wire:model="productSearch" class="form-control" placeholder="Typ om te zoeken">
        <br>
        <div class="row">
            @foreach($products->sortByDesc('updated_at')->take(6) as $product)
                @include('products.includes.indexProduct', ['product' => $product])
            @endforeach
        </div>
    </section>
</div>
