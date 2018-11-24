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
    <div id="app" v-cloak>
        <h1>Testing</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque id nisi enim. Vivamus tempor laoreet venenatis. Nunc porttitor sit amet eros sit amet egestas. Suspendisse aliquet tellus et egestas tempor. Quisque arcu odio, ullamcorper quis orci nec, malesuada tempus lectus. Maecenas orci est, viverra ac leo in, molestie eleifend nibh. Proin at nisi ut dui maximus condimentum vitae cursus tortor. Sed sit amet sapien placerat, convallis sapien a, blandit diam. Suspendisse in lectus sem. Integer eu purus tortor. Suspendisse potenti. Phasellus luctus dolor id velit gravida, sed laoreet velit interdum. Nunc mattis lacus sit amet euismod iaculis. Sed urna nulla, varius vitae ante id, aliquam porta ligula. Nunc bibendum laoreet erat at faucibus. Duis quis dapibus augue, sit amet varius ipsum.</p>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
