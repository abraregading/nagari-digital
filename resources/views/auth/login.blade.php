<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login — Admin Nagari Digital</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('admin/css/admin.css') }}">
</head>
<body class="login-page">
  <div class="login-page__orb login-page__orb--1"></div>
  <div class="login-page__orb login-page__orb--2"></div>
  <div class="login-page__grid"></div>
  <div class="login-card">
    <div class="login-card__logo"><i class="fa-solid fa-leaf"></i><span>Nagari<span class="login-card__logo-accent">Digital</span></span></div>
    <p class="login-card__sub">Panel Administrator</p>
    <h2 class="login-card__title">Masuk ke Akun</h2>

    @if($errors->any())
    <div class="login-form__error show">{{ $errors->first() }}</div>
    @endif

    @if(session('status'))
    <div class="login-form__error show">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('authenticate') }}" autocomplete="off">
      @csrf
      <div class="login-form__group">
        <label class="login-form__label">Email</label>
        <div class="login-form__input-wrap"><i class="fa-solid fa-user"></i><input type="email" name="email" class="login-form__input" placeholder="Masukkan email" value="{{ old('email', 'admin@nagaridigital.web.id') }}" required></div>
      </div>
      <div class="login-form__group">
        <label class="login-form__label">Password</label>
        <div class="login-form__input-wrap"><i class="fa-solid fa-lock"></i><input type="password" name="password" class="login-form__input" placeholder="Masukkan password" required></div>
      </div>
      <div class="login-form__options">
        <label class="login-form__checkbox"><input type="checkbox" name="remember" checked> Ingat saya</label>
      </div>
      <button type="submit" class="btn-login"><span class="btn-text">Masuk</span></button>
    </form>
    <div class="login-card__footer">&copy; {{ date('Y') }} Nagari Digital. All Rights Reserved.<br><a href="{{ route('home') }}">&larr; Kembali ke Beranda</a></div>
  </div>
</body>
</html>
