<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $title }}</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; font-size: 11pt; margin: 30px; }
        /* KOP SURAT */
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

        .document-title { text-align: center; margin-bottom: 20px; }
        .document-title h3 { font-size: 14pt; text-decoration: underline; margin: 0; }
        .document-title p { font-size: 10pt; margin-top: 2px; }
        .main-table { width: 100%; border-collapse: collapse; }
        .main-table th, .main-table td { border: 1px solid #333; padding: 5px; text-align: left; }
        .main-table thead th { background-color: #e9ecef; text-align: center; }
    </style>
</head>
<body>
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

    <div class="document-title">
        <h3>DAFTAR KEPALA KELUARGA</h3>
        <p>Dicetak pada: {{ $date }}</p>
    </div>
    <table class="main-table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 20%;">No. KK</th>
                <th>Nama Kepala Keluarga</th>
                <th>Alamat</th>
                <th style="width: 20%;">Status Rumah</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kepalaKeluargas as $keluarga)
                <tr>
                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                    <td>{{ $keluarga->nomor_kk }}</td>
                    <td>{{ $keluarga->kepala_keluarga }}</td>
                    <td>{{ $keluarga->alamat }}</td>
                    <td>{{ $keluarga->status_rumah }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">Data tidak ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>