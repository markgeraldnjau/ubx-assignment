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
                <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                    <div
                        class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                        <table class="min-w-full">
                            <thead class="bg-green-500">
                                <tr class="border-solid border-2 border-gray-500">
                                    <th class="th border-solid border-2 border-gray-500 p-2">Cargo no</th>
                                    <th class="th border-solid border-2 border-gray-500 p-2">Cargo type</th>
                                    <th class="th border-solid border-2 border-gray-500 p-2">Cargo size</th>
                                    <th class="th border-solid border-2 border-gray-500 p-2">Weight (Kg)</th>
                                    <th class="th border-solid border-2 border-gray-500 p-2">Remarks</th>
                                    <th class="th border-solid border-2 border-gray-500 p-2">Wharfage (USD)</th>
                                    <th class="th border-solid border-2 border-gray-500 p-2">Penalty (Days)</th>
                                    <th class="th border-solid border-2 border-gray-500 p-2">Storage (USD)</th>
                                    <th class="th border-solid border-2 border-gray-500 p-2">Electricity (USD)</th>
                                    <th class="th border-solid border-2 border-gray-500 p-2">Destuffing(USD)</th>
                                    <th class="th border-solid border-2 border-gray-500 p-2">Lifting (USD)</th>
                                </tr>
                            </thead>
                            <tbody class="bg-blue-100">
                                @if (count($excelDatas) > 0)
                                    @foreach ($excelDatas as $excelData)
                                        <tr class="">
                                            <td class="text-center text-lg leading-5 text-gray-900 p-2 border-solid border-2 border-gray-500">
                                                {{ $excelData->cargo_no }}
                                            </td>
                                            <td class="text-center text-lg leading-5 text-gray-900 p-2 border-solid border-2 border-gray-500">
                                                {{ $excelData->cargo_type }}
                                            </td>
                                            <td class="text-center text-lg leading-5 text-gray-900 p-2 border-solid border-2 border-gray-500">
                                                {{ $excelData->cargo_size }}
                                            </td>
                                            <td class="text-center text-lg leading-5 text-gray-900 p-2 border-solid border-2 border-gray-500">
                                                {{ $excelData->weight }}
                                            </td>
                                            <td class="text-center text-lg leading-5 text-gray-900 p-2 border-solid border-2 border-gray-500">
                                                {{ $excelData->remarks }}
                                            </td>
                                            <td class="text-center text-lg leading-5 text-gray-900 p-2 border-solid border-2 border-gray-500">
                                                {{ $excelData->wharfage }}
                                            </td>
                                            <td class="text-center text-lg leading-5 text-gray-900 p-2 border-solid border-2 border-gray-500">
                                                {{ $excelData->penalty }}
                                            </td>
                                            <td class="text-center text-lg leading-5 text-gray-900 p-2 border-solid border-2 border-gray-500">
                                                {{ $excelData->storage }}
                                            </td>
                                            <td class="text-center text-lg leading-5 text-gray-900 p-2 border-solid border-2 border-gray-500">
                                                {{ $excelData->electricity }}
                                            </td>
                                            <td class="text-center text-lg leading-5 text-gray-900 p-2 border-solid border-2 border-gray-500">
                                                {{ $excelData->destuffing }}
                                            </td>
                                            <td class="text-center text-lg leading-5 text-gray-900 p-2 border-solid border-2 border-gray-500">
                                                {{ $excelData->lifting }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="pt-2">
                                        <td class="text-center" colspan="11">
                                            <div class="p-4 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg dark:bg-yellow-200 dark:text-yellow-800"
                                                role="alert">
                                                <span class="font-medium">Warning alert!</span>
                                                No Data Found!!
                                            </div>
                                        </td>

                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
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
