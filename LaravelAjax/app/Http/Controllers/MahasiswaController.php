<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    /**
     * Menampilkan halaman utama
     */
    public function index()
    {
        return view('mahasiswa.index');
    }

    /**
     * Membaca file JSON dan mengembalikan data mahasiswa dalam format JSON
     */
    public function getData()
    {
        $path = storage_path('app/mahasiswa.json');
    
        if (!file_exists($path)) {
            return response()->json(['success' => false, 'data' => [], 'message' => 'File tidak ditemukan'], 404);
        }

        $json = file_get_contents($path);
        $mahasiswa = json_decode($json, true);

        return response()->json([
            'success' => true,
            'data'    => $mahasiswa ?? []
        ]);
    }
}