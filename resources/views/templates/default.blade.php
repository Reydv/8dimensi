<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="/public/dist/output.css" rel="stylesheet"> -->
    @include('templates.partials.head')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="icon" href="{{ asset('dist/8DLogo.png') }}" type="image/x-icon">
    <title>Tranceformasi: 8 Dimensi</title>
 
<body class="bg-[#F7F1F1] dark:bg-slate-800">
    <section id="top" class="pt-2 header">
        @include('templates.partials.navigation')
    </section>

    @yield('content')

    @include('templates.partials.footer')
    @include('templates.partials.script')
</body>
</html>