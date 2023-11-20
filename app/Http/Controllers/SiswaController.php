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
        try {
            $data = siswa::find($id);
            $data->point = ($this->request->point) ? $this->request->point : 0;
            $data->nik = $this->request->nik;
            $data->nis = $this->request->nis;
            $data->nama = $this->request->nama;
            $data->email = $this->request->email;
            $data->no_hp = $this->request->no_hp;
            $data->password = $this->request->password;
            $data->jk = $this->request->jk;
            $data->ttl = $this->request->ttl;
            $data->prov = $this->request->provinsi;
            $data->kab = $this->request->kabupaten;
            $data->alamat = $this->request->alamat;
            $data->nama_ayah = $this->request->nama_ayah;
            $data->nama_ibu = $this->request->nama_ibu;
            $data->pek_ayah = $this->request->pek_ayah;
            $data->pek_ibu = $this->request->pek_ibu;
            $data->nama_wali = $this->request->nama_wali;
            $data->pek_wali = $this->request->pek_wali;
            $data->peng_ortu = $this->request->peng_ortu;
            $data->no_telp = $this->request->no_telp;
            $data->thn_msk = $this->request->thn_msk;
            $data->sekolah_asal = $this->request->sekolah_asal;
            $data->kelas = $this->request->kelas ? $this->request->kelas : 0;
            $data->img_siswa = $this->request->img_siswa ? $this->request->img_siswa : '';
            $data->img_kk = $this->request->img_kk ? $this->request->img_kk : '';
            $data->img_ijazah = $this->request->img_ijazah ? $this->request->img_ijazah : '';
            $data->img_ktp = $this->request->img_ktp ? $this->request->img_ktp : '';
            $data->id_pend = $this->request->pendidikan;
            $data->id_majors = $this->request->id_majors ? $this->request->id_majors : 0;
            $data->id_kelas = $this->request->id_kelas ? $this->request->id_kelas : 0;
            $data->status = $this->request->status ? $this->request->status : 1;
            $data->date_created = date('Y-m-d H:i:s');
            $data->role_id = 1;
            $data->kelas_id = $this->request->kelas_id ? $this->request->kelas_id : 0;
            $data->tingkat_id = $this->request->tingkat_id;
            $data->ppdb_id = $this->request->ppdb_id;
            $data->save();
            return response()->json([
                'msg' => 'data berhasil disimpan',
            ]);
        } catch (\siswa $th) {
            return response()->json([
                'msg' => $th->getMessage(),
            ], 400);

        }
    }

    public function destroy($id)
    {
        // Menghapus data siswa berdasarkan ID
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();
        return response()->json(null, 204);
    }
}
