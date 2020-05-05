@extends('layouts.app')

@section('content')
    <div class="mt-4">
        <a class="btn btn-primary btn-block" href="{{ route('types.index') }}">Types</a>
        <a class="btn btn-primary btn-block" href="{{ route('products.index') }}">Products</a>
    </div>
    <ul>
        @foreach($products as $product)
            <ul>{{ $product->serialnumber }}</ul>
        @endforeach
    </ul>
@endsection
