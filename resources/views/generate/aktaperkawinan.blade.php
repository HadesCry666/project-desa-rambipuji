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
  @include('generate.partials.kop')

    <div class="clear"></div>

    <div class="title">SURAT PENGANTAR NIKAH</div>
    <div class="number">Nomor: ____ /SPN-DSD/____ /201</div>

    <div class="content">
      Yang bertanda tangan di bawah ini Kepala Desa Rambipuji Kecamatan Rambipuji Kabupaten Jember, menerangkan bahwa:
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

      Adalah anggota masyarakat Desa Rambipuji dengan status <b>Belum Menikah</b>. Surat pengantar ini dipergunakan untuk mengurus Administrasi Pernikahan.
      <br><br>
      Demikian surat pengantar ini dibuat dan diserahkan kepada yang bersangkutan untuk dapat dipergunakan seperlunya.
    </div>

    <div class="footer">
      <div class="ttd">
        Rambipuji,  {{ \Carbon\Carbon::parse($data->updated_at)->translatedFormat('d F Y') }}<br>
        Kepala Desa Rambipuji<br><br><br><br>
        <b><u>Dwi Diyah Setyorini, S.I.Kom</u></b>
      </div>
      <div class="clear"></div>
    </div>
  </div>
</body>
</html>