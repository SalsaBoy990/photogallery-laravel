<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;600;700&family=Roboto+Flex:opsz,wght@8..144,400;8..144,600;8..144,700&display=swap"
        rel="stylesheet">
    <!-- /Fonts -->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- /Styles -->

</head>

<body class="font-sans antialiased">
    <!-- Container -->
    <div class="bg-grey-400 mx-auto">
        <!-- Screen -->
        <div class="min-h-screen bg-gray-100">
            <!-- Main -->
            <main>
                {{ $slot }}
            </main>
            <!-- /Main -->

        </div>
    </div>
    <!-- /Screen -->

    </div>
    <!-- /Container -->

    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <!-- /Scripts -->

</body>

</html>
