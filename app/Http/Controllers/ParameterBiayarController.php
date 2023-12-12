<?php

namespace App\Http\Controllers;

use App\Models\parameterBiayar;
use Illuminate\Http\Request;

class ParameterBiayarController extends Controller
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function index()
    {
        $data = parameterBiayar::get();
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
    public function store(Request $request)
    {
        try {
            $data = new parameterBiayar;
            $data->nama_biaya = $this->request->nama_biaya;
            $data->nominal = $this->request->nominal;
            $data->tingkat = $this->request->tingkat;
            $data->catatan = $this->request->catatan;
            $data->save();
            return response()->json([
                'data berhasil di simpan',
            ]);
        } catch (parameterBiayar $th) {
            return response()->json([
                'error bos' => $th->getMessages(),
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\parameterBiayar  $parameterBiayar
     * @return \Illuminate\Http\Response
     */
    public function show(parameterBiayar $parameterBiayar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\parameterBiayar  $parameterBiayar
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = parameterBiayar::where('id', $id)->firstOrfail();
        return response()->json($data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\parameterBiayar  $parameterBiayar
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        try {
            $data = parameterBiayar::find($id);
            $data->nama_biaya = $this->request->nama_biaya;
            $data->nominal = $this->request->nominal;
            $data->tingkat = $this->request->tingkat;
            $data->catatan = $this->request->catatan;
            $data->save();
            return response()->json([
                'data berhasil di simpan',
            ]);
        } catch (parameterBiayar $th) {
            return response()->json([
                'teadasd' => $th->getMessages(),
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\parameterBiayar  $parameterBiayar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            parameterBiayar::find($id)->delete();
            return response()->json([
                'msg' => 'data berhasil dihapus',
            ]);
        } catch (parameterBiayar $th) {
            return response()->json([
                'teadasd' => $th->getMessages(),
            ], 400);
        }
    }
    public function getJenistagihan()
    {
        $unit_id = $this->request->unit_id;
        $data = parameterBiayar::where('tingkat', $unit_id)->get();
        return response()->json($data);
    }

}
