<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GazeRoute — Поиск грузов для 4м Газелей</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-gray-900 text-white selection:bg-indigo-500 selection:text-white">

    <!-- Навигация -->
    {{-- <nav class="flex items-center justify-between p-6 lg:px-8 max-w-7xl mx-auto" aria-label="Global">
        <div class="flex lg:flex-1">
            <a href="/" class="-m-1.5 p-1.5 text-2xl font-bold tracking-tight text-indigo-400">
                Gaze<span class="text-white">Route</span>
            </a>
        </div>
        <div class="flex gap-x-6">
            <a href="{{ route('cargos.index') }}" class="text-sm font-semibold leading-6 hover:text-indigo-400 transition">Все грузы</a>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm font-semibold leading-6 hover:text-indigo-400 transition">Личный кабинет</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold leading-6 hover:text-indigo-400 transition">Войти</a>
                    <a href="{{ route('register') }}" class="rounded-md bg-indigo-500 px-3.5 py-2 text-sm font-semibold shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 transition">Регистрация</a>
                @endauth
            @endif
        </div>
    </nav> --}}

    <!-- Hero Секция -->
    <!-- Навигация с Alpine.js для мобильного меню -->
    <nav x-data="{ open: false }" class="relative flex items-center justify-between p-4 lg:px-8 max-w-7xl mx-auto">
        <div class="flex lg:flex-1">
            <a href="/" class="text-xl font-bold tracking-tight text-indigo-400">
                Gaze<span class="text-white">Route</span>
            </a>
        </div>

        <!-- Кнопка гамбургера (видима только на мобилках < 1024px) -->
        <div class="flex lg:hidden">
            <button @click="open = !open" type="button"
                class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-400">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    <path x-show="open" stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Меню для десктопа -->
        <div class="hidden lg:flex lg:gap-x-8 lg:items-center">
            <a href="{{ route('cargos.index') }}" class="text-sm font-semibold hover:text-indigo-400 transition">Все
                грузы</a>
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm font-semibold hover:text-indigo-400 transition">Кабинет</a>
            @else
                <a href="{{ route('login') }}" class="text-sm font-semibold hover:text-indigo-400 transition">Войти</a>
                <a href="{{ route('register') }}"
                    class="rounded-md bg-indigo-500 px-4 py-2 text-sm font-semibold hover:bg-indigo-400 transition">Регистрация</a>
            @endauth
        </div>

        <!-- Мобильное выпадающее меню -->
        <div x-show="open" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            class="absolute top-full left-0 right-0 z-50 mt-2 p-4 bg-gray-800 border border-gray-700 rounded-xl shadow-2xl lg:hidden">
            <div class="flex flex-col gap-y-4">
                <a href="{{ route('cargos.index') }}" class="text-base font-semibold py-2 border-b border-gray-700">Все
                    грузы</a>
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-base font-semibold py-2">Личный кабинет</a>
                @else
                    <a href="{{ route('login') }}" class="text-base font-semibold py-2">Войти</a>
                    <a href="{{ route('register') }}" class="text-base font-semibold py-2 text-indigo-400">Регистрация</a>
                @endauth
            </div>
        </div>
    </nav>

    


    <!-- Секция Преимуществ -->
    <div class="bg-gray-800/50 py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:text-center">
                <h2 class="text-base font-semibold leading-7 text-indigo-400 italic">Почему GazeRoute?</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight sm:text-4xl">Всё, что нужно для стабильной работы</p>
            </div>
            <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
                <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-row-3 lg:max-w-none lg:grid-cols-3">
                    <!-- Преимущество 1 -->
                    <div
                        class="flex flex-col items-center text-center p-6 rounded-2xl bg-gray-900 border border-gray-700">
                        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-500 text-2xl">
                            📦</div>
                        <dt class="text-xl font-semibold leading-7">Только 4 метра</dt>
                        <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-400">
                            Вам не нужно листать сотни объявлений для фур. Все грузы адаптированы под габариты
                            стандартной Газели.
                        </dd>
                    </div>
                    <!-- Преимущество 2 -->
                    <div
                        class="flex flex-col items-center text-center p-6 rounded-2xl bg-gray-900 border border-gray-700">
                        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-500 text-2xl">⚡
                        </div>
                        <dt class="text-xl font-semibold leading-7">Мгновенная связь</dt>
                        <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-400">
                            Прямые контакты заказчиков без посредников и лишних комиссий. Договаривайтесь на месте.
                        </dd>
                    </div>
                    <!-- Преимущество 3 -->
                    <div
                        class="flex flex-col items-center text-center p-6 rounded-2xl bg-gray-900 border border-gray-700">
                        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-500 text-2xl">
                            📱</div>
                        <dt class="text-xl font-semibold leading-7">Удобно с телефона</dt>
                        <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-400">
                            Современный интерфейс, который летает даже при слабом интернете в дороге.
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    <div class="mx-auto max-w-2xl py-20 sm:py-48 lg:py-56 text-center">
    <h1 class="text-3xl font-bold tracking-tight px-4 sm:text-6xl bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 to-cyan-400">
        Логистика для тех, кто на 4 метрах
    </h1>
    <p class="mt-4 text-base px-6 leading-7 text-gray-400 sm:text-lg sm:leading-8">
        Специализированный сервис поиска грузов для владельцев Газелей. Никаких фур — только ваша ниша.
    </p>
    
    <!-- Блок кнопок с адаптивными отступами -->
    <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-x-6">
        <a href="{{ route('cargos.index') }}" 
           class="w-[80%] sm:w-auto rounded-full bg-indigo-500 px-5 py-2.5 text-sm font-semibold text-white shadow-lg hover:bg-indigo-400 transition sm:px-8 sm:py-4 sm:text-lg">
            Найти груз
        </a>
        <a href="{{ route('register') }}" 
           class="text-sm font-semibold leading-6 hover:text-indigo-400 transition sm:text-lg">
            Разместить машину <span aria-hidden="true">→</span>
        </a>
    </div>
</div>


    <!-- Подвал -->
    <footer class="border-t border-gray-800 py-12 text-center text-gray-500 text-sm">
        <p>&copy; {{ date('Y') }} GazeRoute. Разработано для водителей.</p>
    </footer>
</body>

</html>
