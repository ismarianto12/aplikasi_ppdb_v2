<?php

namespace App\Http\Controllers;

use App\Models\TahunAkademik;
use Illuminate\Http\Request;

class TahunAkademikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = TahunAkademik::get();
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
            $data = new TahunAkademik();
            $data->tahun = $this->request->tahun;
            $data->Semester = $this->request->Semester;
            $data->active = $this->request->active;

            return response()->json('data berhasil di tambah');
        } catch (TahunAkademik $th) {
            return response()->json('data berhasil di tambah' . $th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TahunAkademik  $tahunAkademik
     * @return \Illuminate\Http\Response
     */
    public function show(TahunAkademik $tahunAkademik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TahunAkademik  $tahunAkademik
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = TahunAkademik::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TahunAkademik  $tahunAkademik
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        try {
            $data = TahunAkademik::find($id);
            $data->tahun = $this->request->tahun;
            $data->Semester = $this->request->Semester;
            $data->active = $this->request->active;
            return response()->json('data berhasil di update');
        } catch (TahunAkademik $th) {
            return response()->json('data berhasil di tambah'+$th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TahunAkademik  $tahunAkademik
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            TahunAkademik::where('id', $id)->delete();
            return response()->json('data berhasil di hapus');
        } catch (TahunAkademik $th) {
            return response()->json('data berhasil di hapus'+$th);
        }

    }
}
