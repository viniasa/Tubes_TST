<?php

namespace App\Models;

use CodeIgniter\Model;

class AppointmentModel extends Model
{
    protected $table      = 'appointments';
    protected $primaryKey = 'id';

    protected $allowedFields = ['user_id', 'user_name', 'email', 'psychologist_name', 'schedule_date', 'schedule_time', 'status'];

    public function getAvailableSchedules()
    {
        // Mengambil semua jadwal dengan status 'available'
        return $this->where('status', 'available')->findAll();
    }

    // Fungsi untuk melakukan pemesanan jadwal
    public function bookAppointment($id, $data)
    {
        // Mengubah status dari available menjadi booked
        return $this->update($id, $data);
    }
    
    // Ambil semua janji yang sudah dipesan oleh user tertentu
    public function getAppointmentsByUser($userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }
}
