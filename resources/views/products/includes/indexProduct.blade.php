<div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('products.show', ['product' => $product->id]) }}">{{ $product->type->name }}</a>
            </h4>
            <p class="card-text">
                @isset($product->type->specifications)
                    @foreach($product->type->specifications as $spec => $value)
                        {{$spec}}: {{ $value }} <br>
                    @endforeach
                @endisset
            </p>
        </div>
        <div class="card-footer">
            <small class="text-muted">{{ $product->serialnumber }}</small>
        </div>
    </div>
</div>
