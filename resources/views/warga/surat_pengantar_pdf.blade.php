<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Surat Pengantar - {{ $warga->nama_lengkap }}</title>
    <style>
        @page { margin: 40px 50px 40px 50px; }

        body { 
            font-family: 'Times New Roman', Times, serif; 
            font-size: 12px; 
            line-height: 1.5; 
            margin: 0;
        }

        /* === KOP SURAT === */
        .kop-container {
            width: 100%;
            margin-bottom: 5px;
        }
        .kop-surat {
            width: 100%;
            border-collapse: collapse;
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
            line-height: 1.4;
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
            margin: 2px 0;
        }

        /* === GARIS PEMBATAS KOP === */
        .kop-line {
            width: 100%;
            border: none;
            border-top: 3px double black;
            height: 3px;
            margin-top: 3px;
            margin-bottom: 10px;
        }

        /* === JUDUL & ISI SURAT === */
        .judul-surat { 
            text-align: center; 
            margin-top: 10px; 
            margin-bottom: 20px; 
        }
        .judul-surat h3 { 
            text-decoration: underline; 
            font-size: 14px; 
            margin: 0; 
            font-weight: bold; 
        }
        .judul-surat p { 
            margin: 0; 
            font-size: 11px; 
        }
        .isi-surat { margin-top: 15px; }
        .isi-surat table { width: 100%; border-collapse: collapse; }
        .isi-surat table td { padding: 2px 0; vertical-align: top; }

        /* === PENUTUP & TTD === */
        .penutup { margin-top: 15px; }
        .ttd { margin-top: 40px; }
        .ttd table { width: 100%; border-collapse: collapse; }
        .ttd table td { text-align: center; width: 50%; vertical-align: top; }
    </style>
</head>
<body>

    <!-- === KOP SURAT === -->
    <div class="kop-container">
        <table class="kop-surat">
            <tr>
                <td style="width: 15%; text-align: center;">
                    <img src="{{ public_path('images/logo-kotabekasi.png') }}" alt="Logo" class="logo">
                </td>
                <td style="width: 70%;" class="kop-text">
                    <h1>PEMERINTAH KOTA BEKASI</h1>
                    <h2>RUKUN TETANGGA 006 / RUKUN WARGA 007</h2>
                    <p><strong>KELURAHAN PADURENAN, KECAMATAN MUSTIKA JAYA</strong></p>
                    <p><strong>KOTA BEKASI 17157</strong></p>
                    <p><b>Sekretariat :</b> Villa Padurenan Indah 2 Blok C No. 5 Telp. 089611492332</p>
                </td>
                <td style="width: 15%;"></td>
            </tr>
        </table>
        <hr class="kop-line">
    </div>

    <!-- === ISI SURAT === -->
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
