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
            <a href="">Registro</a>
        </div>
    </nav>
    
    <div class="flex items-center justify-center mt-20">
        <div class="border border-blanco-calido shadow shadow-gris-calido-claro p-8 rounded-lg">
            <div class="text-center">
                    <h1>Registro</h1>
                </div>
            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="mb-5">
                    <label for="">nombre de usuario</label>
                    <input type="text" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg 
                                    text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco 
                                    focus:border-linea-foco transition-all" name="name">
                    @error('name')
                        <p class="bg-alert-error border border-border-alert-error text-text-alert-error px-4 py-3 rounded mb-5">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="">Correo</label>
                    <input type="text" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg 
                                    text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco 
                                    focus:border-linea-foco transition-all" name="email">
                    @error('email')
                        <p class="bg-alert-error border border-border-alert-error text-text-alert-error px-4 py-3 rounded mb-5">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="">contraseña</label>
                    <input type="password" class="w-full px-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-lg 
                                    text-sm text-gris-calido-oscuro  focus:outline-none focus:ring-2 focus:ring-linea-foco 
                                    focus:border-linea-foco transition-all" name="password">
                    @error('password')
                        <p class="bg-alert-error border border-border-alert-error text-text-alert-error px-4 py-3 rounded mb-5">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col items-center pt-4 border-t border-gris-calido-claro">
                    <button type="submit" 
                    class="bg-verde-salvia hover:bg-verde-salvia-claro rounded-sm p-3 w-full text-blanco-calido capitalize my-3">
                        registro
                    </button>
                    <a href="{{ route('user.index') }}"
                        class="w-full bg-gris-calido-claro hover:bg-gris-calido-oscuro text-center capitalize text-blanco-calido rounded-sm transition-all px-2 py-2">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>