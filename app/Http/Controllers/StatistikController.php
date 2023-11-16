<?php

namespace App\Http\Controllers;

use App\Models\statistik;
use Illuminate\Http\Request;

class StatistikController extends Controller
{

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function index()
    {
        $data = statistik::get();
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
        try {

            $create = new statistik();
            $create->keterangan = $this->request->keterangan;
            $create->jumlah = $this->request->jumlah;
            $create->user_id = $this->request->user_id;
            $create->save();

            return response()->json([
                'data' => 'berhasil',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'messages' => $th,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\statistik  $statistik
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $create = statistik::find($id);
            return response()->json([
                'data' => $create,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'messages' => $th,
            ]);
        }
    }

    public function edit(statistik $statistik)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\statistik  $statistik
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        try {
            $create = statistik::find($id);
            $create->keterangan = $this->request->keterangan;
            $create->jumlah = $this->request->jumlah;
            $create->user_id = $this->request->user_id;
            $create->save();
            return response()->json([
                'data' => 'berhasil di update',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'messages' => $th,
            ]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\statistik  $statistik
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            statistik::find($id)->delete();
            return response()->json([
                'msg' => 'berhasil hapus data',
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'gagal hapus data',
            ]);
        }
    }
}
