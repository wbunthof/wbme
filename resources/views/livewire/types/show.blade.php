<div>
    <div class="container mt-4">
        <h1>@if($type->brand){{ $type->brand }} - @endif{{ $type->name }}</h1>
        <h2>Specificaties:</h2>
        <ul>
            @isset($type->specifications)
                @foreach($type->specifications as $spec => $value)
                    @if($loop->index == $edit)
                        {{ Str::of($spec)->ucfirst() }}:
                        <div>{{ $editValue }}</div><br>
                        <div class="form-inline">

                            <input class="form-control" type="text" wire:model="editValue">
                            <button class="btn btn-primary m-2"     wire:click="specOpslaan('{{$spec}}', '{{ $value }}')">Opslaan</button>
                        </div>
                    @else
                        <p wire:click="specToEdit({{$loop->index}}, '{{$value}}')">
                            {{ Str::of($spec)->ucfirst() }}: {{ Str::of($value)->ucfirst() }}
                        </p>
                    @endif
                @endforeach
            @endisset
            {{--        TODO: opslaan van specificatie afmaken--}}
        </ul>

        <h2>Alle producten:</h2>
        <ul>
            @foreach($type->products->sortBy('serialnumber') as $product)
                <a href=" {{ route('products.show', ['product' => $product->id]) }}" style="color: black">
                    <b>Serienummer:</b> {{ $product->serialnumber }} <br>
                    <b>Gekocht op: </b> {{ $product->buyed_at->toFormattedDateString() }}
                    <hr>
                </a>
            @endforeach
        </ul>
    </div>
</div>
