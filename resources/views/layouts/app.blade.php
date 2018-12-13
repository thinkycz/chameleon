<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>@yield('title', config('app.name'))</title>

    <script>
        window.baseURL = '{{ url('/') }}';
        window.currentLocale = '{{ app()->getLocale() }}';
        window.fallbackLocale = 'en';
    </script>
    <link href="{{ mix('css/app.css')}}" rel="stylesheet">
</head>
<body>
    <div id="app" v-cloak>
        @include('layouts.partials.header')
        <main>
            @yield('content')

            @auth
                <vue-basket :basket="{{ json_encode(activeBasket()) }}"></vue-basket>
            @endauth
        </main>
        @include('layouts.partials.footer')
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
