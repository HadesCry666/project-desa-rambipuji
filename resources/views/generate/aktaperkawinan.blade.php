<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Surat Pengantar Nikah</title>
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
    
        .judul {
        text-align: center;
        margin-top: 20px;
        margin-bottom: 10px;
        font-weight: bold;
        text-decoration: underline;
        font-size: 15px;
        }
    .title {
      text-align: center;
      font-weight: bold;
      margin-top: 20px;
      text-decoration: underline;
    }
    .number {
      text-align: center;
      margin-bottom: 20px;
    }
    .content {
      line-height: 1.8;
    }
    .table td {
      padding: 4px 8px;
      vertical-align: top;
    }
    .footer {
      margin-top: 40px;
    }
    .ttd {
      float: right;
      text-align: center;
    }
    .signature {
      font-weight: bold;
      margin-top: 80px;
      text-align: right;
    }
    .clear {
      clear: both;
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

    <div class="clear"></div>

    <div class="title">SURAT PENGANTAR NIKAH</div>
    <div class="number">Nomor: ____ /SPN-DSD/____ /201</div>

    <div class="content">
      Yang bertanda tangan di bawah ini Kepala Desa Wonorejo Kecamatan Kedungjajang Kabupaten Lumaajang, menerangkan bahwa:
      <br><br>
      <table class="table">
        <tr><td>Nama</td><td>: {{ $data->nama_lengkap }}</td></tr>
        <tr><td>Tempat/Tanggal Lahir</td><td>:  {{ $data->tempat_tanggal_lahir }}</td></tr>
        <tr><td>Pekerjaan</td><td>: {{ $data->pekerjaan }}</td></tr>
        <tr><td>Kewarganegaraan / Agama</td><td>: {{ $data->warga_agama }}</td></tr>
        <tr><td>No. KTP</td><td>: {{ $data->nik }}</td></tr>
        <tr><td>Alamat</td><td>: {{ $data->alamat }}</td></tr>
        <tr><td>Nama Orang Tua</td><td>: {{ $data->keperluan }}</td></tr>
      </table>

      Adalah anggota masyarakat Desa Wonorejo dengan status <b>Belum Menikah</b>. Surat pengantar ini dipergunakan untuk mengurus Administrasi Pernikahan.
      <br><br>
      Demikian surat pengantar ini dibuat dan diserahkan kepada yang bersangkutan untuk dapat dipergunakan seperlunya.
    </div>

    <div class="footer">
      <div class="ttd">
        Wonorejo,  {{ $data->updated_at }}<br>
        Kepala Desa Wonorejo<br><br><br><br>
        <b><u>Bahrul Rozi</u></b>
      </div>
      <div class="clear"></div>
    </div>
  </div>
</body>
</html>