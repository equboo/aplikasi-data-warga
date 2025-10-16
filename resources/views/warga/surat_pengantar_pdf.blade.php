<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Surat Pengantar - {{ $warga->nama_lengkap }}</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; font-size: 12px; line-height: 1.5; }
        
        /* ===== BAGIAN KOP SURAT YANG DIPERBAIKI ===== */
        .kop-surat { width: 100%; border-collapse: collapse; border-bottom: 3px solid black; }
        .kop-surat td { vertical-align: middle; }
        .kop-surat .logo { width: 75px; height: auto; }
        .kop-surat .kop-text { text-align: center; line-height: 1.2; }
        .kop-surat .kop-text h1 { font-size: 18px; font-weight: bold; margin: 0; padding: 0; }
        .kop-surat .kop-text h2 { font-size: 16px; font-weight: bold; margin: 0; padding: 0; }
        .kop-surat .kop-text p { font-size: 10px; margin: 0; padding: 0; }
        .double-line { border-bottom: 1px solid black; height: 1px; margin-top: 2px; }
        /* ===== AKHIR BAGIAN KOP SURAT ===== */

        .judul-surat { text-align: center; margin-top: 25px; margin-bottom: 20px; }
        .judul-surat h3 { text-decoration: underline; font-size: 14px; margin: 0; font-weight: bold; }
        .judul-surat p { margin: 0; font-size: 11px; }
        .isi-surat { margin-top: 20px; }
        .isi-surat table { width: 100%; }
        .isi-surat table td { padding: 2px 0; vertical-align: top; }
        .penutup { margin-top: 20px; }
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
                <p>Sekretariat : Blok C5 No. 4, No. Tlp : 0812-8758-5428</p>
            </td>
            <td style="width: 15%;">
                </td>
        </tr>
    </table>
    <div class="double-line"></div>

    <div class="judul-surat">
        <h3>SURAT PENGANTAR</h3>
        <p>Nomor: {{ $nomor_surat }}</p>
    </div>

    <div class="isi-surat">
        <p>Yang bertanda tangan di bawah ini, Ketua RT.06/RW.07 Perumahan Villa Padurenan Indah 2, Kelurahan Padurenan, Kecamatan Mustikajaya, dengan ini menerangkan bahwa:</p>
        
        <table style="margin-left: 20px;">
            <tr>
                <td style="width: 30%;">Nama Lengkap</td>
                <td style="width: 2%;">:</td>
                <td style="width: 68%;"><strong>{{ strtoupper($warga->nama_lengkap) }}</strong></td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td>{{ $warga->nik }}</td>
            </tr>
            <tr>
                <td>Tempat/Tanggal Lahir</td>
                <td>:</td>
                <td>{{ $warga->tempat_lahir }}, {{ \Carbon\Carbon::parse($warga->tanggal_lahir)->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>{{ $warga->jenis_kelamin }}</td>
            </tr>
            <tr>
                <td>Status Perkawinan</td>
                <td>:</td>
                <td>{{ $warga->status_perkawinan }}</td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>:</td>
                <td>{{ $warga->agama }}</td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>:</td>
                <td>{{ $warga->pekerjaan }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $warga->alamat }}, RT.{{$warga->rt}}/RW.{{$warga->rw}}</td>
            </tr>
        </table>

        <p>Adalah benar warga kami yang berdomisili di alamat tersebut di atas. Surat pengantar ini diberikan untuk keperluan:</p>
        <p style="text-align: center; font-weight: bold; margin: 15px 0;">{{ strtoupper($keperluan) }}</p>
    </div>

    @if (!empty($persyaratan))
        <div class="persyaratan" style="margin-top: 20px;">
            <p>Sebagai kelengkapan administrasi, yang bersangkutan diharapkan untuk melampirkan dokumen-dokumen sebagai berikut:</p>
            <ol style="margin-left: 30px; padding-left: 0; margin-top: 5px;">
                @foreach ($persyaratan as $syarat)
                    <li>{{ $syarat }}</li>
                @endforeach
            </ol>
        </div>
    @endif

    <div class="penutup">
        <p>Demikian surat pengantar ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>
    </div>

    <div class="ttd">
        <table>
            <tr>
                <td></td>
                <td>
                    Bekasi, {{ $tanggal_surat }}<br>
                    Ketua RT.06 / RW.07
                    <div style="height: 60px;"></div>
                    <strong><u>{{ strtoupper($ketua_rt) }}</u></strong>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>