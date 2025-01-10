<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Konsultasi Psikolog</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #3498db;
            color: #fff;
            text-align: center;
            padding: 20px;
            font-size: 2em;
        }
        h1 {
            color: #343a40;
            margin: 20px 0;
        }
        .alert {
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .alert.success {
            background-color: #d4edda;
            color: #155724;
        }
        .alert.error {
            background-color: #f8d7da;
            color: #721c24;
        }
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #3498db;
            color: white;
        }
        td {
            background-color: #fff;
            color: #343a40;
        }
        tr:nth-child(even) td {
            background-color: #f8f9fa;
        }
        button {
            padding: 8px 16px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #2980b9;
        }
        footer {
            text-align: center;
            padding: 15px;
            background-color: #3498db;
            color: white;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <header>Jadwal Konsultasi Psikolog</header>

    <main>
        <h1>Jadwal Konsultasi yang Tersedia</h1>

        <div id="message"></div> <!-- Tempat untuk menampilkan pesan error/sukses -->

        <table id="schedule-table" style="display:none;"> <!-- Menyembunyikan tabel jika tidak ada jadwal -->
            <thead>
                <tr>
                    <th>ID Jadwal</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Nama Psikolog</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data jadwal akan dimuat di sini menggunakan JavaScript -->
            </tbody>
        </table>

    </main>

    <script>
        // Fetch data jadwal dari API
        fetch('/appointments/available') // Ganti dengan URL yang sesuai
            .then(response => response.json())
            .then(data => {
                if (data.length === 0) {
                    // Menampilkan pesan jika tidak ada jadwal
                    document.getElementById('message').innerHTML = '<div class="alert error">Tidak ada jadwal yang tersedia saat ini.</div>';
                } else {
                    // Menampilkan tabel dan memasukkan data jadwal
                    const table = document.getElementById('schedule-table');
                    const tableBody = table.querySelector('tbody');
                    data.forEach(schedule => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${schedule.id}</td>
                            <td>${schedule.schedule_date}</td>
                            <td>${schedule.schedule_time}</td>
                            <td>${schedule.psychologist_name}</td>
                            <td><a href="/book-schedule/${schedule.id}"><button>Pesan</button></a></td>
                        `;
                        tableBody.appendChild(row);
                    });
                    table.style.display = 'table'; // Menampilkan tabel setelah data dimuat
                }
            })
            .catch(error => {
                document.getElementById('message').innerHTML = '<div class="alert error">Terjadi kesalahan saat mengambil data jadwal.</div>';
            });
    </script>

</body>
</html>
