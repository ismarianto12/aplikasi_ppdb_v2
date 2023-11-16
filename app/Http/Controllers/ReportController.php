<?php

namespace App\Http\Controllers;

use App\Models\ppdb;
use App\Models\Report;
use App\Models\siswa;
use Illuminate\Http\Request;
use PDF;

class ReportController extends Controller
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function siswa()
    {
        $dari = $this->request->dari;
        $sampai = $this->request->sampai;
        $data = siswa::
            join('kelas', 'kelas.id', '=', 'siswa.kelas_id', 'left')
            ->join('kelas', 'kelas.id', '=', 'siswa.kelas_id', 'left')
            ->whereBetween('date_created', [$dari, $sampai])->get();

        // dd($data);
         $pdf = PDF::loadView('report.ppdb', ['item' => $data]);
        $pdf->setPaper('landscape');
        return $pdf->stream('Formulir_pendaftaran.pdf'); // This will prompt the user to download the PDF

    }

    public function ppdd()
    {
        $dari = $this->request->dari;
        $sampai = $this->request->sampai;
        $data = ppdb::
            join('tingkat', 'tingkat.id', '=', 'ppdb.id_majors', 'left')
            ->join('kelas', 'kelas.id', '=', 'ppdb.id_kelas', 'left')
            ->whereBetween('date_created', [$dari, $sampai])->get();

         $pdf = PDF::loadView('report.ppdb', ['item' => $data]);
        $pdf->setPaper('landscape');
        return $pdf->stream('Formulir_pendaftaran.pdf'); // This will prompt the user to download the PDF

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
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}
