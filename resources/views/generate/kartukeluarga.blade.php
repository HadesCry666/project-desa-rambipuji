<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Surat Keterangan Pengantar</title>
  <style>
   body {
            font-family: 'Times New Roman', Times, serif;
            margin: 40px;
        }
    
        .header-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            position: relative;
        }
    
        .logo-kiri {
            position: absolute;
            left: 0;
            top: 0;
        }
    
        .logo {
         width: 250px; 
         height: auto;
         margin-top: -40px;
        }

        .header-text {
            text-align: center;
            width: 100%;
        }
    
        .header-text h2, .header-text h3, .header-text p {
            margin: 2px;
        }

        .header-text h2 {
          font-size: 18px;
        }

        .header-text h3 {
        font-size: 16px;
        }

        .title {
      text-align: center;
      margin-top: 20px;
      font-weight: bold;
    }
    .number {
      text-align: center;
      margin-bottom: 30px;
    }
    .info, .content {
      font-size: 14px;
      line-height: 1.6;
    }

    .table-info td {
      padding: 4px 8px;
      vertical-align: top;
    }

    .signature-section {
      margin-top: 30px;
      display: flex;
      justify-content: space-between;
      font-size: 14px;
    }

    .signature {
      text-align: center;
      margin-top: 60px;
    }

    .stamp {
      margin-top: -30px;
    }

    .bold {
      font-weight: bold;
    }

    .footer {
      margin-top: 40px;
    }
    .ttd {
      float: right;
      text-align: center;
    }
    .gray-box {
      background-color: #f0f0f0;
      padding: 2px 6px;
      display: inline-block;
      border-radius: 3px;
    }

  </style>
</head>
<body>

  
    <div class="header-wrapper">
        <div class="logo-kiri">
           <img src="{{ public_path('storage/logo/logo.png') }}" alt="Logo Desa" class="logo">

        </div>
        <div class="header-text">
            <h3>PEMERINTAH KABUPATEN LUMAJANG</h3>
            <h2>KECAMATAN KEDUNGJAJANG</h2>
            <h2>DESA WONOREJO</h2>
            <p> Jl. Raya Lumajang-Jember - Lumajang  67358 </p>
        </div>
    </div>
    <hr>    
        
        <div class="title">SURAT PENGAJUAN PEMBUATAN KARTU KELUARGA</div>
        <div class="number">Nomor: ___ / ___ / 2025</div>

  <div class="info">
    Yang bertanda tangan di bawah ini:
    <table class="table-info">
      <tr><td>Nama</td><td>: Bahrul Rozi</td></tr>
      <tr><td>Jabatan</td><td>: Kepala Desa Wonorejo</td></tr>
      <tr><td>Alamat</td><td>: Jl. Raya Lumajang-Jember</td></tr>
    </table>

    <p>Dengan ini menerangkan bahwa:</p>

    <table class="table-info">
      <tr><td>Nama lengkap</td><td>: {{ $data->nama_lengkap }}</td></tr>
      <tr><td>Jenis kelamin</td><td>:  {{ $data->jenis_kelamin }}</td></tr>
      <tr><td>Kewarganegaraan / Agama</td><td>:  {{ $data->warga_agama }}</td></tr>
      <tr><td>Status</td><td>:   {{ $data->status_perkawinan }}</td></tr>
      <tr><td>No KTP/NIK</td><td>:  {{ $data->nik }}</td></tr>
      <tr><td>Tempat / Tanggal lahir</td><td>:  {{ $data->tempat_tanggal_lahir }}</td></tr>
      <tr><td>Pekerjaan</td><td>: {{ $data->pekerjaan }}</td></tr>
      <tr><td>Alamat</td><td>: {{ $data->alamat }}</ </td></tr>
      <tr><td>Keperluan</td><td>: {{ $data->keperluan }}</</td></tr>
      <tr><td>Keterangan lain-lain</td><td>: Keterangan secara lengkap terlampir</td></tr>
    </table>

    <p>Demikian Surat Keterangan ini dibuat untuk digunakan seperlunya.</p>
  </div>

  <div class="ttd">
    Wonorejo,{{ $data->updated_at }}<br>
    Kepala Desa Wonorejo<br><br><br><br>
    <b><u>Bahrul Rozi</u></b>
  </div>
  </div>

</body>
</html>