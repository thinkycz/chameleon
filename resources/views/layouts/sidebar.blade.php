<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    @yield('title')

    <script>
        window.baseURL = '{{ url('/') }}';
        window.currentLocale = '{{ app()->getLocale() }}';
    </script>
    <link href="{{ mix('css/app.css')}}" rel="stylesheet">
</head>
<body>
    <div id="app" v-cloak class="flex flex-wrap">
        @include('layouts.partials.header')
        <div class="container">
            <div class="row">
                <aside class="w-full lg:w-1/4 px-2 py-16">
                    @yield('sidebar')
                </aside>
                <main class="w-full lg:w-3/4 px-2 py-16">
                    @yield('content')
                </main>
            </div>
        </div>
        @include('layouts.partials.footer')
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
