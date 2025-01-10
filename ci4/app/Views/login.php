<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
    <!-- Judul -->
    <h1 style="text-align: center; font-family: Arial, sans-serif; color: #3498db; margin-bottom: 20px;">Login</h1>

    <!-- Form untuk login -->
    <form id="login-form" style="max-width: 400px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px; background-color: #f9f9f9; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <input type="email" id="email" placeholder="Email" required style="width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; font-size: 16px;">
        <input type="password" id="password" placeholder="Password" required style="width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; font-size: 16px;">
        <button type="submit" style="width: 100%; padding: 10px; background-color: #3498db; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; margin-top: 10px;">Login</button>
    </form>

    <!-- Menampilkan pesan hasil -->
    <div id="message" class="mt-3" style="text-align: center; font-family: Arial, sans-serif;"></div>

    <script>
        // Event listener untuk form submit
        $('#login-form').on('submit', function(event) {
            event.preventDefault(); // Prevent page reload

            // Ambil data dari form
            var email = $('#email').val();
            var password = $('#password').val();

            // Kirim data ke API untuk melakukan login
            $.ajax({
                url: 'http://localhost/api/auth/login', // Ganti dengan endpoint API Anda
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    email: email,
                    password: password
                }),
                success: function(response) {
                    // Jika berhasil
                    $('#message').html('<div style="color: green;">Login berhasil!</div>');
                    // Simpan token atau data user di sini (misalnya ke localStorage atau sessionStorage)
                    // localStorage.setItem('user', JSON.stringify(response.user));
                },
                error: function(xhr, status, error) {
                    // Jika gagal
                    var errorMessage = xhr.responseJSON.message || 'Login gagal';
                    $('#message').html('<div style="color: red;">' + errorMessage + '</div>');
                }
            });
        });
    </script>
</body>
</html>
