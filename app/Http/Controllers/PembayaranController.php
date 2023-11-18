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
        $kelas = $this->request->kelas;
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
                'siswa_id' => $this->request->id_siswa,
                'jumlah_bayar' => $this->request->jumlah_bayar,
                'pembayaran_type' => $this->request->type_pembayaran,
            ];

            $pembayaran = Pembayaran::where('tagihan_id', $this->request->jenis_tagihan)->first();

            if (!$pembayaran) {
                return response()->json(['msg' => 'Data data transaksi belum di posting silahkan posting terlebih dahulu.'], 404);
            }
            $pembayaran->update($data);
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
}
