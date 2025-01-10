<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama - Konsultasi Online</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f6f8;
        }
        header {
            background-color: #3498db;
            color: #fff;
            text-align: center;
            padding: 20px;
            font-size: 1.8em;
            font-weight: bold;
        }
        main {
            margin: 30px auto;
            padding: 20px;
            max-width: 900px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        h1 {
            color: #343a40;
            font-size: 2em;
            margin-bottom: 15px;
        }
        p {
            color: #6c757d;
            font-size: 1em;
            margin-bottom: 10px;
        }
        ul.menu {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }
        .menu li {
            flex: 1 1 calc(33.333% - 20px);
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            text-align: center;
        }
        .menu-item {
            padding: 15px;
        }
        .menu-item h2 {
            font-size: 1.2em;
            color: #3498db;
            margin-bottom: 10px;
        }
        .menu-item p {
            font-size: 0.9em;
            color: #6c757d;
        }
        .menu li:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            color: #fff;
            background-color: #3498db;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1em;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .alert {
            padding: 15px;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
        footer {
            text-align: center;
            padding: 15px;
            background-color: #3498db;
            color: #fff;
            margin-top: 30px;
            font-size: 0.9em;
            position: sticky;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>Selamat Datang di MindCare</header>
    <main>
            <h1>Haloo!!</h1>
            <p>Selamat datang di layanan konsultasi online kami. Silakan pilih salah satu menu di bawah ini:</p>
            <ul class="menu">
                <li>
                    <a href="<?= base_url('/available-schedules') ?>">
                        <div class="menu-item">
                            <h2>Jadwal Tersedia</h2>
                            <p>Temukan jadwal konsultasi available yang sesuai dengan kebutuhan Anda.</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('/bookings') ?>">
                        <div class="menu-item">
                            <h2>Konsultasi yang Dipesan</h2>
                            <p>Periksa jadwal konsultasi yang telah Anda pesan.</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('/articles') ?>">
                        <div class="menu-item">
                            <h2>Artikel</h2>
                            <p>Baca artikel dan tips tentang kesehatan mental.</p>
                        </div>
                    </a>
                </li>
            </ul>
            <a href="<?= site_url('auth/logout') ?>" class="btn">Logout</a>  
    </main>
    <footer>© 2025 Konsultasi Online. Semua Hak Dilindungi.</footer>
</body>
</html>