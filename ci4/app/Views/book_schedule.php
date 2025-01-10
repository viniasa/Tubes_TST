<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Jadwal Konsultasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #28a745;
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 2em;
        }
        main {
            margin: 20px auto;
            max-width: 800px;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            color: #343a40;
            margin-bottom: 10px;
        }
        label {
            color: #343a40;
            font-weight: bold;
        }
        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #218838;
        }
        .alert {
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .alert.error {
            background-color: #f8d7da;
            color: #721c24;
        }
        .alert.success {
            background-color: #d4edda;
            color: #155724;
        }
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #28a745;
            color: white;
        }
        td {
            background-color: #fff;
            color: #333;
        }
        tr:nth-child(even) td {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <header>Pemesanan Jadwal Konsultasi</header>

    <main>
        <h2>Pesan Jadwal</h2>

        <?php if (isset($errorMessage)): ?>
            <div class="alert error"><?= esc($errorMessage) ?></div>
        <?php endif; ?>

        <form action="<?= base_url('book/' . $appointment['id']) ?>" method="post">
            <label for="user_name">Nama Anda:</label>
            <input type="text" id="user_name" name="user_name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <input type="hidden" name="user_id" value="<?= session('user_id') ?>">
            <input type="hidden" name="appointment_id" value="<?= esc($appointment['id']) ?>">

            <button type="submit">Pesan Jadwal</button>
        </form>

        <!-- Tabel Jadwal yang Sudah Dipesan -->
        <div id="booked-message"></div>
        <table id="booked-table" style="display:none;">
            <thead>
                <tr>
                    <th>ID Jadwal</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Nama Psikolog</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data jadwal terdaftar dimuat di sini dengan JavaScript -->
            </tbody>
        </table>

    </main>

    <script>
        // Fetch data jadwal yang sudah dipesan
        fetch('/booked/' + encodeURIComponent('user_id')) // Ganti 'user_id' dengan ID user dari sesi login
            .then(response => response.json())
            .then(data => {
                if (data.length === 0) {
                    document.getElementById('booked-message').innerHTML = '<div class="alert success">Belum ada jadwal yang dipesan.</div>';
                } else {
                    const table = document.getElementById('booked-table');
                    const tableBody = table.querySelector('tbody');

                    data.forEach(schedule => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${schedule.id}</td>
                            <td>${schedule.schedule_date}</td>
                            <td>${schedule.schedule_time}</td>
                            <td>${schedule.psychologist_name}</td>
                            <td>${schedule.status}</td>
                        `;
                        tableBody.appendChild(row);
                    });
                    table.style.display = 'table';
                }
            })
            .catch(error => {
                document.getElementById('booked-message').innerHTML = '<div class="alert error">Terjadi kesalahan saat mengambil data jadwal.</div>';
            });
    </script>

</body>
</html>
