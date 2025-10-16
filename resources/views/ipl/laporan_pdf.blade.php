<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Keuangan - {{ $bulan }} {{ $tahun }}</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; font-size: 11pt; margin: 30px; }
        .kop-surat { text-align: center; border-bottom: 2px solid black; padding-bottom: 10px; margin-bottom: 20px; }
        .kop-surat h1 { font-size: 16pt; margin: 0; }
        .kop-surat h2 { font-size: 14pt; margin: 0; font-weight: normal; }
        .main-table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .main-table th, .main-table td { border: 1px solid #666; padding: 5px; text-align: left; }
        .main-table thead th { background-color: #e9ecef; text-align: center; }
        .main-table tbody th { background-color: #f8f9fa; text-align: left; padding-left: 10px; }
        .main-table td.amount { text-align: right; }
        .main-table tfoot td { font-weight: bold; }
        .signature-table { width: 100%; margin-top: 40px; }
        .signature-table td { text-align: center; width: 50%; }
    </style>
</head>
<body>
    <div class="kop-surat">
        <h1>LAPORAN KEUANGAN KAS RT.06/RW.07</h1>
        <h2>PERUMAHAN VILLA PADURENAN INDAH 2</h2>
        <h2>PERIODE: {{ strtoupper($bulan) }} {{ $tahun }}</h2>
    </div>

    <table class="main-table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">Tanggal</th>
                <th>Keterangan</th>
                <th style="width: 25%;">Jumlah</th>
            </tr>
        </thead>
        
        <tbody>
            <tr>
                <th colspan="4">I. PEMASUKAN</th>
            </tr>
            @if($pemasukanIuran > 0)
            <tr>
                <td style="text-align: center;">1</td>
                <td>Beragam Tanggal</td>
                <td>Pemasukan Iuran Warga</td>
                <td class="amount">Rp {{ number_format($pemasukanIuran, 0, ',', '.') }}</td>
            </tr>
            @endif
            @php $pemasukanCounter = $pemasukanIuran > 0 ? 2 : 1; @endphp
            @foreach($pemasukans as $item)
            <tr>
                <td style="text-align: center;">{{ $pemasukanCounter++ }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_pemasukan)->format('d-m-Y') }}</td>
                <td>{{ $item->keterangan }}</td>
                <td class="amount">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            @if($pemasukanIuran == 0 && $pemasukans->isEmpty())
            <tr>
                <td colspan="4" style="text-align: center; font-style: italic;">Tidak ada pemasukan pada periode ini.</td>
            </tr>
            @endif
        </tbody>
        
        <tbody>
            <tr>
                <th colspan="4">II. PENGELUARAN</th>
            </tr>
            @forelse($pengeluarans as $item)
            <tr>
                <td style="text-align: center;">{{ $loop->iteration }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_pengeluaran)->format('d-m-Y') }}</td>
                <td>{{ $item->keterangan }}</td>
                <td class="amount">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center; font-style: italic;">Tidak ada pengeluaran pada periode ini.</td>
            </tr>
            @endforelse
        </tbody>

        <tfoot>
            <tr style="background-color: #e9ecef;">
                <td colspan="3" class="amount">TOTAL PEMASUKAN</td>
                <td class="amount">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</td>
            </tr>
            <tr style="background-color: #e9ecef;">
                <td colspan="3" class="amount">TOTAL PENGELUARAN</td>
                <td class="amount">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
            </tr>
            <tr style="background-color: #d1e7dd;">
                <td colspan="3" class="amount" style="font-size: 12pt;">SALDO AKHIR</td>
                <td class="amount" style="font-size: 12pt;">Rp {{ number_format($saldo, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
    <table class="signature-table">
        <tr>
            <td>
                Mengetahui,<br>
                Ketua RT.06/RW.07
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