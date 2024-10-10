<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div id="progress-bar" class="fixed top-0 left-0 w-full h-1 bg-gray-200 z-50" style="display: none;">
        <div id="progress" class="h-full bg-blue-600 transition-all duration-500 ease-in-out" style="width: 0;"></div>
    </div>

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <livewire:layout.navigation />

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

<script>
    // Function to show the progress bar
    function showProgressBar() {
        const progressBar = document.getElementById('progress-bar');
        const progress = document.getElementById('progress');

        // Show the progress bar
        progressBar.style.display = 'block';

        // Simulate progress (you can replace this with your own logic)
        let width = 0;
        const interval = setInterval(() => {
            if (width >= 100) {
                clearInterval(interval);
                // Hide the progress bar after loading is complete
                setTimeout(() => {
                    progressBar.style.display = 'none';
                }, 300); // Hide after a short delay
            } else {
                width++;
                progress.style.width = width + '%';
            }
        }, 10); // Increase the speed of the progress bar here if needed
    }

    // Call showProgressBar on page load
    window.addEventListener('load', showProgressBar);
</script>

</html>
