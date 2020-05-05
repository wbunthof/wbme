<div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100">
        <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('types.show', ['type' => $type->id]) }}">{{ $type->name }}@if($type->brand) - {{ $type->brand }}@endif</a>
            </h4>
            <p class="card-text">
                @isset($type->specifications)
                    @foreach($type->specifications as $spec => $value)
                        {{$spec}}: {{ $value }} <br>
                    @endforeach
                @endisset
            </p>
        </div>
{{--        <div class="card-footer">--}}
{{--            <small class="text-muted">{{ $product->serialnumber }}</small>--}}
{{--        </div>--}}
    </div>
</div>
