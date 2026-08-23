<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css" integrity="sha512-QeR2VH+lsBE5LSAe1Q5EnTBbe7XTBubt8dG93Y7gidSgdMCr8nVqKcfKAMyN96SV8KDbZVTDXChatu5G2KQGzg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('titulo')</title>
</head>
<body class="bg-neutral-200">
    <div
        x-data="{
            sidebarOpen: true
        }"
        class="min-h-screen"
    >
        @include('components.sidebar')
        <div
            class="transition-all duration-300"
            :class="sidebarOpen ? 'ml-64' : 'ml-20'"
        >

            {{-- Nav --}}
            @include('components.nav')

            {{-- Contenido --}}
            <main class="p-12">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>