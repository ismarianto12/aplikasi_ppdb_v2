<title>Formulir Pendaftaran</title>

<style>
    table {
        width: 100%;
        text-align: left;
    }

    .cstable,
    table,
    th,
    td {
        border: 0.1px solid #ddd;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 10px;
    }

    h3 {
        background: green;
        color: #fff;
        text-align: center;
        margin: 0;
    }

    img {
        width: 80%;
        max-width: 100%;
    }
</style>

<table>
    <tbody>
        <tr>
            <td>
                <img src="{{ public_path('logo.jpeg') }}" alt="My Image" style="width: 80%">
            </td>
            <td>
                <h4>Formulir PPDB</h4>
                <tt> Jl. Gapin, Jatisari, Jatiasih, Kota Bekasi, Jawa Barat 17426</tt>
            </td>
        </tr>
    </tbody>
</table>



<h3 style="background: green;color:#fff;text-align:center">Data Siswa</h3>

<table class="cstable">

    <tbody>
        <tr>

            <td style="width:60%; text-align:center"> <img src="{{ public_path('logo.jpeg') }}" alt="My Image"
                    style="width: 50%" />
            </td>
        </tr>
        <tr>
            <td><b>No Pendaftaran:</b></td>
            <td>:</td>
            <td>{{ $item->no_daftar }}</td>
        </tr>
        <tr>
            <td><b>NIK:</b></td>
            <td>:</td>
            <td>{{ $item->nik }}</td>
        </tr>
        <tr>
            <td>NIS:</td>
            <td>:</td>
            <td>{{ $item->nis }}</td>
        </tr>
        <tr>
            <td>Nama:</td>
            <td>:</td>
            <td>{{ $item->nama }}</td>
        </tr>
        <tr>
            <td>Email:</td>
            <td>:</td>
            <td>{{ $item->email }}</td>
        </tr>
        <tr>
            <td>No HP:</td>
            <td>:</td>
            <td>{{ $item->no_hp }}</td>
        </tr>

        <tr>
            <td>Jenis Kelamin:</td>
            <td>:</td>
            <td>{{ $item->jk === 'P' ? 'Perempuan' : 'Laki-laki' }}</td>
        </tr>
        <tr>
            <td>TTL:</td>
            <td>:</td>
            <td>{{ $item->ttl }}</td>
        </tr>
</table>
<h3 style="background: green;color:#fff;text-align:center">Data Alamat</h3>

<table class="cstable">
    <tr>
        <td>Provinsi:</td>
        <td>:</td>
        <td>{{ $item->prov }}</td>
    </tr>
    <tr>
        <td>Kabupaten:</td>
        <td>:</td>
        <td>{{ $item->kab }}</td>
    </tr>
    <tr>
        <td>Kecamatan:</td>
        <td>:</td>
        <td>{{ $item->kec }}</td>
    </tr>
    <tr>
        <td>Kelurahan:</td>
        <td>:</td>
        <td>{{ $item->kel }}</td>
    </tr>
    <tr>
        <td>Alamat:</td>
        <td>:</td>
        <td>{{ $item->alamat }}</td>
    </tr>
</table>
<table class="cstable">
    <tr>
        <td>Sekolah Asal:</td>
        <td>:</td>
        <td>{{ $item->sekolah_asal }}</td>
    </tr>
    <tr>
        <td>Tahun Lulus:</td>
        <td>:</td>
        <td>{{ $item->thn_lls }}</td>
    </tr>
    <tr>
        <td>Kelas:</td>
        <td>:</td>
        <td>{{ $item->kelas }}</td>
    </tr>
    <tr>
        <td>ID Pendidikan:</td>
        <td>:</td>
        <td>{{ $item->id_pend }}</td>
    </tr>
    <tr>
        <td>ID Majors:</td>
        <td>:</td>
        <td>{{ $item->id_majors }}</td>
    </tr>
    <tr>
        <td>ID Kelas:</td>
        <td>:</td>
        <td>{{ $item->id_kelas }}</td>
    </tr>
    {{-- <tr>
                        <td>Img Siswa:</td>
                        <td>:</td>
                        <td>{{ $item->img_siswa }}</td>
                    </tr>
                    <tr>
                        <td>Img KK:</td>
                        <td>:</td>
                        <td>{{ $item->img_kk }}</td>
                    </tr>
                    <tr>
                        <td>Img Ijazah:</td>
                        <td>:</td>
                        <td>{{ $item->img_ijazah }}</td>
                    </tr>
                    <tr>
                        <td>Img KTP:</td>
                        <td>:</td>
                        <td>{{ $item->img_ktp }}</td>
                    </tr> --}}
    <tr>
        <td>Raport:</td>
        <td>:</td>
        <td>{{ $item->raport }}</td>
    </tr>
    <tr>
        <td>Status:</td>
        <td>:</td>
        <td>{{ $item->status }}</td>
    </tr>
    <tr>
        <td>Alasan:</td>
        <td>:</td>
        <td>{{ $item->alasan }}</td>
    </tr>
    <tr>
        <td>Date Created:</td>
        <td>:</td>
        <td>{{ $item->date_created }}</td>
    </tr>
    <tr>
        <td>Kode Inv:</td>
        <td>:</td>
        <td>{{ $item->kode_inv }}</td>
    </tr>
    <tr>
        <td>URL Inv:</td>
        <td>:</td>
        <td>{{ $item->url_inv }}</td>
    </tr>
    <tr>
        <td>Inv:</td>
        <td>:</td>
        <td>{{ $item->inv }}</td>
    </tr>
    <tr>
        <td>Date Inv:</td>
        <td>:</td>
        <td>{{ $item->date_inv }}</td>
    </tr>
    <tr>
        <td>Kode Reff:</td>
        <td>:</td>
        <td>{{ $item->kode_reff }}</td>
    </tr>
    <tr>
        <td>Staff Konfirmasi:</td>
        <td>:</td>
        <td>{{ $item->staff_konfirmasi }}</td>
    </tr>
    </tbody>
</table>

<h3 style="background: green;color:#fff;text-align:center">Data Orang Tua</h3>
<table>
    <tr>
        <td>Nama Ayah:</td>
        <td>:</td>
        <td>{{ $item->nama_ayah }}</td>
    </tr>
    <tr>
        <td>Nama Ibu:</td>
        <td>:</td>
        <td>{{ $item->nama_ibu }}</td>
    </tr>
    <tr>
        <td>Pekerjaan Ayah:</td>
        <td>:</td>
        <td>{{ $item->pek_ayah }}</td>
    </tr>
    <tr>
        <td>Pekerjaan Ibu:</td>
        <td>:</td>
        <td>{{ $item->pek_ibu }}</td>
    </tr>
    <tr>
        <td>Nama Wali:</td>
        <td>:</td>
        <td>{{ $item->nama_wali }}</td>
    </tr>
    <tr>
        <td>Pekerjaan Wali:</td>
        <td>:</td>
        <td>{{ $item->pek_wali }}</td>
    </tr>
    <tr>
        <td>Penghasilan Orang Tua:</td>
        <td>:</td>
        <td>{{ $item->peng_ortu }}</td>
    </tr>
    <tr>
        <td>No Telp:</td>
        <td>:</td>
        <td>{{ $item->no_telp }}</td>
    </tr>
    <tr>
        <td>Tahun Masuk:</td>
        <td>:</td>
        <td>{{ $item->thn_msk }}</td>
    </tr>
</table>

<div class="float:right">
    <br />
    <h4>Panitia PPDB</h4>
    (ADMIN)
</div>
