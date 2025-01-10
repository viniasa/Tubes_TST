<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Awal</title>
</head>
<body>

    <h1>Selamat Datang di Sistem</h1>

    <?php if (session()->get('user_id')): ?>
        <!-- Jika sudah login, tampilkan Home -->
        <h2>Selamat datang, <?= session()->get('username') ?>!</h2>
        <a href="<?= site_url('auth/logout') ?>">Logout</a>
    <?php else: ?>
        <!-- Jika belum login, tampilkan pilihan untuk login, sign up, atau reset password -->
        <h2>Pilih Aksi</h2>
        
        <!-- Tautan ke halaman login -->
        <a href="<?= site_url('auth/login') ?>">Login</a> |
        
        <!-- Tautan ke halaman sign up -->
        <a href="<?= site_url('auth/signUp') ?>">Daftar</a> |
        
        <!-- Tautan ke halaman forgot password -->
        <a href="<?= site_url('auth/forgotPassword') ?>">Lupa Password?</a>
    <?php endif; ?>

</body>
</html>
