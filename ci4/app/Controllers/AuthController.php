<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class AuthController extends ResourceController
{
    // Public function for user registration
    public function register()
    {
        $userModel = new UserModel();
        $data = $this->request->getJSON(true); // Get input JSON as an array

        // Hash the password before saving (using bcrypt)
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

        // Save the user data
        if ($userModel->save($data)) {
            return $this->respondCreated(['message' => 'User registered successfully']);
        }

        return $this->fail($userModel->errors());
    }

    // Public function for user login
    public function login()
    {
        $userModel = new UserModel();
        $data = $this->request->getJSON(true); // Get input JSON as an array

        // Validasi input
        if (empty($data['email']) || empty($data['password'])) {
            return $this->failValidationErrors('Email dan password wajib diisi');
        }

        // Cari user berdasarkan email
        $user = $userModel->where('email', $data['email'])->first();

        if (!$user) {
            return $this->failNotFound('User dengan email ini tidak ditemukan');
        }

        // Verifikasi password yang diberikan
        if (!password_verify($data['password'], $user['password'])) {
            return $this->failUnauthorized('Password yang Anda masukkan salah');
        }

        // Jika login berhasil, bisa mengembalikan token atau data user
        // Misalnya menggunakan session atau JWT untuk autentikasi yang lebih kompleks
        // Di sini kita akan mengembalikan pesan sukses
        return $this->respond(['message' => 'Login berhasil', 'user' => $user]);
    }

    // Public function for forgot password (request reset)
    public function forgotPassword()
    {
        $userModel = new UserModel();
        $data = $this->request->getJSON(true); // Get input JSON as an array

        // Validasi email
        if (empty($data['email'])) {
            return $this->failValidationErrors('Email wajib diisi');
        }

        // Cari user berdasarkan email
        $user = $userModel->where('email', $data['email'])->first();

        if (!$user) {
            return $this->failNotFound('Email tidak terdaftar');
        }

        // Generate token untuk reset password (misalnya menggunakan random string)
        $resetToken = bin2hex(random_bytes(50)); // Generate random token

        // Simpan token dan expired time (misalnya 1 jam)
        $userModel->update($user['id'], [
            'reset_token' => $resetToken,
            'reset_token_expiry' => date('Y-m-d H:i:s', time() + 3600) // Token expired in 1 hour
        ]);

        // Kirim email dengan link reset password
        $this->sendResetPasswordEmail($data['email'], $resetToken);

        return $this->respond(['message' => 'Link reset password telah dikirim ke email Anda']);
    }

    // Fungsi untuk mengirimkan email reset password
    private function sendResetPasswordEmail($email, $resetToken)
    {
        $emailService = \Config\Services::email();
        $emailService->setTo($email);
        $emailService->setSubject('Reset Password');
        $emailService->setMessage('Klik link berikut untuk mereset password Anda: ' .
            base_url("auth/reset-password?token=" . $resetToken));

        // Kirim email
        if (!$emailService->send()) {
            return $this->failServerError('Gagal mengirim email reset password');
        }
    }

    // Public function for reset password (set new password)
    public function resetPassword()
    {
        $userModel = new UserModel();
        $data = $this->request->getJSON(true); // Get input JSON as an array

        // Validasi input
        if (empty($data['token']) || empty($data['password'])) {
            return $this->failValidationErrors('Token dan password wajib diisi');
        }

        // Cari user berdasarkan token yang diberikan
        $user = $userModel->where('reset_token', $data['token'])->first();

        if (!$user) {
            return $this->failNotFound('Token tidak valid');
        }

        // Cek apakah token sudah expired
        if (strtotime($user['reset_token_expiry']) < time()) {
            return $this->failForbidden('Token reset password sudah kedaluwarsa');
        }

        // Update password baru dan hapus token reset
        $userModel->update($user['id'], [
            'password' => password_hash($data['password'], PASSWORD_BCRYPT),
            'reset_token' => null,
            'reset_token_expiry' => null
        ]);

        return $this->respond(['message' => 'Password berhasil direset']);
    }


}