<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{

    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function index()
    {
        $periode = $this->request->periode;
        $kelas = $this->request->class_name;
        $unit = $this->request->unit;

        $data = Siswa::select(
            'siswa.id',
            'tingkat.tingkat',
            'siswa.nis',
            'siswa.nama',
            'kelas.kelas',
            'tahun_ajaran',
            'status',
            DB::raw('SUM(biaya_ppdb.nominal) as total_tagihan'),
            DB::raw('SUM(pembayaran.jumlah_bayar) as total_dibayar'),
            DB::raw('SUM(pembayaran.jumlah_bayar) as total_tunggakan')
        )
            ->leftJoin('tingkat', 'siswa.tingkat_id', '=', 'tingkat.id')
            ->leftJoin('kelas', 'kelas.id', '=', 'siswa.kelas_id')
            ->leftJoin('pembayaran', 'pembayaran.siswa_id', '=', 'siswa.id')
            ->leftJoin('biaya_ppdb', 'biaya_ppdb.id', '=', 'pembayaran.tagihan_id');

        if ($periode) {
            $data->where('pembayaran.periode', $periode);
        }

        $data->groupBy(
            'tingkat.tingkat',
            'siswa.id',
            'siswa.nis',
            'siswa.nama',
            'kelas.kelas',
            'tahun_ajaran',
            'status'
        );

        $result = $data->get();
        return response()->json($result);

    }

    public function show($id)
    {
        $pembayaran = Pembayaran::find($id);
        return response()->json($pembayaran);
    }

    public function terbitkanPembayaran()
    {
        $kelas = $this->request->kelas;
        $unit = $this->request->unit;
        $periode = $this->request->bill_year . '-' . $this->request->bill_month . '-' . $this->request->bill_time;

        $siswa = siswa::where([
            'tingkat_id' => $unit,
            'kelas' => $kelas,
        ])->get();
        foreach ($siswa as $siswas) {
            Pembayaran::insert([
                'unit_id' => $unit,
                'kelas_id' => $kelas,
                'siswa_id' => $siswas->id,
                'periode_bayar' => $periode_bayar,
                'pembayaran_method' => 0,
                'pembayaran_date' => date('Y-m-d H:i:s'),
                'jumlah_bayar' => 0,
            ]);
        }

        return response()->json([
            'message' => 'data berhasil disimpan',
        ]);

    }

    public function store(Request $request)
    {
        $pembayaran = Pembayaran::create($request->all());
        return response()->json($pembayaran, 201);
    }

    public function update(Request $request, $id)
    {
        try {
            $data = [
                'siswa_id' => $request->id_siswa,
                'unit_id'=>$request->unit_id ? $request->unit_id : 1,
                'kelas_id'=>$request->unit_id ? $request->unit_id : 1,
                'jumlah_bayar' => $request->jumlah_bayar,
                'pembayaran_type' => $request->type_pembayaran,
                'pembayaran_method' => $request->type_pembayaran,
                'pembayaran_date'=> date('Y-m-d H:i:s')
            ];
            $pembayaran = Pembayaran::create($data);

            return response()->json($pembayaran);
        } catch (\Exception $th) {
            return response()->json([
                'msg' => 'Gagal menyimpan data.',
                'error' => $th->getMessage(),
            ], 500);
        }
    }


    public function destroy($id)
    {
        Pembayaran::destroy($id);
        return response()->json(['message' => 'Data pembayaran berhasil dihapus']);
    }

    public function LaporanPembayaran()
    {
        $dari = $this->request->dari;
        $sampai = $this->request->sampai;
        $tingkat = $this->request->tingkat;
        $jenjang = $this->request->jenjang;
        $perPage = $this->request->page ? $this->request->page : 1;

        // if ($tingkat == '' && $jenjang == '') {
        //     return response()->json([
        //         'messsages' => 'tingkat field is required',
        //     ]);
        // }

        $query = Pembayaran::select(
            'pembayaran.id',
            'pembayaran.unit_id',
            'pembayaran.kelas_id',
            'pembayaran.siswa_id',
            'pembayaran.tagihan_id',
            'pembayaran.created_at',
            'pembayaran.updated_at',
            'pembayaran.user_id',
            'pembayaran.periode_bayar',
            'pembayaran.tahun_ajaran',
            'pembayaran.tanggal_jatuh_tempo',
            'pembayaran.pembayaran_method',
            'pembayaran.pembayaran_channel',
            'pembayaran.pembayaran_note',
            'pembayaran.pembayaran_date',
            'pembayaran.bayar_sebagai',
            'pembayaran.jumlah_bayar',
            'pembayaran.pembayaran_type'
        )->join('divisi', 'divisi.id', '=', 'pembayaran.unit_id', 'left')
            ->join('kelas', 'kelas.id', '=', 'pembayaran.kelas_id', 'left');

        if ($dari && $sampai) {
            $query->whereBetween('pembayaran.created_at', [
                $dari, $sampai,
            ]);
        }

        if ($tingkat && $jenjang) {
            $query->where('kelas.id', $tingkat);
            $query->where('pembayaran.unit_id', $jenjang);

        }

        $posts = $query->paginate(7, ['*'], 'page', $perPage);
        return response()->json(['data' => $posts]);

    }

}
