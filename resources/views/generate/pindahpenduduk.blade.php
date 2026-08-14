<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Surat Keterangan Pindah Penduduk</title>
  <style>
     body {
            font-family: 'Times New Roman', Times, serif;
            margin: 40px;
        }
    
    .clearfix::after {
      content: "";
      display: table;
      clear: both;
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
    .field-table {
      margin-top: 20px;
      margin-bottom: 20px;
    }
    .field-table td {
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
    .note {
      font-size: 14px;
    }
  </style>
</head>
<body>
  @include('generate.partials.kop')

<div class="title">SURAT PENGANTAR PINDAH PENDUDUK</div>
<div class="number">Nomor: ____ /SPN-DSD/____ /201</div>
      </div>
    </div>

    <p>Memberi Keterangan Bahwa :</p>
    <table class="field-table">
      <tr><td>Nama</td><td>: {{ $data->nama_lengkap }}</td></tr>
      <tr><td>Tempat / Tanggal Lahir</td><td>: {{ $data->tempat_tanggal_lahir }}</td></tr>
      <tr><td>Jenis Kelamin</td><td>: {{ $data->jenis_kelamin }}</td></tr>
      <tr><td>Alamat</td><td>: {{ $data->alamat }}</td></tr>
      <tr><td>Pekerjaan</td><td>: {{ $data->pekerjaan }}</td></tr>
    </table>

    <p style="text-align: justify;">
  Adalah benar yang bersangkutan merupakan penduduk Desa Rambipuji, Kecamatan Rambipuji, Kabupaten Jember.
  Berdasarkan permintaan sendiri, kepada yang bersangkutan diberikan Surat Keterangan Pindah Penduduk
  ke alamat/desa tujuan sebagaimana keterangan berikut: {{ $data->keperluan }}.
  <br><br>
  Demikian Surat Keterangan Pindah ini dibuat dan diberikan kepada yang bersangkutan untuk dipergunakan sebagaimana mestinya.
</p>

    <div class="footer">
      <div class="ttd">
       Rambipuji, {{ \Carbon\Carbon::parse($data->updated_at)->translatedFormat('d F Y') }}<br>
       Kepala Desa Rambipuji<br><br><br><br>
        <b><u>Dwi Diyah Setyorini, S.I.Kom</u></b>
      </div>
  </div>
</body>
</html>