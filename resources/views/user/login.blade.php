<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>loging</title>
</head>
<body>
    <nav class="w-full bg-crema-clarisimo p-3 grid grid-cols-15">
        <div class="col-span-14 pl-5">
            <h1>FINYX</h1>
        </div>
        <div>
            <a href="{{ route('registro.create') }}">Registro</a>
        </div>
    </nav>

    @if (session('success'))
        <div class=" bg-alert-success border border-border-alert-success 
        text-text-alert-success px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="flex items-center justify-center mt-20">
        <div class="border border-blanco-calido shadow shadow-gris-calido-claro p-8 rounded-lg">
            <div class="text-center">
                    <h1>INICIAR SESION</h1>
                </div>
            <form action="{{ route('login.store') }}" method="POST">
                @csrf

                <div class="mb-5">
                    <label for="">usuario</label>
                    <input type="text" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg 
                                    text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco 
                                    focus:border-linea-foco transition-all" name="email">
                </div>

                <div class="mb-5">
                    <label for="">contraseña</label>
                    <input type="password" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg 
                                    text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco 
                                    focus:border-linea-foco transition-all" name="password">
                </div>

                @if (session('error'))
                    <div class="bg-alert-error border border-border-alert-error 
                    text-text-alert-error px-4 py-3 rounded mb-5">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="flex items-center pt-4 border-t border-gris-calido-claro">
                    <button type="submit" class="bg-verde-salvia hover:bg-verde-salvia-claro rounded-sm p-3 w-full">
                        iniciar sesion
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>