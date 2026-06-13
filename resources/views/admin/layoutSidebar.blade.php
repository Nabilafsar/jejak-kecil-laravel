<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jejak Kecil - Admin</title>
    @vite(['resources/css/app.css', 'resources/css/sidebar.css', 'resources/js/app.js'])
</head>
<body>

    {{-- Sidebar --}}
    @include('components.sidebar')

    {{-- Konten Utama --}}
    <main class="main-content">
        @yield('content')
    </main>

    @include('components.sidebar-script')

</body>
</html>