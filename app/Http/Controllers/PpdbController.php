<?php

namespace App\Http\Controllers;

use App\Models\ppdb;
use App\Models\siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response as ResponseFacade;
use JWTAuth;
use PDF;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;

class PpdbController extends Controller
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        $data = ppdb::select(
            'ppdb.id',
            'ppdb.no_daftar',
            'ppdb.nik',
            'ppdb.img_siswa',
            'ppdb.img_kk',
            'ppdb.img_ijazah',
            'ppdb.img_ktp',
            'ppdb.nik',
            'ppdb.nis',
            'ppdb.nama',
            'ppdb.email',
            'ppdb.no_hp',
            'ppdb.password',
            'ppdb.jk',
            'ppdb.ttl',
            'ppdb.prov',
            'ppdb.kab',
            'ppdb.kec',
            'ppdb.kel',
            'ppdb.alamat',
            'ppdb.nama_ayah',
            'ppdb.nama_ibu',
            'ppdb.pek_ayah',
            'ppdb.pek_ibu',
            'ppdb.nama_wali',
            'ppdb.pek_wali',
            'ppdb.peng_ortu',
            'ppdb.no_telp',
            'ppdb.thn_msk',
            'ppdb.sekolah_asal',
            'ppdb.thn_lls',
            'ppdb.kelas',
            'ppdb.id_pend',
            'ppdb.id_majors',
            'ppdb.id_kelas',
            'ppdb.raport',
            'ppdb.status',
            'ppdb.alasan',
            'ppdb.date_created',
            'ppdb.kode_inv',
            'ppdb.url_inv',
            'ppdb.inv',
            'ppdb.date_inv',
            'ppdb.kode_reff',
            'ppdb.staff_konfirmasi'

        )->join('users', 'users.id', '=', 'ppdb.staff_konfirmasi', 'left');

        $status = $this->request->status;
        $jenjang = $this->request->jenjang;

        // var_dump($status != NULL);
        // $q = $this->request->q;
        // $sort = $this->request->sort;
        // $column = $this->request->column;
        if ($status) {
            $data->where('status', $status);
        }
        if ($jenjang) {
            $data->where('id_majors', $jenjang);
        }

        // dd($data->get());
        $sql = $data->get();
        return response()->json($sql);
    }

    public function generateUniquePpdbNumber()
    {
        return DB::transaction(function () {
            $maxNumber = DB::table('ppdb')->max(DB::raw('CAST(SUBSTRING_INDEX(no_daftar, "-", -1) AS SIGNED)'));
            $newNumber = $maxNumber + 1;

            $formattedNumber = "PPDB-" . date("Y") . "-" . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
            if (DB::table('ppdb')->where('no_daftar', $formattedNumber)->exists()) {
                throw new \Exception('Nomor PPDB sudah ada dalam database.');
            }
            return $formattedNumber;
        });
    }
    public function create(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                // 'img_kk' => 'required|mimes:jpeg,png,pdf',
                'img_siswa' => 'required|mimes:jpeg,png,pdf',
                'img_ijazah' => 'required|mimes:jpeg,png,pdf',
                // 'img_ktp' => 'required|mimes:jpeg,png,pdf',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 500);
            }
            $img_kk = $this->request->file('img_kk');
            $img_siswa = $this->request->file('img_siswa');
            $img_ijazah = $this->request->file('img_ijazah');
            $img_ktp = $this->request->file('img_ktp');

            if ($img_kk) {
                $kkFilename = 'artikel_file' . date("Y-m-d h:i:s") . '.' . $img_kk->getClientOriginalExtension();
                $img_kk->move(public_path('kk'), $kkFilename);
            }

            if ($img_siswa) {
                $siswaFilename = 'artikel_file' . date("Y-m-d h:i:s") . '.' . $img_siswa->getClientOriginalExtension();
                $img_siswa->move(public_path('gambar'), $siswaFilename);
            }

            if ($img_ijazah) {
                $ijazahFilename = 'artikel_file' . date("Y-m-d h:i:s") . '.' . $img_ijazah->getClientOriginalExtension();
                $img_ijazah->move(public_path('ijazah'), $ijazahFilename);
            }

            if ($img_ktp) {
                $ktpFilename = 'artikel_file' . date("Y-m-d h:i:s") . '.' . $img_ktp->getClientOriginalExtension();
                $img_ktp->move(public_path('ktp'), $ktpFilename);
            }

            $kkFilename = 'artikel_file' . date("Y-m-d h:i:s") . '.' . $img_kk->getClientOriginalExtension();
            $siswaFilename = 'artikel_file' . date("Y-m-d h:i:s") . '.' . $img_siswa->getClientOriginalExtension();
            $ijazahFilename = 'artikel_file' . date("Y-m-d h:i:s") . '.' . $img_ijazah->getClientOriginalExtension();
            $ktpFilename = 'artikel_file' . date("Y-m-d h:i:s") . '.' . $img_ktp->getClientOriginalExtension();

            $data = new ppdb();
            $data->no_daftar = $this->request->nodaftar;
            $data->nik = $request->nik;
            $data->img_siswa = $siswaFilename;
            $data->img_kk = $kkFilename ? $kkFilename : 'kosong';
            $data->img_ijazah = $ijazahFilename;
            $data->img_ktp = $ktpFilename;

            $data->nik = $this->request->nik;
            $data->nis = $this->request->nis;
            $data->nama = $this->request->nama;
            $data->email = $this->request->email;
            $data->no_hp = $this->request->no_hp;
            $data->password = bcrypt($this->request->password);
            $data->jk = $this->request->jk;
            $data->ttl = $this->request->ttl;
            $data->prov = $this->request->provinsi;
            $data->kab = $this->request->kabupaten;
            $data->kec = $this->request->kecamatan;
            $data->kel = $this->request->kelurahan;
            $data->alamat = $this->request->alamat;
            $data->nama_ayah = $this->request->nama_ayah;
            $data->nama_ibu = $this->request->nama_ibu;
            $data->pek_ayah = $this->request->pek_ayah;
            $data->pek_ibu = $this->request->pek_ibu;
            $data->nama_wali = $this->request->nama_wali;
            $data->pek_wali = $this->request->pek_wali;
            $data->peng_ortu = $this->request->peng_ortu;
            $data->no_telp = $this->request->no_telp;
            $data->thn_msk = $this->request->thn_msk;
            $data->sekolah_asal = $this->request->sekolah_asal;
            $data->thn_lls = $this->request->thn_lls;
            $data->kelas = ($this->request->kelas) ? $this->request->kelas : 'Blum Set';
            $data->id_pend = $this->request->id_pend ? $this->request->id_pend : 1;
            $data->id_majors = $this->request->id_majors ? $this->request->id_majors : 1;
            $data->id_kelas = $this->request->id_kelas ? $this->request->id_kelas : 1;

            $data->raport = ($this->request->raport) ? $this->request->raport : 1;
            $data->status = ($this->request->status) ? $this->request->status : 1;
            $data->alasan = ($this->request->alasan) ? $this->request->alasan : 1;
            $data->date_created = date('Y-m-d H:i:s');
            $data->kode_inv = ($this->request->kode_inv) ? $this->request->alasan : 1;
            $data->url_inv = 0;
            $data->inv = 0;
            $data->date_inv = date('Y-m-d H:i:s');
            $data->kode_reff = 0;
            $data->staff_konfirmasi = 1;

            $data->save();

            return response()->json(['message' => 'Item created successfully']);

        } catch (ppdb $th) {
            return response()->json(['message' => $th], 500);

        }
    }

    public function show($id)
    {
        $data = ppdb::find($id);
        return response()->json($data);
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $provider = 'ppdb';

        if ($request->input('user_type') === 'ppdb') {
            $provider = 'ppdb'; // Menggunakan provider "ppdb" untuk jenis pengguna "ppdb"
        }

        config(['auth.defaults.guard' => $provider]);

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => bcrypt(123)], Response::HTTP_UNAUTHORIZED);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return ResponseFacade::json(['message' => 'Login successful', 'token' => $token], Response::HTTP_OK);
    }

    public function getDataFromToken()
    {
        $currentGuard = Auth::getDefaultDriver();
        Auth::shouldUse('ppdb');

        try {
            $user = JWTAuth::parseToken()->authenticate();
            // $user sekarang berisi data pengguna yang diotentikasi dengan guard "ppdb"
            return response()->json($user);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['error' => 'Token has expired'], 401);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['error' => 'Token is invalid'], 401);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['error' => 'Token is absent'], 401);
        } finally {
            Auth::shouldUse($currentGuard);
        }
    }
    public function uploadFile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:jpeg,png,pdf',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400); // 400 adalah kode status Bad Request
        }
        $no_daftar = $this->request->no_pendaftaran;
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move('./konfirmasi/', $fileName);
        ppdb::where(['no_daftar' => $no_daftar])->update([
            'bukti_bayar' => $fileName,
        ]);
        return response()->json(['success' => 'File berhasil diunggah.'], 200); // 200 adalah kode status OK
    }

    public function cekkelulusan($id)
    {
        $data = ppdb::where('no_daftar', $id)->get();
        if ($data->count() > 0) {
            $statusMessage = ($data->status == 1) ? 'Anda lulus' : 'Anda belum lulus';
            $response = [
                'message' => $statusMessage,
                'data' => $data,
            ];
            return response()->json($response);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404); // 404 adalah kode status Not Found
        }
    }

    public function verifikasibayar()
    {

    }
    public function insertsiswa($idsiswa)
    {
        try {

            $checksiswa = siswa::where('ppdb_id', $idsiswa)->get();
            if ($checksiswa->count() > 0) {
                return response()->json([
                    'messages' => 'Data sudah ada',
                ], 400);
            } else {

                $sql = ppdb::where('id', $idsiswa);
                $sql->update([
                    'status' => 1,
                    'staff_konfirmasi' => 1,
                ]);

                $data = new siswa();
                $getsiswa = $sql->first();
                $data->ppdb_id = $getsiswa->id;
                $data->point = $getsiswa->point ? $getsiswa->point : 1;
                $data->nik = ($getsiswa->nik) ? $getsiswa->nik : 'Kosong';
                $data->nis = ($getsiswa->nis) ? $getsiswa->nis : 'Kosong';
                $data->nama = $getsiswa->nama;
                $data->email = $getsiswa->email;
                $data->no_hp = $getsiswa->no_hp;
                $data->password = $getsiswa->password;
                $data->jk = $getsiswa->jk;
                $data->ttl = $getsiswa->ttl;
                $data->prov = $getsiswa->prov;
                $data->kab = $getsiswa->kab;
                $data->alamat = $getsiswa->alamat;
                $data->nama_ayah = $getsiswa->nama_ayah;
                $data->nama_ibu = $getsiswa->nama_ibu;
                $data->pek_ayah = $getsiswa->pek_ayah;
                $data->pek_ibu = $getsiswa->pek_ibu;
                $data->nama_wali = $getsiswa->nama_wali;
                $data->pek_wali = $getsiswa->pek_wali;
                $data->peng_ortu = $getsiswa->peng_ortu;
                $data->no_telp = $getsiswa->no_telp;
                $data->thn_msk = $getsiswa->thn_msk;
                $data->sekolah_asal = $getsiswa->sekolah_asal;
                $data->kelas = $getsiswa->kelas;
                $data->img_siswa = $getsiswa->img_siswa;
                $data->img_kk = $getsiswa->img_kk;
                $data->img_ijazah = $getsiswa->img_ijazah;
                $data->img_ktp = $getsiswa->img_ktp;
                $data->id_pend = $getsiswa->id_pend;
                $data->id_majors = $getsiswa->id_majors;
                $data->id_kelas = $getsiswa->id_kelas;
                $data->status = 1;
                // $data->updated_at = date('Y-m-d h:i:s');
                $data->date_created = date('Y-m-d h:i:s');
                $data->role_id = 3;
                $data->save();
                return response()->json([
                    'messages' => 'data berhasil di simpan',
                ]);
            }
        } catch (siswa $th) {
            return response()->json([
                'messages' => $th->getMessage(),
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($this->request->all(), [
                // 'img_kk' => 'required|mimes:jpeg,png,pdf',
                'img_siswa' => 'required|mimes:jpeg,png,pdf',
                'img_ijazah' => 'required|mimes:jpeg,png,pdf',
                // 'img_ktp' => 'required|mimes:jpeg,png,pdf',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 500);
            }
            $img_kk = $this->request->file('img_kk');
            $img_siswa = $this->request->file('img_siswa');
            $img_ijazah = $this->request->file('img_ijazah');
            $img_ktp = $this->request->file('img_ktp');

            if ($img_kk) {
                $kkFilename = 'artikel_file' . date("Y-m-d h:i:s") . '.' . $img_kk->getClientOriginalExtension();
                $img_kk->move(public_path('kk'), $kkFilename);
            }

            if ($img_siswa) {
                $siswaFilename = 'artikel_file' . date("Y-m-d h:i:s") . '.' . $img_siswa->getClientOriginalExtension();
                $img_siswa->move(public_path('gambar'), $siswaFilename);
            }

            if ($img_ijazah) {
                $ijazahFilename = 'artikel_file' . date("Y-m-d h:i:s") . '.' . $img_ijazah->getClientOriginalExtension();
                $img_ijazah->move(public_path('ijazah'), $ijazahFilename);
            }

            if ($img_ktp) {
                $ktpFilename = 'artikel_file' . date("Y-m-d h:i:s") . '.' . $img_ktp->getClientOriginalExtension();
                $img_ktp->move(public_path('ktp'), $ktpFilename);
            }

            $kkFilename = 'artikel_file' . date("Y-m-d h:i:s") . '.' . $img_kk->getClientOriginalExtension();
            $siswaFilename = 'artikel_file' . date("Y-m-d h:i:s") . '.' . $img_siswa->getClientOriginalExtension();
            $ijazahFilename = 'artikel_file' . date("Y-m-d h:i:s") . '.' . $img_ijazah->getClientOriginalExtension();
            $ktpFilename = 'artikel_file' . date("Y-m-d h:i:s") . '.' . $img_ktp->getClientOriginalExtension();

            $data = ppdb::find($id);
            $data->nik = $request->nik;
            $data->img_siswa = $siswaFilename;
            $data->img_kk = $kkFilename ? $kkFilename : 'kosong';
            $data->img_ijazah = $ijazahFilename;
            $data->img_ktp = $ktpFilename;

            $data->nik = $this->request->nik;
            $data->nis = $this->request->nis;
            $data->nama = $this->request->nama;
            $data->email = $this->request->email;
            $data->no_hp = $this->request->no_hp;
            $data->password = bcrypt($this->request->password);
            $data->jk = $this->request->jk;
            $data->ttl = $this->request->ttl;
            $data->prov = $this->request->provinsi;
            $data->kab = $this->request->kabupaten;
            $data->kec = $this->request->kecamatan;
            $data->kel = $this->request->kelurahan;
            $data->alamat = $this->request->alamat;
            $data->nama_ayah = $this->request->nama_ayah;
            $data->nama_ibu = $this->request->nama_ibu;
            $data->pek_ayah = $this->request->pek_ayah;
            $data->pek_ibu = $this->request->pek_ibu;
            $data->nama_wali = $this->request->nama_wali;
            $data->pek_wali = $this->request->pek_wali;
            $data->peng_ortu = $this->request->peng_ortu;
            $data->no_telp = $this->request->no_telp;
            $data->thn_msk = $this->request->thn_msk;
            $data->sekolah_asal = $this->request->sekolah_asal;
            $data->thn_lls = $this->request->thn_lls;
            $data->kelas = ($this->request->kelas) ? $this->request->kelas : 'Blum Set';
            $data->id_pend = $this->request->id_pend ? $this->request->id_pend : 1;
            $data->id_majors = $this->request->id_majors ? $this->request->id_majors : 1;
            $data->id_kelas = $this->request->id_kelas ? $this->request->id_kelas : 1;

            $data->raport = ($this->request->raport) ? $this->request->raport : 1;
            $data->status = ($this->request->status) ? $this->request->status : 1;
            $data->alasan = ($this->request->alasan) ? $this->request->alasan : 1;
            $data->date_created = date('Y-m-d H:i:s');
            $data->kode_inv = ($this->request->kode_inv) ? $this->request->alasan : 1;
            $data->url_inv = 0;
            $data->inv = 0;
            $data->date_inv = date('Y-m-d H:i:s');
            $data->kode_reff = 0;
            $data->staff_konfirmasi = 1;

            $data->save();

            return response()->json(['message' => 'Item created successfully']);

        } catch (ppdb $th) {
            return response()->json(['message' => $th], 500);

        }
    }

    public function siswadetail($id)
    {
        $data = ppdb::findorFail($id);
        return response()->json($data);
    }

    public function reportpdb()
    {
        $dari = $this->request->dari;
        $sampai = $this->request->sampai;
        $data = ppdb::select(
            'ppdb.id',
            'ppdb.no_daftar',
            'ppdb.nik',
            'ppdb.img_siswa',
            'ppdb.img_kk',
            'ppdb.img_ijazah',
            'ppdb.img_ktp',
            'ppdb.nik',
            'ppdb.nis',
            'ppdb.nama',
            'ppdb.email',
            'ppdb.no_hp',
            'ppdb.password',
            'ppdb.jk',
            'ppdb.ttl',
            'ppdb.prov',
            'ppdb.kab',
            'ppdb.kec',
            'ppdb.kel',
            'ppdb.alamat',
            'ppdb.nama_ayah',
            'ppdb.nama_ibu',
            'ppdb.pek_ayah',
            'ppdb.pek_ibu',
            'ppdb.nama_wali',
            'ppdb.pek_wali',
            'ppdb.peng_ortu',
            'ppdb.no_telp',
            'ppdb.thn_msk',
            'ppdb.sekolah_asal',
            'ppdb.thn_lls',
            'ppdb.kelas',
            'ppdb.id_pend',
            'ppdb.id_majors',
            'ppdb.id_kelas',
            'ppdb.raport',
            'ppdb.status',
            'ppdb.alasan',
            'ppdb.date_created',
            'ppdb.kode_inv',
            'ppdb.url_inv',
            'ppdb.inv',
            'ppdb.date_inv',
            'ppdb.kode_reff',
            'ppdb.staff_konfirmasi'

        )->
            join('tingkat', 'tingkat.id', '=', 'ppdb.id_majors', 'left')
            ->join('kelas', 'kelas.id', '=', 'ppdb.id_kelas', 'left')->get();
        // ->whereBetween('date_created', [$dari, $sampai])->get();
        return response()->json($data);
        //  $pdf = PDF::loadView('report.ppdb', ['item' => $data]);
        // $pdf->setPaper('landscape');
        // return $pdf->stream('Formulir_pendaftaran.pdf'); // This will prompt the user to download the PDF

    }
    public function Report($id)
    {
        $data = ppdb::where(['id' => $id])->firstOrfail();
        if ($data->status == '1') {
            $pdf = PDF::loadView('report.ppdb', ['item' => $data]);
            $pdf->setPaper('landscape'); // Mengatur orientasi kertas menjadi landscape

            return $pdf->stream('Formulir_pendaftaran.pdf'); // This will prompt the user to download the PDF
        } else {
            return "<h4>Silahkan Lunasi tunggakan Formulir anda</h4>";
        }
    }
}
