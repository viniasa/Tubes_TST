<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use CodeIgniter\RESTful\ResourceController;

class ArticleController extends ResourceController
{
    // Fungsi untuk menampilkan semua artikel
    public function index()
    {
        $articleModel = new ArticleModel();
        
        // Ambil semua artikel
        $articles = $articleModel->findAll();

        // Cek jika tidak ada artikel
        if (empty($articles)) {
            return $this->failNotFound('Tidak ada artikel');
        }

        // Mengembalikan data artikel dalam format JSON
        return $this->respond($articles);
    }
}
