<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Kartu Keluarga - {{ $kepalaKeluarga->nomor_kk }}</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; font-size: 8.5pt; margin: 0; }
        .page { padding: 20px; }
        .header-table { width: 100%; border-collapse: collapse; }
        .header-table td { vertical-align: top; padding: 0; }
        .main-title { font-size: 14px; font-weight: bold; text-align: center; letter-spacing: 2px; }
        .sub-title { font-size: 12px; font-weight: bold; text-align: center; }
        .address-table { width: 100%; font-size: 9pt; }
        .address-table td { padding: 0 5px 0 0; line-height: 1.1; }
        .content-table { width: 100%; border-collapse: collapse; margin-top: 8px; }
        .content-table th, .content-table td { border: 1px solid black; padding: 2px; text-align: center; vertical-align: middle; }
        .content-table td.text-left { text-align: left; padding-left: 3px; }
        .footer-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .footer-table td { vertical-align: top; text-align: center; font-size: 9pt; line-height: 1.3; }
        .disclaimer { font-size: 7pt; margin-top: 8px; text-align: left; }
    </style>
</head>
<body>
    <div class="page">
        {{-- Bagian Header --}}
        <table class="header-table" style="margin-top: 8px;">
            <tr>
                <td style="width: 65%;">
                    <table class="address-table">
                        <tr>
                            <td style="width: 25%;">Nama Kepala Keluarga</td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 73%;">{{ strtoupper($kepalaKeluarga->kepala_keluarga ?? '-') }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>{{ strtoupper($kepalaKeluarga->alamat ?? '-') }}</td>
                        </tr>
                        <tr>
                            <td>RT/RW</td>
                            <td>:</td>
                            <td>{{ $kepalaKeluarga->rt ?? '-' }} / {{ $kepalaKeluarga->rw ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td>Kode Pos</td>
                            <td>:</td>
                            <td>{{ $kepalaKeluarga->kode_pos ?? '-' }}</td>
                        </tr>
                    </table>
                </td>
                <td style="width: 35%;">
                    <table class="address-table">
                        <tr>
                            <td style="width: 35%;">Desa/Kelurahan</td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 63%;">{{ strtoupper($kepalaKeluarga->desa_kelurahan ?? '-') }}</td>
                        </tr>
                        <tr>
                            <td>Kecamatan</td>
                            <td>:</td>
                            <td>{{ strtoupper($kepalaKeluarga->kecamatan ?? '-') }}</td>
                        </tr>
                        <tr>
                            <td>Kabupaten/Kota</td>
                            <td>:</td>
                            <td>{{ strtoupper($kepalaKeluarga->kabupaten_kota ?? '-') }}</td>
                        </tr>
                        <tr>
                            <td>Provinsi</td>
                            <td>:</td>
                            <td>{{ strtoupper($kepalaKeluarga->provinsi ?? '-') }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        
        {{-- Tabel Atas --}}
        <table class="content-table">
            <thead>
                <tr>
                    <th>No<br>(1)</th>
                    <th>Nama Lengkap<br>(2)</th>
                    <th>NIK<br>(3)</th>
                    <th>Jenis Kelamin<br>(4)</th>
                    <th>Tempat Lahir<br>(5)</th>
                    <th>Tanggal Lahir<br>(6)</th>
                    <th>Agama<br>(7)</th>
                    <th>Pendidikan<br>(8)</th>
                    <th>Jenis Pekerjaan<br>(9)</th>
                    <th>Golongan Darah<br>(10)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($anggotaKeluarga as $anggota)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="text-left">{{ strtoupper($anggota->nama_lengkap ?? '-') }}</td>
                    <td>{{ $anggota->nik ?? '-' }}</td>
                    <td>{{ strtoupper($anggota->jenis_kelamin ?? '-') }}</td>
                    <td class="text-left">{{ strtoupper($anggota->tempat_lahir ?? '-') }}</td>
                    <td>{{ $anggota->tanggal_lahir ? \Carbon\Carbon::parse($anggota->tanggal_lahir)->format('d-m-Y') : '-' }}</td>
                    <td class="text-left">{{ $anggota->agama ?? '-' }}</td>
                    <td class="text-left">{{ $anggota->pendidikan ?? '-' }}</td>
                    <td class="text-left">{{ $anggota->pekerjaan ?? '-' }}</td>
                    <td>-</td>
                </tr>
                @endforeach
                @for ($i = $anggotaKeluarga->count() + 1; $i <= 10; $i++)
                <tr>
                    <td>{{ $i }}</td> @for ($j = 0; $j < 9; $j++) <td>&nbsp;</td> @endfor
                </tr>
                @endfor
            </tbody>
        </table>

        {{-- Tabel Bawah --}}
        <table class="content-table" style="margin-top: -1px;">
             <thead>
                <tr>
                    <th>No.</th>
                    <th>Status Perkawinan<br>(11)</th>
                    <th>Tanggal Perkawinan/Perceraian<br>(12)</th>
                    <th>Status Hubungan Dalam Keluarga<br>(13)</th>
                    <th>Kewarganegaraan<br>(14)</th>
                    <th>Dokumen Imigrasi<br>No. Paspor (15)</th>
                    <th>Dokumen Imigrasi<br>No. KITAP (16)</th>
                    <th>Nama Orang Tua<br>Ayah (17)</th>
                    <th>Nama Orang Tua<br>Ibu (18)</th>
                </tr>
            </thead>
            <tbody>
                 @foreach($anggotaKeluarga as $anggota)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="text-left">{{ $anggota->status_perkawinan ?? '-' }}</td>
                    <td>-</td>
                    <td class="text-left">{{ $anggota->hubungan_keluarga ?? '-' }}</td>
                    <td>{{ $anggota->kewarganegaraan ?? '-' }}</td>
                    <td>{{ $anggota->no_paspor ?? '-' }}</td>
                    <td>{{ $anggota->no_kitas_kitap ?? '-' }}</td>
                    <td class="text-left">{{ strtoupper($anggota->nama_ayah ?? '-') }}</td>
                    <td class="text-left">{{ strtoupper($anggota->nama_ibu ?? '-') }}</td>
                </tr>
                @endforeach
                @for ($i = $anggotaKeluarga->count() + 1; $i <= 10; $i++)
                <tr>
                    <td>{{ $i }}</td> @for ($j = 0; $j < 8; $j++) <td>&nbsp;</td> @endfor
                </tr>
                @endfor
            </tbody>
        </table>
        
        {{-- Bagian Tanda Tangan --}}
        <table class="footer-table">
            <tr>
                <td style="width: 33%;">
                    Dikeluarkan Tanggal : {{ \Carbon\Carbon::now()->format('d-m-Y') }}<br>
                    KEPALA KELUARGA
                    <div style="height: 40px;"></div>
                    <u>{{ strtoupper($kepalaKeluarga->kepala_keluarga ?? '-') }}</u><br>
                    <span style="font-size: 8pt;">Tanda Tangan/Cap Jempol</span>
                </td>
                <td style="width: 33%;"></td>
                <td style="width: 33%;">
                    KEPALA DINAS KEPENDUDUKAN DAN<br>
                    PENCATATAN SIPIL KOTA BEKASI
                    <div style="height: 40px; text-align: center;"></div>
                    <u>TAUFIQ RACHMAT HIDAYAT, AP, S.Sos, M.Si</u><br>
                    <span style="font-size: 8pt;">NIP. 197510011993111002</span>
                </td>
            </tr>
        </table>
         <div class="disclaimer">
            Dokumen ini telah ditandatangani secara elektronik menggunakan sertifikat elektronik yang diterbitkan oleh Balai Sertifikasi Elektronik (BSrE), BSSN
        </div>
    </div>
</body>
</html>