<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
        }
        h1 {
            text-align: center;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Register</h1>
    <form id="registerForm">
        <div id="errorMessage" class="error"></div>
        
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Register</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#registerForm').submit(function(event) {
            event.preventDefault();  // Mencegah form submit biasa
            
            // Mengambil data dari form
            var formData = {
                username: $('#name').val(),
                email: $('#email').val(),
                password: $('#password').val(),
            };

            // Mengirim data ke API menggunakan AJAX
            $.ajax({
                url: '/auth/register', // URL API untuk registrasi
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(formData),
                success: function(response) {
                    // Jika registrasi berhasil, arahkan ke halaman utama
                    window.location.href = '/';  // Mengarahkan ke halaman utama
                },
                error: function(response) {
                    // Tampilkan pesan error jika gagal
                    $('#errorMessage').text('Error: ' + response.responseJSON.message);
                }
            });
        });
    </script>
</body>
</html>
