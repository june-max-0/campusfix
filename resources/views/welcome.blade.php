<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CampusFix – Campus Maintenance Requests</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <!-- HEADER + NAVIGATION -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-700">CampusFix</a>
            <nav class="flex items-center gap-5 text-sm font-medium">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-700">Home</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-700">Dashboard</a>
                    <a href="{{ route('requests.index') }}" class="text-gray-700 hover:text-blue-700">Requests</a>
                    <a href="{{ auth()->user()->role === 'admin' ? route('feedback.index') : route('feedback.create') }}" class="text-gray-700 hover:text-blue-700">Feedback</a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-700">Log in</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Register</a>
                @endauth
            </nav>
        </div>
    </header>

    <!-- BANNER -->
    <section class="bg-gradient-to-r from-blue-700 to-indigo-600 text-white">
        <div class="max-w-7xl mx-auto px-6 py-20 text-center">
            <h1 class="text-4xl sm:text-5xl font-bold mb-4">Report campus problems. Track the fix.</h1>
            <p class="text-lg text-blue-100 max-w-2xl mx-auto mb-8">
                Broken light, leaking tap, faulty aircond? Submit a maintenance request in one place
                and follow its progress until it is resolved.
            </p>
            @auth
                <a href="{{ route('requests.create') }}" class="inline-block px-6 py-3 bg-white text-blue-700 font-semibold rounded-md hover:bg-blue-50">Report a Problem</a>
            @else
                <a href="{{ route('register') }}" class="inline-block px-6 py-3 bg-white text-blue-700 font-semibold rounded-md hover:bg-blue-50">Get Started</a>
            @endauth
        </div>
    </section>

    <!-- MAIN CONTENT -->
    <main class="max-w-7xl mx-auto px-6 py-14 flex-grow">
        <h2 class="text-2xl font-bold text-center mb-10">How it works</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                <div class="text-5xl mb-3">📝</div>
                <h3 class="font-semibold text-lg mb-2">1. Submit</h3>
                <p class="text-gray-600 text-sm">Describe the problem, choose a category and add the location.</p>
            </div>
            <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                <div class="text-5xl mb-3">🔧</div>
                <h3 class="font-semibold text-lg mb-2">2. Maintenance</h3>
                <p class="text-gray-600 text-sm">The admin reviews your request and updates its status.</p>
            </div>
            <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                <div class="text-5xl mb-3">✅</div>
                <h3 class="font-semibold text-lg mb-2">3. Resolved</h3>
                <p class="text-gray-600 text-sm">Check your dashboard anytime to see when it is completed.</p>
            </div>
        </div>
    </main>

    @include('layouts.footer')
</body>
</html>