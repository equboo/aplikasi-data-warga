<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Keuangan - {{ $bulan }} {{ $tahun }}</title>
    <style>
        @page { margin: 25px 35px 35px 35px; }
        body { 
            font-family: 'Times New Roman', Times, serif; 
            font-size: 11pt; 
            line-height: 1.4; 
            margin: 0;
        }
        /* === KOP SURAT === */
        .kop-surat {
            width: 100%;
            border-collapse: collapse;
        }

        .kop-surat td {
            vertical-align: middle;
            padding: 4px 0;
        }

        .logo {
            width: 70px;
            height: auto;
        }

        .kop-text {
            text-align: center;
            line-height: 1.2;
        }

        .kop-text h1 {
            font-size: 15pt;
            font-weight: bold;
            margin: 0;
        }

        .kop-text h2 {
            font-size: 13pt;
            font-weight: bold;
            margin: 0;
        }

        .kop-text p {
            font-size: 10.5pt;
            margin: 2px 0;
        }

        /* Garis pemisah lebih rapih */
        .divider {
            border-bottom: 2px solid black;
            margin: 4px 0 10px 0;
        }

        /* === JUDUL DOKUMEN === */
        .document-title {
            text-align: center;
            margin-top: 10px;
            margin-bottom: 15px;
        }
        .document-title h3 {
            font-size: 14pt;
            text-decoration: underline;
            font-weight: bold;
            margin: 0;
        }
        .document-title p {
            font-size: 10pt;
            margin: 3px 0 0 0;
        }

        /* === TABEL UTAMA === */
        .main-table {
            width: 100%;
            border-collapse: collapse;
        }
        .main-table th, .main-table td {
            border: 1px solid #333;
            padding: 5px;
            vertical-align: middle;
        }
        .main-table thead th {
            background-color: #e9ecef;
            text-align: center;
            font-weight: bold;
        }
        .main-table tbody th {
            background-color: #f1f1f1;
            text-align: left;
            padding-left: 10px;
        }
        .main-table td.amount {
            text-align: right;
            white-space: nowrap;
        }
        .main-table td.center {
            text-align: center;
        }
        .main-table tr:nth-child(even):not(tfoot tr) {
            background-color: #f9f9f9;
        }

        /* === FOOTER / TOTAL === */
        tfoot tr td {
            font-weight: bold;
            border-top: 2px solid #333;
            background-color: #f4f4f4;
        }
        tfoot tr:last-child td {
            background-color: #d1e7dd;
            font-size: 12pt;
        }

        /* === TANDA TANGAN === */
        .signature-table {
            width: 100%;
            margin-top: 50px;
        }
        .signature-table td {
            text-align: center;
            width: 50%;
            vertical-align: top;
            font-size: 11pt;
        }
    </style>
</head>
<body>
    <!-- === KOP SURAT === -->
    <!-- Kop Surat -->
<table class="kop-surat">
    <tr>
        <td style="width: 15%; text-align: center;">
            <img src="{{ public_path('images/logo-kotabekasi.png') }}" alt="Logo" class="logo">
        </td>
        <td style="width: 70%;" class="kop-text">
            <h1>PEMERINTAH KOTA BEKASI</h1>
            <h2>RUKUN TETANGGA 006 / RUKUN WARGA 007</h2>
            <p>KELURAHAN PADURENAN, KECAMATAN MUSTIKA JAYA</p>
            <p>KOTA BEKASI 17157</p>
            <p><b>Sekretariat:</b> Villa Padurenan Indah 2 Blok C No. 5 | Telp. 0896-1149-2332</p>
        </td>
        <td style="width: 15%;"></td>
    </tr>
</table>
<div class="divider"></div>

    <!-- === JUDUL === -->
    <div class="document-title">
        <h3>LAPORAN KEUANGAN KAS RT.06 / RW.07</h3>
        <p>PERIODE: {{ strtoupper($bulan) }} {{ $tahun }}</p>
    </div>

    <!-- === TABEL KEUANGAN === -->
    <table class="main-table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">Tanggal</th>
                <th>Keterangan</th>
                <th style="width: 25%;">Jumlah</th>
            </tr>
        </thead>

        <!-- === PEMASUKAN === -->
        <tbody>
            <tr>
                <th colspan="4">I. PEMASUKAN</th>
            </tr>
            @if($pemasukanIuran > 0)
            <tr>
                <td class="center">1</td>
                <td>Beragam Tanggal</td>
                <td>Pemasukan Iuran Warga</td>
                <td class="amount">Rp {{ number_format($pemasukanIuran, 0, ',', '.') }}</td>
            </tr>
            @endif
            @php $pemasukanCounter = $pemasukanIuran > 0 ? 2 : 1; @endphp
            @foreach($pemasukans as $item)
            <tr>
                <td class="center">{{ $pemasukanCounter++ }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_pemasukan)->format('d-m-Y') }}</td>
                <td>{{ $item->keterangan }}</td>
                <td class="amount">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            @if($pemasukanIuran == 0 && $pemasukans->isEmpty())
            <tr>
                <td colspan="4" class="center" style="font-style: italic;">Tidak ada pemasukan pada periode ini.</td>
            </tr>
            @endif
        </tbody>

        <!-- === PENGELUARAN === -->
        <tbody>
            <tr>
                <th colspan="4">II. PENGELUARAN</th>
            </tr>
            @forelse($pengeluarans as $item)
            <tr>
                <td class="center">{{ $loop->iteration }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_pengeluaran)->format('d-m-Y') }}</td>
                <td>{{ $item->keterangan }}</td>
                <td class="amount">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="center" style="font-style: italic;">Tidak ada pengeluaran pada periode ini.</td>
            </tr>
            @endforelse
        </tbody>

        <!-- === TOTAL === -->
        <tfoot>
            <tr>
                <td colspan="3" class="amount">TOTAL PEMASUKAN</td>
                <td class="amount">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="3" class="amount">TOTAL PENGELUARAN</td>
                <td class="amount">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="3" class="amount">SALDO AKHIR</td>
                <td class="amount">Rp {{ number_format($saldo, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <!-- === TANDA TANGAN === -->
    <table class="signature-table">
        <tr>
            <td>
                Mengetahui,<br>
                Ketua RT.06 / RW.07
                <div style="height: 60px;"></div>
                <strong><u>{{ strtoupper($ketua_rt) }}</u></strong>
            </td>
            <td>
                Bekasi, {{ $tanggal_cetak }}<br>
                Bendahara
                <div style="height: 60px;"></div>
                <strong><u>{{ strtoupper($bendahara) }}</u></strong>
            </td>
        </tr>
    </table>
</body>
</html>
