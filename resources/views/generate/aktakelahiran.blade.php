<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Surat Pengantar Akta Kelahiran</title>
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

    .underline {
      text-decoration: underline;
    }

    .title {
      text-align: center;
      font-weight: bold;
      margin-top: 20px;
    }

    .number {
      text-align: center;
      margin-bottom: 20px;
    }

    .content {
      line-height: 1.8;
    }

    .table {
      margin-top: 15px;
      margin-bottom: 20px;
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
      margin-top: 40px;
    }

    .clear {
      clear: both;
    }

    .signature {
      margin-top: 80px;
      font-weight: bold;
      text-align: right;
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
  <div style="clear: both;"></div>

  <div class="title">SURAT KETERANGAN PENGANTAR AKTA KELAHIRAN</div>
  <div class="number">No. Reg. 145/26/35.07.20.204/IV/2018</div>

  <div class="content" style="text-align: justify;">
    Yang bertanda tangan di bawah ini kami Kepala Desa Wonorejo Kecamatan Kedungjajang Kabupaten Lumajang menerangkan dengan sebenarnya bahwa di Kartu Keluarga:
    <table class="table">
      <tr><td>Nama</td><td>: {{ $data->nama_lengkap }}</td></tr>
      <tr><td>Jenis Kelamin</td><td>: {{ $data->jenis_kelamin }}</td></tr>
      <tr><td>Tempat, Tanggal Lahir</td><td>: {{ $data->tempat_tanggal_lahir }}</td></tr>
      <tr><td>Kewarganegaraan / Agama</td><td>: {{ $data->warga_agama }}</td></tr>
      <tr><td>Pendidikan</td><td>: {{ $data->pendidikan }}</td></tr>
      <tr><td>Pekerjaan</td><td>: {{ $data->pekerjaan }}</td></tr>
      <tr><td>Nomor KK/KTP</td><td>: {{ $data->nik }}</td></tr>
      <tr><td>Alamat</td><td>: {{ $data->alamat }}</td></tr>
    </table>
    <p>Dengan ini menerangkan bahwa yang bersangkutan adalah benar penduduk Desa Wonorejo, Kecamatan Kedungjajang, Kabupaten Lumajang.
    Surat keterangan ini digunakan sebagai pengganti sementara E-KTP yang masih dalam proses.</p>
  </div>
  <div class="ttd">
    Wonorejo, {{ $data->updated_at }}<br>
    Kepala Desa Wonorejo<br><br><br><br>
    <b><u>Bahrul Rozi</u></b>
  </div>
</body>
</html>