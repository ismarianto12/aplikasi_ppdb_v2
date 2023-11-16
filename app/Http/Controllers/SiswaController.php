<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function index()
    {
        // Mengambil daftar siswa
        $siswa = Siswa::all();
        return response()->json($siswa);
    }

    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            // Atur aturan validasi sesuai kebutuhan Anda
        ]);

        // Simpan data siswa baru
        $siswa = Siswa::create($request->all());
        return response()->json($siswa, 201);
    }
    public function getBykelas()
    {
        $unit_id = $this->request->unit_id;
        $id_kelas = $this->request->id_kelas;
        $siswadata = Siswa::all();

        return response()->json($siswadata);
    }

    public function show($id)
    {
        // Menampilkan detail siswa berdasarkan ID
        $siswa = Siswa::findOrFail($id);
        return response()->json($siswa);
    }

    public function update(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            // Atur aturan validasi sesuai kebutuhan Anda
        ]);

        // Mengupdate data siswa berdasarkan ID
        $siswa = Siswa::findOrFail($id);
        $siswa->update($request->all());
        return response()->json($siswa);
    }

    public function destroy($id)
    {
        // Menghapus data siswa berdasarkan ID
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();
        return response()->json(null, 204);
    }
}
