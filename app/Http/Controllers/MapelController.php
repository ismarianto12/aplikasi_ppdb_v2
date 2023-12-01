<?php

namespace App\Http\Controllers;

use App\Models\mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function index()
    {
        $data = mapel::select(
            'mapel.id',
            'kelas.kelas',
            'mapel.kode',
            'mapel.nama_mapel',
            'tingkat.tingkat',
            'users.nama_lengkap',
            'users.username',
            'mapel.created_at',
            'mapel.updated_at',
        )->join('kelas', 'kelas.id', '=', 'mapel.kelas_id', 'left')
            ->join('users', 'users.id', '=', 'mapel.user_id', 'left')
            ->join('tingkat', 'mapel.unit_id', '=', 'tingkat.id', 'left')
            ->get();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new mapel;
        $data->unit_id = $this->request->tingkat;
        $data->kelas_id = $this->request->kelas;
        $data->kode = $this->request->kode_mapel;
        $data->nama_mapel = $this->request->nama;
        $data->created_at = date('Y-m-d');
        $data->updated_at = date('Y-m-d');
        $data->save();
        return response()->json([
            'messages' => 'data berhasil disimpan',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function show(mapel $mapel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function edit(mapel $mapel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $data = mapel::find($id);
            $data->unit_id = $this->request->unit_id;
            $data->kelas_id = $this->request->kelas_id;
            $data->kode = $this->request->kode_mapel;
            $data->nama_mapel = $this->request->nama;

            $data->created_at = date('Y-m-d');
            $data->updated_at = date('Y-m-d');

            $data->save();
            return response()->json([
                'messages' => 'data berhasil disimpan',
            ]);
        } catch (\Mapel $th) {
            return response()->json([
                'messages' => $th->getMessage(),
            ]);
        }
    }

    public function destroy(mapel $mapel)
    {
        try {
            mapel::find($id)->delete();
            return response()->json([
                'messages' => 'data berhasil di hapus',
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
