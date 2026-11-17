<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- FontAwesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Iniciar Sesión | FINYX</title>
</head>
<body class="bg-crema-clarisimo text-gris-calido-oscuro antialiased min-h-screen flex flex-col justify-between selection:bg-verde-salvia selection:text-blanco-calido">

    <!-- BARRA SUPERIOR ELEGANTE -->
    <header class="w-full py-4 px-6 sm:px-12 flex items-center justify-between border-b border-gris-calido-claro/30 bg-blanco-calido/60 backdrop-blur-sm">
        <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-lg bg-verde-salvia text-blanco-calido flex items-center justify-center font-black text-sm tracking-wider shadow-sm">
                F
            </div>
            <span class="text-lg font-black tracking-widest text-gris-calido-oscuro">FINYX</span>
        </div>
        <span class="text-xs font-medium text-estalactita-cueva hidden sm:inline-block">
            Sistema de Gestión
        </span>
    </header>

    <!-- CONTENEDOR PRINCIPAL CENTRADO -->
    <main class="flex-1 flex items-center justify-center p-4 sm:p-6 my-6">
        <div class="w-full max-w-[420px]">

            <!-- ALERTA DE ÉXITO -->
            @if (session('success'))
                <div class="bg-alert-success border border-border-alert-success text-text-alert-success px-4 py-3 rounded-xl mb-5 text-sm flex items-center gap-2.5 shadow-sm animate-fade-in">
                    <i class="fa-solid fa-circle-check text-base"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- TARJETA DE LOGIN -->
            <div class="bg-blanco-calido border border-linea-input/60 shadow-xl shadow-gris-calido-oscuro/5 rounded-2xl p-7 sm:p-9 transition-all">
                
                <!-- ENCABEZADO DE LA TARJETA -->
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-verde-salvia/15 text-verde-salvia mb-3">
                        <i class="fa-solid fa-lock text-lg"></i>
                    </div>
                    <h1 class="text-2xl font-bold tracking-tight text-gris-calido-oscuro">
                        Iniciar Sesión
                    </h1>
                    <p class="text-xs text-estalactita-cueva mt-1.5">
                        Ingresa tus credenciales para acceder a tu panel
                    </p>
                </div>

                <!-- ALERTA DE ERROR -->
                @if (session('error'))
                    <div class="bg-alert-error border border-border-alert-error text-text-alert-error px-4 py-3 rounded-xl mb-6 text-sm flex items-center gap-2.5 shadow-sm">
                        <i class="fa-solid fa-circle-exclamation text-base"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <!-- FORMULARIO -->
                <form action="{{ route('login.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <!-- CAMPO USUARIO -->
                    <div>
                        <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-gris-calido-oscuro mb-1.5">
                            Usuario
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-estalactita-cueva text-sm">
                                <i class="fa-regular fa-user"></i>
                            </span>
                            <input 
                                type="text" 
                                id="name"
                                name="name" 
                                required
                                autofocus
                                placeholder="Nombre de usuario"
                                class="w-full pl-10 pr-3.5 py-2.5 bg-blanco-calido border border-linea-input rounded-xl text-sm text-gris-calido-oscuro placeholder:text-estalactita-cueva/60 focus:outline-none focus:ring-2 focus:ring-verde-salvia/30 focus:border-verde-salvia transition-all">
                        </div>
                    </div>

                    <!-- CAMPO CONTRASEÑA -->
                    <div>
                        <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-gris-calido-oscuro mb-1.5">
                            Contraseña
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-estalactita-cueva text-sm">
                                <i class="fa-solid fa-key"></i>
                            </span>
                            <input 
                                type="password" 
                                id="password"
                                name="password" 
                                required
                                placeholder="••••••••"
                                class="w-full pl-10 pr-10 py-2.5 bg-blanco-calido border border-linea-input rounded-xl text-sm text-gris-calido-oscuro placeholder:text-estalactita-cueva/60 focus:outline-none focus:ring-2 focus:ring-verde-salvia/30 focus:border-verde-salvia transition-all">
                            
                            <!-- Botón para ver/ocultar contraseña -->
                            <button 
                                type="button" 
                                onclick="togglePasswordVisibility()" 
                                class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-estalactita-cueva hover:text-gris-calido-oscuro transition-colors cursor-pointer text-sm">
                                <i class="fa-regular fa-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                    </div>

                    <!-- BOTÓN SUBMIT -->
                    <div class="pt-2">
                        <button 
                            type="submit" 
                            class="w-full flex items-center justify-center gap-2 bg-verde-salvia hover:bg-verde-salvia-claro text-blanco-calido font-semibold text-sm py-3 px-4 rounded-xl shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5 active:translate-y-0 cursor-pointer">
                            <span>Ingresar</span>
                            <i class="fa-solid fa-arrow-right-to-bracket text-xs"></i>
                        </button>
                    </div>
                </form>

            </div>

            <!-- PIE INFORMATIVO -->
            <p class="text-center text-xs text-estalactita-cueva mt-6">
                &copy; {{ date('Y') }} <span class="font-bold">FINYX</span>. Todos los derechos reservados.
            </p>

        </div>
    </main>

    <!-- ESPACIADOR INFERIOR -->
    <div></div>

    <!-- SCRIPT PARA VER/OCULTAR CONTRASEÑA -->
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>