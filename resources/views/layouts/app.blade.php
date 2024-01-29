<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <div id="app">
        <nav class="bg-white">
            <div class="container mx-auto px-6">
                <div class="flex justify-between items-center p-2">
                    <h1>
                        <a class="navbar-brand" href="{{ url('/projects') }}">
                            <img src="/images/logo.svg" alt="Birdboard">
                        </a>
                    </h1>

                    <div>
                        <!-- Right Side Of Navbar -->
                        <div class="flex">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <div class="mr-6">
                                        <a class="hover:underline" href="{{ route('login') }}">Login</a>
                                    </div>
                                @endif

                                @if (Route::has('register'))
                                    <div>
                                        <a class="hover:underline" href="{{ route('register') }}">Register</a>
                                    </div>
                                @endif
                            @else
                                <div class="dropdown">
                                    <button class="w-10" onclick="toggleDropdown();">
                                        <img src="{{ gravatar_url(auth()->user()->email) }}"
                                            alt="{{ auth()->user()->name }}'s avatar"
                                            class="rounded-full">
                                    </button>

                                    <div id="dropdown-content" class="dropdown-content">
                                        <div class="-my-2 -mx-1">
                                            <p class="mb-1">{{ auth()->user()->name }}</p>

                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="hidden">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <main class="container mx-auto py-4 px-6">
            @yield('content')
        </main>
    </div>
</body>

</html>
