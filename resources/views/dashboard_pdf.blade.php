<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Statistik Kependudukan</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; font-size: 12px; line-height: 1.5; }
        /* Kop Surat */
        .kop-surat { width: 100%; border-collapse: collapse; border-bottom: 3px solid black; }
        .kop-surat td { vertical-align: middle; }
        .kop-surat .logo { width: 75px; height: auto; }
        .kop-surat .kop-text { text-align: center; line-height: 1.2; }
        .kop-surat .kop-text h1 { font-size: 18px; font-weight: bold; margin: 0; }
        .kop-surat .kop-text h2 { font-size: 16px; font-weight: bold; margin: 0; }
        .kop-surat .kop-text p { font-size: 10px; margin: 0; }
        .double-line { border-bottom: 1px solid black; height: 1px; margin-top: 2px; }
        
        .judul-surat { text-align: center; margin-top: 25px; margin-bottom: 20px; }
        .judul-surat h3 { text-decoration: underline; font-size: 14px; margin: 0; font-weight: bold; }
        
        .content-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .content-table th, .content-table td { border: 1px solid #666; padding: 5px; }
        .content-table thead th { background-color: #e9ecef; text-align: center; }
        .content-table .label { width: 70%; }
        .content-table .value { width: 30%; text-align: center; }

        .ttd { margin-top: 40px; }
        .ttd table { width: 100%; }
        .ttd table td { text-align: center; width: 50%; }
    </style>
</head>
<body>
    <table class="kop-surat">
        <tr>
            <td style="width: 15%; text-align: center;">
                <img src="{{ public_path('images/logo-kotabekasi.png') }}" alt="Logo" class="logo">
            </td>
            <td style="width: 70%;" class="kop-text">
                <h1>RUKUN TETANGGA 06 / RUKUN WARGA 07</h1>
                <h2>PERUMAHAN VILLA PADURENAN INDAH 2</h2>
                <p>Kelurahan Padurenan, Kecamatan Mustika Jaya – KOTA BEKASI</p>
            </td>
            <td style="width: 15%;"></td>
        </tr>
    </table>
    <div class="double-line"></div>

    <div class="judul-surat">
        <h3>LAPORAN STATISTIK KEPENDUDUKAN</h3>
        <p>Dicetak pada: {{ $tanggal_cetak }}</p>
    </div>

    <table class="content-table">
        <thead>
            <tr><th colspan="2">Klasifikasi Jenis Kelamin</th></tr>
        </thead>
        <tbody>
            @foreach($genderData as $label => $total)
            <tr>
                <td class="label">{{ $label }}</td>
                <td class="value">{{ $total }} Warga</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table class="content-table">
        <thead>
            <tr><th colspan="2">Klasifikasi Kelompok Usia</th></tr>
        </thead>
        <tbody>
            @foreach($ageGroups as $label => $total)
            <tr>
                <td class="label">{{ $label }}</td>
                <td class="value">{{ $total }} Warga</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table class="content-table">
        <thead>
            <tr><th colspan="2">Klasifikasi Pendidikan Terakhir</th></tr>
        </thead>
        <tbody>
            @foreach($educationData as $label => $total)
            <tr>
                <td class="label">{{ $label }}</td>
                <td class="value">{{ $total }} Warga</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table class="content-table">
        <thead>
            <tr><th colspan="2">Klasifikasi Agama</th></tr>
        </thead>
        <tbody>
            @foreach($religionData as $label => $total)
            <tr>
                <td class="label">{{ $label }}</td>
                <td class="value">{{ $total }} Warga</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="ttd">
        <table>
            <tr>
                <td></td>
                <td>
                    Bekasi, {{ $tanggal_cetak }}<br>
                    Ketua RT.06 / RW.07
                    <div style="height: 60px;"></div>
                    <strong><u>{{ strtoupper($ketua_rt) }}</u></strong>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>