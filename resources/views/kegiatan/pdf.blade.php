<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Laporan Kegiatan - {{ $kegiatan->judul }}</title>
<style>
    body {
        font-family: "Times New Roman", serif;
        font-size: 12px;
        margin: 30px 45px;
        line-height: 1.4;
    }
        /* Kop Surat */
        .kop-surat {
            width: 100%;
            border-collapse: collapse;
            border-bottom: 3px double black;
        }
        .kop-surat td {
            vertical-align: middle;
        }
        .logo {
            width: 85px;
            height: auto;
        }
        .kop-text {
            text-align: center;
            line-height: 1.3;
        }
        .kop-text h1 {
            font-size: 16pt;
            font-weight: bold;
            margin: 0;
            text-transform: uppercase;
        }
        .kop-text h2 {
            font-size: 14pt;
            font-weight: bold;
            margin: 0;
            text-transform: uppercase;
        }
        .kop-text p {
            font-size: 11pt;
            margin: 0;
        }
        .double-line {
            border-bottom: 2px solid black;
            height: 1px;
            margin-top: 2px;
        }

    .section-title {
        text-align: center;
        font-weight: bold;
        text-decoration: underline;
        font-size: 14px;
        margin: 18px 0;
    }

    /* Info Table */
    .info-table {
        width: 100%; border-collapse: collapse; margin-bottom: 15px;
    }
    .info-table td {
        padding: 6px 8px; border: 1px solid #ddd; vertical-align: top;
    }
    .info-label {
        width: 32%; background-color: #f2f2f2; font-weight: bold;
    }

    /* Foto Table */
    th {
        font-size:12px;
        font-weight:bold;
        text-decoration:underline;
        padding: 6px;
    }
    td {
        padding: 6px;
        text-align: center;
    }
    img {
        width: 100%;
        max-width: 240px;
        height: 130px;
        object-fit: cover;
        border: 1px solid #888;
        border-radius: 4px;
    }

    /* TTD */
    .ttd {
        width: 100%;
        margin-top: 30px;
        text-align: right;
    }
    .ttd .jabatan {
        margin-bottom: 80px
    }
</style>
</head>

<body>

    <!-- Kop Surat -->
    <table class="kop-surat">
        <tr>
            <td style="width: 15%; text-align: center;">
                <img src="{{ public_path('images/logo-kotabekasi.png') }}" alt="Logo" class="logo">
            </td>
            <td style="width: 70%;" class="kop-text">
                <h1>PEMERINTAH KOTA BEKASI</h1>
                <h2>RUKUN TETANGGA 006 / RUKUN WARGA 007</h2>
                <p>KELURAHAN PADURENAN KECAMATAN MUSTIKA JAYA KOTA BEKASI 17157</p>
                <p><b>Sekretariat :</b> Villa Padurenan Indah 2 Blok C No. 5 Telp. 089611492332</p>
            </td>
            <td style="width: 15%;"></td>
        </tr>
    </table>
    <div class="double-line"></div>

    <div class="section-title">LAPORAN KEGIATAN</div>

    <!-- Informasi Kegiatan -->
    <table class="info-table">
        <tr><td class="info-label">Nama Kegiatan</td><td>{{ $kegiatan->judul }}</td></tr>
        <tr><td class="info-label">Tanggal Pelaksanaan</td><td>{{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->translatedFormat('d F Y') }}</td></tr>
        <tr><td class="info-label">Penanggung Jawab</td><td>{{ $kegiatan->penanggung_jawab }}</td></tr>
        <tr><td class="info-label">Peserta</td><td>{{ $kegiatan->peserta ?? '-' }}</td></tr>
        <tr><td class="info-label">Deskripsi Kegiatan</td><td>{{ $kegiatan->deskripsi }}</td></tr>
        <tr><td class="info-label">Biaya Pengeluaran</td><td>{{ $kegiatan->biaya_pengeluaran ? 'Rp ' . number_format($kegiatan->biaya_pengeluaran, 0, ',', '.') : '-' }}</td></tr>
    </table>

    <!-- Foto Before & After Sejajar -->
    @php
        $before = $kegiatan->fotosBefore;
        $after = $kegiatan->fotosAfter;
        $max = max(count($before), count($after));
    @endphp

    @if ($max > 0)
    <table style="width:100%; border-collapse: collapse; margin-top: 18px;">
        <thead>
            <tr>
                <th style="width:50%;">Dokumentasi Sebelum</th>
                <th style="width:50%;">Dokumentasi Sesudah</th>
            </tr>
        </thead>

        <tbody>
            @for ($i = 0; $i < $max; $i++)
            <tr>
                <td>
                    @if(isset($before[$i]))
                        <img src="file://{{ public_path('storage/' . $before[$i]->path) }}">
                    @endif
                </td>
                <td>
                    @if(isset($after[$i]))
                        <img src="file://{{ public_path('storage/' . $after[$i]->path) }}">
                    @endif
                </td>
            </tr>
            @endfor
        </tbody>
    </table>
    @endif

    <!-- TTD -->
    <div class="ttd">
        Bekasi, {{ $tanggal_cetak }}<br>
        <span class="jabatan">Ketua RT.06 / RW.07</span>
        <br><br><br><br><br>
        <br><strong><u>{{ strtoupper($ketua_rt) }}</u></strong>
    </div>

</body>
</html>
