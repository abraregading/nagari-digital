<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="{{ $settings['seo_description'] ?? 'Nagari Digital — Platform digital terintegrasi untuk pemerintahan Nagari/Desa.' }}">
<meta name="keywords" content="{{ $settings['seo_keywords'] ?? 'Nagari digital, desa digital' }}">
<title>{{ $settings['site_name'] ?? 'Nagari Digital' }} — {{ $settings['tagline'] ?? 'Platform Digital Terintegrasi untuk Pemerintahan Nagari' }}</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('site/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('site/css/home.css') }}">
@stack('styles')
