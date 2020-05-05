<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    @livewireStyles

    <style>
        .site-header {
            background-color: rgba(0, 0, 0, .85);
            -webkit-backdrop-filter: saturate(180%) blur(20px);
            backdrop-filter: saturate(180%) blur(20px);
        }
        .site-header a {
            color: #999;
            transition: ease-in-out color .15s;
        }
        .site-header a:hover {
            color: #fff;
            text-decoration: none;
        }
    </style>
</head>
<body>
<nav class="site-header sticky-top py-1">
    <div class="container d-flex flex-column flex-md-row justify-content-between">
        <a class="py-2 text-white" href="#">
            WB Music & Events
        </a>
        <a class="py-2 d-none d-md-inline-block" href="{{ route('types.index') }}">Types</a>
        <a class="py-2 d-none d-md-inline-block" href="{{ route('products.index') }}">Product</a>
        <a class="py-2 d-none d-md-inline-block" href="#">Repairs</a>
        <a class="py-2 d-none d-md-inline-block" href="#">Rentals</a>
    </div>
</nav>
<div wire:offline class="alert alert-danger" role="alert">
    You're offline!
</div>
<main role="main" class="container">
    @yield('content')
</main>
</body>
<script type="text/javascript" src="{{ asset('/js/app.js') }}"></script>
 @livewireScripts
</html>
