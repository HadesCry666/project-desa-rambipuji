<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Tidak Mampu</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 40px;
        }
    
        .judul {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 10px;
            font-weight: bold;
            text-decoration: underline;
            font-size: 15px;
        }
    
        .nomor {
            text-align: center;
            margin-bottom: 20px;
        }
    
        .isi {
            text-align: justify;
            line-height: 1.7;
        }
    
        .data {
            margin-left: 30px;
        }
    
        .ttd {
            width: 100%;
            margin-top: 40px;
        }
    
        .ttd .kanan {
            float: right;
            text-align: center;
        }
    
        .clear {
            clear: both;
        }
    </style>
</head>
<body>
    @include('generate.partials.kop') 

    <div class="judul">SURAT KETERANGAN TIDAK MAMPU</div>
    <div class="nomor">Nomor: 470/ ____ /2025</div>

    <div class="isi">
        Yang bertanda tangan di bawah ini Kepala Desa Rambipuji Kecamatan Rambipuji Kabupaten JEMBER menerangkan dengan sebenarnya bahwa:
        <br><br>
        <table style="margin-left: 30px;">
            <tr>
                <td style="width: 180px;">Nama lengkap</td>
                <td>: {{ $data->nama_lengkap }}</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>: {{ $data->nik }}</td>
            </tr>
            <tr>
                <td>Tempat & Tgl. Lahir</td>
                <td>: {{ $data->tempat_tanggal_lahir }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>: {{ $data->jenis_kelamin }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: {{ $data->alamat }}</td>
            </tr>
            <tr>
                <td>Status Perkawinan</td>
                <td>:  {{ $data->status_perkawinan }}</td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>: {{ $data->pekerjaan }}</td>
            </tr>
            <tr>
                <td>Kewarganegaraan / Agama</td>
                <td>: {{ $data->warga_agama }}</td>
            </tr>
        </table>
        
        <br>
        Adalah benar-benar warga desa kami dan berdasarkan pertimbangan yang ada, yang bersangkutan benar-benar tergolong keluarga tidak mampu dan surat keterangan ini dipergunakan untuk keperluan yang bersangkutan.
        <br><br>
        Demikian surat keterangan ini dibuat untuk dipergunakan seperlunya.
    </div>

    <div class="ttd">
        <div class="kanan">
            Rambipuji, {{ \Carbon\Carbon::parse($data->updated_at)->translatedFormat('d F Y') }}<br>
            Kepala Desa Rambipuji<br><br><br><br>
            <b><u>Dwi Diyah Setyorini, S.I.Kom</u></b>
        </div>
        <div class="clear"></div>
    </div>
</body>
</html>