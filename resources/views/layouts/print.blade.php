<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- viewport meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name'))</title>

    <!-- inject:css -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <!-- endinject -->

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">

    <style>
        @media screen {
            body {
                border-top: 0;
                background-color: rgba(0, 0, 0, 0.65);
            }

            .wrapper {
                max-width: 1200px;
                margin: 5rem auto;
                box-shadow: 0 2px 4px 0 rgba(0,0,0,0.10);
                background-color: white;
                padding: 1rem;
            }

            .navbar {
                box-shadow: 0 2px 4px 0 rgba(0,0,0,0.10);

            }
            .navbar .navbar-brand {
                line-height: inherit;
                white-space: nowrap;
            }
        }
        @media print {
            body {
                border-top: 0;
            }

            .page-break {
                page-break-before: always;
            }

            .no-page-break {
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body>
<nav class="navbar fixed pin-t bg-grey-lighter relative flex flex-wrap justify-between items-center py-2 px-4">
    <span class="inline-block py-1 mr-4 font-lg text-black">{{ trans('global.print_preview') }}</span>

    <form class="inline-block">
        <button onclick="window.print()" class="btn btn-sm btn-primary" type="button">{{ trans('global.print') }}</button>
    </form>
</nav>

<div class="wrapper">
    @yield('content')
</div>

</body>
</html>
