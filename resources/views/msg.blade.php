`<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="antialiased">
        <div class="min-h-screen bg-gray-100">
            @livewire('message-preview')
        </div>
        @livewireScripts
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.0.0/dist/alpine.min.js" defer></script>
        <script>
            document.addEventListener('alpine:init', () => {
                console.log('Alpine.js initialized');
            });

        document.addEventListener('livewire:load', function () {
            console.log('Livewire is loaded');
            Livewire.on('fileUploadError', (message) => {
                Alpine.store('messagePreview').error = message;
            });
        });
    </script>
</body>
</html>`