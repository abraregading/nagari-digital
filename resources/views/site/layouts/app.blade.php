<!DOCTYPE html>
<html lang="id">
<head>
    @include('site.layouts.partials.head')
</head>
<body>

    <!-- Navigation -->
    @include('site.layouts.partials.navbar')

    <!-- Hero Section -->


    @yield('content')

    <!-- Footer -->
    <footer class="footer" id="footer">
        @include('site.layouts.partials.footer.app')
    </footer>

    <!-- WhatsApp Floating Button -->
    @include('site.layouts.partials.wa_bawah')

    <!-- Scripts -->
    @include('site.layouts.partials.scripts')
</body>
</html>
