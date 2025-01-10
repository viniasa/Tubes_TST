<?php

namespace App\Controllers;

use App\Models\AppointmentModel;
use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class AppointmentController extends ResourceController
{
    // Fungsi untuk menampilkan jadwal yang available
    public function getAvailableSchedules()
    {
        $appointmentModel = new AppointmentModel();
        
        // Mendapatkan jadwal dengan status 'available'
        $schedules = $appointmentModel->getAvailableSchedules();

        // Cek jika tidak ada jadwal yang tersedia
        if (empty($schedules)) {
            return $this->failNotFound('Tidak ada jadwal yang tersedia');
        }

        // Mengembalikan data jadwal dalam format JSON
        return $this->respond($schedules);
    }

    // Fungsi untuk memesan jadwal
    public function bookAppointment($id)
    {
        $appointmentModel = new AppointmentModel();
        $userModel = new UserModel();

        // Mendapatkan data pemesanan dari body request
        $data = $this->request->getJSON(true);

        // Cek apakah user sudah login (misalnya user ID sudah ada di session atau token)
        $userId = $data['user_id'] ?? null;

        if (!$userId) {
            return $this->failValidationErrors('User ID diperlukan');
        }

        // Cek apakah jadwal yang diminta masih tersedia
        $appointment = $appointmentModel->find($id);

        if (!$appointment) {
            return $this->failNotFound('Jadwal tidak ditemukan');
        }

        if ($appointment['status'] != 'available') {
            return $this->failForbidden('Jadwal sudah dibooking');
        }

        // Update status jadwal menjadi 'booked'
        $dataToUpdate = [
            'user_id' => $userId,
            'user_name' => $data['user_name'],
            'email' => $data['email'],
            'status' => 'booked'
        ];

        // Update data jadwal
        if ($appointmentModel->bookAppointment($id, $dataToUpdate)) {
            return $this->respondCreated(['message' => 'Jadwal berhasil dibooking']);
        }

        return $this->fail('Gagal memesan jadwal');
    }

    public function getBookedAppointments($userId)
    {
        $appointmentModel = new AppointmentModel();

        // Mengambil semua jadwal yang sudah dibooking oleh user tertentu
        $appointments = $appointmentModel->getAppointmentsByUser($userId);

        // Cek jika tidak ada jadwal yang dibooking
        if (empty($appointments)) {
            return $this->failNotFound('Tidak ada jadwal yang dibooking');
        }

        // Mengembalikan data jadwal yang sudah dibooking dalam format JSON
        return $this->respond($appointments);
    }

    public function cancelReservation($id)
    {
        $appointmentModel = new AppointmentModel();
        $data = $this->request->getJSON(true); // Mendapatkan data request

        // Cek apakah user ID ada dalam request
        $userId = $data['user_id'] ?? null;

        if (!$userId) {
            return $this->failValidationErrors('User ID diperlukan');
        }

        // Cari jadwal berdasarkan ID
        $appointment = $appointmentModel->find($id);

        if (!$appointment) {
            return $this->failNotFound('Jadwal tidak ditemukan');
        }

        // Cek apakah user yang melakukan booking adalah user yang ingin membatalkan
        if ($appointment['user_id'] != $userId) {
            return $this->failForbidden('Anda tidak dapat membatalkan jadwal yang bukan milik Anda');
        }

        // Ubah status menjadi 'available' dan hapus data user_id, user_name, email
        $dataToUpdate = [
            'user_id' => null,
            'user_name' => null,
            'email' => null,
            'status' => 'available'
        ];

        // Update data jadwal
        if ($appointmentModel->update($id, $dataToUpdate)) {
            return $this->respond(['message' => 'Reservasi berhasil dibatalkan']);
        }

        return $this->fail('Gagal membatalkan reservasi');
    }

    public function avail()
    {
        return view('available_schedules');
    }

    public function book()
    {
        return view('book_schedule');
    }

    public function bookedView()
    {
        return view('bookings_view');
    }
}
