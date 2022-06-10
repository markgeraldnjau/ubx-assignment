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

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/notify.min.js') }}"></script>

</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">

        <!-- Page Content -->
        <main class="py-12">

            <div class="flex justify-center">
                <div class="flex space-x-4">
                    <div>
                        <form id="excelForm" method="POST" action="{{ route('uploadExcel') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="excel-array" name="excel_array">
                            <label for="file-input"
                                class="text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Select excel
                                file</label>
                            <div class="relative">
                                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="file" accept=".xls,.xlsx" id="file-input" name="excel_file"
                                    onchange="getExcelFile()"
                                    class="block p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                                <button type="button" onclick="document.getElementById('file-input').click();"
                                    class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                            </div>
                        </form>
                    </div>
                    <div class=" mt-2">
                        <button type="submit" form="excelForm"
                            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            UPLOAD
                        </button>
                    </div>
                </div>
            </div>
            <div class=" mt-8 flex justify-center">
                <a type="button" href="{{ route('getExcelData') }}"
                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    View Data
                </a>
            </div>

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

        </main>
    </div>
</body>


</html>
