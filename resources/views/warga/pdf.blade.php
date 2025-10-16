<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $title }}</title>
    <style>
        body { 
            font-family: 'Times New Roman', Times, serif; 
            font-size: 10pt;
        }

        /* Styling Kop Surat (Sama seperti Surat Pengantar) */
        .kop-surat { width: 100%; border-collapse: collapse; border-bottom: 3px solid black; }
        .kop-surat td { vertical-align: middle; }
        .kop-surat .logo { width: 75px; height: auto; }
        .kop-surat .kop-text { text-align: center; line-height: 1.2; }
        .kop-surat .kop-text h1 { font-size: 18px; font-weight: bold; margin: 0; }
        .kop-surat .kop-text h2 { font-size: 16px; font-weight: bold; margin: 0; }
        .kop-surat .kop-text p { font-size: 10px; margin: 0; }
        .double-line { border-bottom: 1px solid black; height: 1px; margin-top: 2px; }

        /* Styling Judul Dokumen */
        .document-title {
            text-align: center;
            margin-top: 25px;
            margin-bottom: 20px;
        }
        .document-title h3 {
            font-size: 14pt;
            text-decoration: underline;
            margin: 0;
            font-weight: bold;
        }
        .document-title p {
            font-size: 10pt;
            margin-top: 2px;
        }

        /* Styling Tabel Utama */
        .main-table {
            width: 100%;
            border-collapse: collapse;
        }
        .main-table th, .main-table td {
            border: 1px solid #333;
            padding: 5px;
            text-align: left;
        }
        .main-table thead th {
            background-color: #e9ecef;
            font-weight: bold;
            text-align: center;
        }
        .main-table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .main-table td.center {
            text-align: center;
        }
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

    <div class="document-title">
        <h3>DAFTAR SELURUH WARGA</h3>
        <p>Dicetak pada: {{ $date }}</p>
    </div>

    <table class="main-table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">NIK</th>
                <th>Nama Lengkap</th>
                <th style="width: 12%;">Jenis Kelamin</th>
                <th style="width: 10%;">Tgl. Lahir</th>
                <th style="width: 10%;">Agama</th>
                <th style="width: 10%;">Status Perkawinan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($wargas as $warga)
                <tr>
                    <td class="center">{{ $loop->iteration }}</td>
                    <td>{{ $warga->nik }}</td>
                    <td>{{ $warga->nama_lengkap }}</td>
                    <td>{{ $warga->jenis_kelamin }}</td>
                    <td class="center">{{ \Carbon\Carbon::parse($warga->tanggal_lahir)->format('d-m-Y') }}</td>
                    <td>{{ $warga->agama }}</td>
                    <td>{{ $warga->status_perkawinan }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="center">Data tidak ditemukan sesuai filter yang diterapkan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>