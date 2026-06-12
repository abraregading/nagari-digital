<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar — {{ $settings['site_name'] ?? 'Nagari Digital' }}</title>
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
    <p class="login-card__sub">Client Area</p>
    <h2 class="login-card__title">Daftar Akun Baru</h2>

    @if($errors->any())
    <div class="login-form__error show">{{ $errors->first() }}</div>
    @endif

    @if(session('status'))
    <div class="login-form__error show">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('register') }}" autocomplete="off">
      @csrf
      <div class="login-form__group">
        <label class="login-form__label">Nama Lengkap</label>
        <div class="login-form__input-wrap"><i class="fa-solid fa-user"></i><input type="text" name="name" class="login-form__input" placeholder="Nama lengkap" value="{{ old('name') }}" required></div>
      </div>
      <div class="login-form__group">
        <label class="login-form__label">Email</label>
        <div class="login-form__input-wrap"><i class="fa-solid fa-envelope"></i><input type="email" name="email" class="login-form__input" placeholder="Masukkan email" value="{{ old('email') }}" required></div>
      </div>
      <div class="login-form__group">
        <label class="login-form__label">Nomor Telepon / WA</label>
        <div class="login-form__input-wrap"><i class="fa-solid fa-phone"></i><input type="text" name="phone" class="login-form__input" placeholder="0812xxxxxx" value="{{ old('phone') }}" required></div>
      </div>
      <div class="login-form__group">
        <label class="login-form__label">Password</label>
        <div class="login-form__input-wrap"><i class="fa-solid fa-lock"></i><input type="password" name="password" class="login-form__input" placeholder="Minimal 6 karakter" required></div>
      </div>
      <div class="login-form__group">
        <label class="login-form__label">Konfirmasi Password</label>
        <div class="login-form__input-wrap"><i class="fa-solid fa-lock"></i><input type="password" name="password_confirmation" class="login-form__input" placeholder="Ulangi password" required></div>
      </div>
      <button type="submit" class="btn-login"><span class="btn-text">Daftar</span></button>
    </form>
    <div class="login-card__footer">
      Sudah punya akun? <a href="{{ route('login') }}">Masuk</a><br>
      <a href="{{ route('home') }}">&larr; Kembali ke Beranda</a>
    </div>
  </div>
</body>
</html>
