<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Surat Keterangan Miskin</title>
  <style>
      body {
            font-family: 'Times New Roman', Times, serif;
            margin: 40px;
        }
    
    .institution {
      text-align: center;
      font-weight: bold;
      font-size: 18px;
      line-height: 1.4;
    }
    .underline {
      text-decoration: underline;
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
    .signature {
      margin-top: 60px;
      font-weight: bold;
      text-align: right;
    }
  </style>
</head>
<body>
  @include('generate.partials.kop')
    
    <div class="title">SURAT KETERANGAN MISKIN</div>
    <div class="number">Nomor: ___ / ___ / 2020</div>

    <div class="content">
      Desa Rambipuji Kecamatan Rambipuji Kabupaten JEMBER dengan ini menerangkan bahwa:
      <table class="table">
        <tr><td>Nama</td><td>: {{ $data->nama_lengkap }}</td></tr>
        <tr><td>Tempat/Tanggal Lahir</td><td>: {{ $data->tempat_tanggal_lahir }}</td></tr>
        <tr><td>Jenis Kelamin</td><td>: {{ $data->jenis_kelamin }}</td></tr>
        <tr><td>Status</td><td>: Siswa</td></tr>
        <tr><td>Kewarganegaraan / Agama</td><td>: {{ $data->warga_agama }}</td></tr>
        <tr><td>Alamat</td><td>: {{ $data->alamat }}</td></tr>
      </table>
      <p style="text-align: justify;">
        Benar yang namanya tersebut diatas adalah Penduduk Desa Rambipuji Kecamatan Rambipuji Kabupaten JEMBER, dan menurut amatan kami benar yang bersangkutan berasal dari keluarga miskin.
        <br><br>
        Demikian Surat Keterangan ini kami perbuat, untuk dapat dipergunakan seperlunya.
      </p>
    </div>

    <div class="ttd">
      Rambipuji, {{ \Carbon\Carbon::parse($data->updated_at)->translatedFormat('d F Y') }}<br>
      Kepala Desa Rambipuji<br><br><br><br>
      <b><u>Dwi Diyah Setyorini, S.I.Kom</u></b>
    </div>
  </div>
</body>
</html> 