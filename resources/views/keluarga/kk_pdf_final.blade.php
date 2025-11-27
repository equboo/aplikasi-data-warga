<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Kartu Keluarga - {{ $kepalaKeluarga->nomor_kk }}</title>
    <style>
        @page { margin: 15px 25px 15px 25px; }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 8pt;
            line-height: 1.15;
            margin: 0;
        }

        /* === HEADER === */
        .kk-header {
            text-align: center;
            margin-bottom: 2px;
        }
        .kk-header h1 {
            font-size: 13pt;
            font-weight: bold;
            margin: 0;
            letter-spacing: 1.5px;
        }
        .kk-header h2 {
            font-size: 10pt;
            margin: 0;
            font-weight: bold;
        }

        /* === INFO ALAMAT === */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 3px;
            margin-bottom: 2px;
        }
        .info-table td {
            font-size: 8pt;
            padding: 0 2px;
            vertical-align: top;
        }

        /* === TABEL UTAMA === */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid black;
        }
        .data-table th, .data-table td {
            border: 1px solid black;
            padding: 1px 2px;
            text-align: center;
            vertical-align: middle;
        }
        .data-table th {
            font-size: 7pt;
            font-weight: bold;
        }
        .data-table td.text-left {
            text-align: left;
        }

        /* === FOOTER === */
        .footer-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 8pt;
            margin-top: 5px;
        }
        .footer-table td {
            vertical-align: top;
            text-align: center;
            padding: 0;
        }

        .disclaimer {
            font-size: 6.5pt;
            margin-top: 4px;
            text-align: left;
        }
    </style>
</head>
<body>

    <div class="kk-header">
        <h1>KARTU KELUARGA</h1>
        <h2>No. {{ $kepalaKeluarga->nomor_kk ?? '-' }}</h2>
    </div>

    <!-- INFO KELUARGA -->
    <table class="info-table">
        <tr>
            <td style="width: 22%;">Nama Kepala Keluarga</td>
            <td style="width: 2%;">:</td>
            <td style="width: 35%; font-weight: bold;">{{ strtoupper($kepalaKeluarga->kepala_keluarga ?? '-') }}</td>
            <td style="width: 22%;">Desa/Kelurahan</td>
            <td style="width: 2%;">:</td>
            <td style="width: 17%;">{{ strtoupper($kepalaKeluarga->desa_kelurahan ?? '-') }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ strtoupper($kepalaKeluarga->alamat ?? '-') }}</td>
            <td>Kecamatan</td>
            <td>:</td>
            <td>{{ strtoupper($kepalaKeluarga->kecamatan ?? '-') }}</td>
        </tr>
        <tr>
            <td>RT/RW</td>
            <td>:</td>
            <td>{{ $kepalaKeluarga->rt ?? '-' }} / {{ $kepalaKeluarga->rw ?? '-' }}</td>
            <td>Kabupaten/Kota</td>
            <td>:</td>
            <td>{{ strtoupper($kepalaKeluarga->kabupaten_kota ?? '-') }}</td>
        </tr>
        <tr>
            <td>Kode Pos</td>
            <td>:</td>
            <td>{{ $kepalaKeluarga->kode_pos ?? '-' }}</td>
            <td>Provinsi</td>
            <td>:</td>
            <td>{{ strtoupper($kepalaKeluarga->provinsi ?? '-') }}</td>
        </tr>
    </table>

    <!-- === TABEL ATAS === -->
    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>NIK</th>
                <th>Jenis Kelamin</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Agama</th>
                <th>Pendidikan</th>
                <th>Jenis Pekerjaan</th>
                <th>Gol. Darah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($anggotaKeluarga as $anggota)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td class="text-left">{{ strtoupper($anggota->nama_lengkap ?? '-') }}</td>
                <td>{{ $anggota->nik ?? '-' }}</td>
                <td>{{ strtoupper($anggota->jenis_kelamin ?? '-') }}</td>
                <td>{{ strtoupper($anggota->tempat_lahir ?? '-') }}</td>
                <td>{{ $anggota->tanggal_lahir ? \Carbon\Carbon::parse($anggota->tanggal_lahir)->format('d-m-Y') : '-' }}</td>
                <td>{{ strtoupper($anggota->agama ?? '-') }}</td>
                <td>{{ strtoupper($anggota->pendidikan ?? '-') }}</td>
                <td>{{ strtoupper($anggota->pekerjaan ?? '-') }}</td>
                <td>-</td>
            </tr>
            @endforeach
            @for ($i = $anggotaKeluarga->count() + 1; $i <= 10; $i++)
            <tr>
                <td>{{ $i }}</td>
                <td colspan="9">&nbsp;</td>
            </tr>
            @endfor
        </tbody>
    </table>

    <!-- === TABEL BAWAH === -->
    <table class="data-table" style="margin-top: -1px;">
        <thead>
            <tr>
                <th>No</th>
                <th>Status Perkawinan</th>
                <th>Tanggal Perkawinan</th>
                <th>Status Hubungan Dalam Keluarga</th>
                <th>Kewarganegaraan</th>
                <th>No. Paspor</th>
                <th>No. KITAP</th>
                <th>Nama Ayah</th>
                <th>Nama Ibu</th>
            </tr>
        </thead>
        <tbody>
            @foreach($anggotaKeluarga as $anggota)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ strtoupper($anggota->status_perkawinan ?? '-') }}</td>
                <td>{{ $anggota->tanggal_perkawinan ?? '-' }}</td>
                <td>{{ strtoupper($anggota->hubungan_keluarga ?? '-') }}</td>
                <td>{{ strtoupper($anggota->kewarganegaraan ?? '-') }}</td>
                <td>{{ $anggota->no_paspor ?? '-' }}</td>
                <td>{{ $anggota->no_kitas_kitap ?? '-' }}</td>
                <td>{{ strtoupper($anggota->nama_ayah ?? '-') }}</td>
                <td>{{ strtoupper($anggota->nama_ibu ?? '-') }}</td>
            </tr>
            @endforeach
            @for ($i = $anggotaKeluarga->count() + 1; $i <= 10; $i++)
            <tr>
                <td>{{ $i }}</td>
                <td colspan="8">&nbsp;</td>
            </tr>
            @endfor
        </tbody>
    </table>

    <!-- === FOOTER === -->
    <table class="footer-table">
        <tr>
            <td style="width: 35%; text-align: left;">
                Dikeluarkan Tanggal : {{ \Carbon\Carbon::now()->format('d-m-Y') }}<br><br>
                KEPALA KELUARGA<br><br><br><br>
                <u>{{ strtoupper($kepalaKeluarga->kepala_keluarga ?? '-') }}</u><br>
                <span style="font-size: 7pt;">Tanda Tangan / Cap Jempol</span>
            </td>
            <td style="width: 30%;"></td>
            <td style="width: 35%;">
                KEPALA DINAS KEPENDUDUKAN DAN<br>PENCATATAN SIPIL KOTA BEKASI<br><br><br><br>
                <u>TAUFIQ RACHMAT HIDAYAT, AP, S.Sos, M.Si</u><br>
                <span style="font-size: 7pt;">NIP. 197510011993111002</span>
            </td>
        </tr>
    </table>

    <div class="disclaimer">
        Dokumen ini telah ditandatangani secara elektronik menggunakan sertifikat elektronik yang diterbitkan oleh Balai Sertifikasi Elektronik (BSrE), BSSN.
    </div>

</body>
</html>
