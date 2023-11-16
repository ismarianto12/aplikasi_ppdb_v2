<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    public function index()
    {
        return Karyawan::all();
    }

    public function show($id)
    {
        $karyawan = Karyawan::find($id);
        if ($karyawan) {
            return response()->json($karyawan);
        } else {
            return response()->json(['message' => 'Karyawan not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_fingerprint' => 'required',
            'nik' => 'required|numeric',
            'nama' => 'required',
            'jk' => 'required|in:L,P',
         ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        // $karyawan = Karyawan::create($request->all());
        $data = new Karyawan;
        $data->id_fingerprint = $this->request->id_fingerprint;
        $data->nik = $this->request->nik;
        $data->nama = $this->request->nama;
        $data->jk = $this->request->jk;
        $data->ttl = $this->request->ttl;
        $data->email = $this->request->email;
        $data->password = $this->request->password;
        $data->alamat = $this->request->alamat;
        $data->telp = $this->request->telp;
        $data->id_divisi = $this->request->id_divisi;
        $data->dept = $this->request->dept;
        $data->intensif = $this->request->intensif;
        $data->jam_mengajar = $this->request->jam_mengajar;
        $data->nominal_jam = $this->request->nominal_jam;
        $data->bpjs = $this->request->bpjs;
        $data->koperasi = $this->request->koperasi;
        $data->simpanan = $this->request->simpanan;
        $data->tabungan = $this->request->tabungan;
        $data->id_pend = $this->request->id_pend;
        $data->kode_reff = $this->request->kode_reff;
        $data->jumlah_reff = $this->request->jumlah_reff;
        $data->role_id = $this->request->role_id;
        $data->status = $this->request->status;
        $data->date_created = $this->request->date_created;

        $data->save();
        return response()->json(['message' => 'Karyawan created successfully', 'data' => $karyawan], 201);
    }

    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::find($id);

        if ($karyawan) {
            $validator = Validator::make($request->all(), [
                'id_fingerprint' => 'required',
                'nik' => 'required|numeric',
                'nama' => 'required',
                'jk' => 'required|in:L,P',
                // Tambahkan validasi untuk bidang lainnya sesuai kebutuhan Anda.
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            $karyawan->update($request->all());

            return response()->json(['message' => 'Karyawan updated successfully', 'data' => $karyawan], 200);
        } else {
            return response()->json(['message' => 'Karyawan not found'], 404);
        }
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::find($id);

        if ($karyawan) {
            $karyawan->delete();
            return response()->json(['message' => 'Karyawan deleted'], 200);
        } else {
            return response()->json(['message' => 'Karyawan not found'], 404);
        }
    }
}
