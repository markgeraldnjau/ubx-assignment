<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Longa') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/parsley.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/parsley.min.js') }}"></script>
    <script src="{{ asset('js/notify.min.js') }}"></script>

    {{-- @bukStyles(true)
    @bukScripts(true) --}}
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>

        <!-- Page Content -->
        <main>

            @if (Session::has('status_message_failed'))
                <script type="text/javascript">
                    var notify = @json(Session::get('status_message_failed'));
                    $.notify(notify, "error", {
                        position: "right"
                    });
                </script>

            @elseif (Session::has('status_message_success'))
                <script type="text/javascript">
                    var notify = @json(Session::get('status_message_success'));
                    $.notify(notify, "success", {
                        position: "right"
                    });
                </script>
            @else
                <script type="text/javascript">
                    var notify = @json(Session::get('status_message_warning'));
                    $.notify(notify, "warn");
                </script>
            @endif

            {{ $slot }}
        </main>
    </div>
</body>

</html>
