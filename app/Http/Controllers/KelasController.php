<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {

            $data = kelas::join('tingkat', 'kelas.tingkat', '=', 'tingkat.id', 'left')->get();
            return response()->json($data);
        } catch (\Throwable $th) {
            return response()->json([
                'messages' => $th->getMessage(),
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $kelas = new Kelas;
            $kelas->kelas = $this->request->kelas;
            $kelas->tingkat = $this->request->tingkat;
            $kelas->save();
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'messages' => $th->getMessage(),
            ]);

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            $data = new kelas;
            $data->kelas = $request->kelas;
            $data->tingkat = $request->unit;
            $data->save();
            return response()->json([
                'messages' => 'data berhasil disimpan .',
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => $th->getMessage(),
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = kelas::find($id);
        return response()->json($data);
    }
    public function getbyUnit($id)
    {

        $result = DB::table('kelas as k')
            ->select('k.id','k.kelas', 'k.kode_kelas','t.tingkat')
            ->join('tingkat as t', 't.id', '=', 'k.tingkat')
            ->where('t.id', '=', $id)
            ->get();

        return response()->json($result);
    }
    public function update($id)
    {
        try {
            $kelas = Kelas::find($id);
            $kelas->kelas = $this->request->kelas;
            $kelas->tingkat = $this->request->tingkat;
            $kelas->save();
        } catch (\Kelas $th) {
            return response()->json([
                'messages' => $th->getMessage(),
            ]);

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $kelas = Kelas::find($id);
            $kelas->delete();
            return response()->json([
                'messages' => 'data berhasil di delete',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'messages' => $th->getMessage(),
            ]);

        }

    }
}
