<!DOCTYPE html>
<html>
<head>
    <title>Laporan Status IPL</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 10px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 16px; }
        .header p { margin: 2px 0; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #666; padding: 5px; text-align: left; }
        th { background-color: #e9ecef; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Status Iuran Pengelolaan Lingkungan (IPL)</h1>
        <p>RT.06 / RW.07 Villa Padurenan Indah 2</p>
        <p><strong>Periode: {{ $periode }}</strong> | Dicetak pada: {{ $tanggal_cetak }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th>Nama Kepala Keluarga</th>
                <th>Alamat</th>
                <th style="width: 15%;">Status Pembayaran</th>
                <th style="width: 15%;">Tanggal Pelunasan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kepalaKeluargas as $keluarga)
                @php
                    $iuran = $iurans->get($keluarga->id);
                    $statusText = 'BELUM LUNAS';
                    $tanggalBayar = '-';
                    if ($iuran && $iuran->status == 'Lunas') {
                        $statusText = 'LUNAS';
                        $tanggalBayar = $iuran->tanggal_bayar ? \Carbon\Carbon::parse($iuran->tanggal_bayar)->format('d-m-Y') : '-';
                    }
                @endphp
            <tr>
                <td style="text-align: center;">{{ $loop->iteration }}</td>
                <td>{{ $keluarga->nama_lengkap }}</td>
                <td>{{ $keluarga->alamat }}</td>
                <td style="text-align: center;">{{ $statusText }}</td>
                <td style="text-align: center;">{{ $tanggalBayar }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center;">Tidak ada data yang cocok dengan filter.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>