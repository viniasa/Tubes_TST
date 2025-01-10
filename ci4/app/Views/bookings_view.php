<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal yang Sudah Dipesan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #28a745;
            color: #fff;
            text-align: center;
            padding: 20px;
            font-size: 2em;
        }
        h1 {
            color: #333;
            text-align: center;
            margin: 20px 0;
        }
        .alert {
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .alert.info {
            background-color: #d1ecf1;
            color: #0c5460;
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
        footer {
            text-align: center;
            padding: 15px;
            background-color: #28a745;
            color: white;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <header>Jadwal yang Sudah Dipesan</header>

    <main>
        <h1>Daftar Jadwal Anda</h1>

        <div id="message"></div> <!-- Tempat untuk pesan info -->

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
        // Fetch jadwal yang sudah dipesan oleh user berdasarkan ID user
        fetch('/booked/' + encodeURIComponent('user_id')) // Ganti 'user_id' dengan ID user dari sesi login
            .then(response => response.json())
            .then(data => {
                if (data.length === 0) {
                    document.getElementById('message').innerHTML = '<div class="alert info">Belum ada jadwal yang dipesan.</div>';
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
                document.getElementById('message').innerHTML = '<div class="alert error">Terjadi kesalahan saat mengambil data jadwal.</div>';
            });
    </script>

</body>
</html>
