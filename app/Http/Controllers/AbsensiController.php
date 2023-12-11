<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\siswa;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $unit_id = $request->unit_id;
        $kelas_id = $request->kelas_id;
        $search = $request->search;

        $data = siswa::select(
            'siswa.id',
            'siswa.point',
            'siswa.nik',
            'siswa.nis',
            'siswa.nama',
            'siswa.email',
            'siswa.no_hp',
            'siswa.password',
            'siswa.jk',
            'siswa.ttl',
            'siswa.prov',
            'siswa.kab',
            'siswa.alamat',
            'siswa.nama_ayah',
            'siswa.nama_ibu',
            'siswa.pek_ayah',
            'siswa.pek_ibu',
            'siswa.nama_wali',
            'siswa.pek_wali',
            'siswa.peng_ortu',
            'siswa.no_telp',
            'siswa.thn_msk',
            'siswa.sekolah_asal',
            'siswa.kelas',
            'siswa.img_siswa',
            'siswa.img_kk',
            'siswa.img_ijazah',
            'siswa.img_ktp',
            'siswa.id_pend',
            'siswa.id_majors',
            'siswa.id_kelas',
            'siswa.status',
            'siswa.date_created',
            'siswa.role_id',
            'siswa.kelas_id',
            'siswa.tingkat_id',
            'siswa.ppdb_id',
            'kelas.kelas',
            'kelas.tingkat',

        )


            ->join('kelas', 'kelas.id', '=', 'siswa.kelas_id', 'left')
            ->join('tingkat', 'tingkat.id', '=', 'siswa.tingkat_id', 'left');

        if ($search) {
            $data->where(function ($q) use ($search) {
                $q->where('siswa.nama', 'like', '%' . $search . '%')
                    ->orWhere('siswa.nis', 'like', '%' . $search . '%');
                // Add more columns for search as needed
            });
        }

        if ($kelas_id) {
            $query->where('siswa.tingkat_id', $unit_id);
        }
        if ($unit_id) {
            $query->where('kelas_id', $kelas_id);
        }
        $perPage = $request->input('per_page', 10); // Number of items per page, default is 10
        $resdata = $data->paginate($perPage);
        return response()->json($resdata);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function show(Absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Absensi $absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absensi $absensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absensi $absensi)
    {
        //
    }
}
