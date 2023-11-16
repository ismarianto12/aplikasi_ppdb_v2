<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{

    public function __construct(Request $request)
    {
        $this->requst = $request;
    }

    public function index()
    {
        $data = Laporan::get();
        return response()->json($data);
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
    public function store()
    {
        try {




            $date = Carbon::now()->format('y-m-d h:i:s');
            $gambar = $this->request->file('file');
            $filename = 'artikel_file' . rand() . '.' . $gambar->getClientOriginalExtension();
            $gambar->move('./files/', $filename);


            $data = new Laporan();
            $data->judul = $this->request->judul;
            $data->tahun = $this->request->tahun;
            $data->file = $this->request->file;
            $data->jenis_laporan = $this->request->jenis_laporan;
            $data->hit = $this->request->hit;
            $data->created_at = $this->request->created_at;
            $data->updated_at = $this->request->updated_at;
            $data->save();

        } catch (\Throwable $th) {
            return response()->json(['messages' => $th->getMessage()], 400);

        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function show(Laporan $laporan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function edit(Laporan $laporan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laporan $laporan)
    {
        try {
            $data = new Laporan();
            $data->judul = $this->request->judul;
            $data->tahun = $this->request->tahun;
            $data->file = $this->request->file;
            $data->jenis_laporan = $this->request->jenis_laporan;
            $data->hit = $this->request->hit;
            $data->created_at = $this->request->created_at;
            $data->updated_at = $this->request->updated_at;
            $data->save();

        } catch (\Throwable $th) {
            return response()->json(['messages' => $th->getMessage()]);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Laporan  $laporan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = Laporan::find($id);
            $data->save();
            return response()->json(['messages' => 'berhasil di hapus']);

        } catch (\Throwable $th) {
            return response()->json(['messages' => $th->getMessage()], 400);

        }
    }
}
