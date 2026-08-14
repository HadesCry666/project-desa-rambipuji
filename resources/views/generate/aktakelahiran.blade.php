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
  @include('generate.partials.kop')
  <div style="clear: both;"></div>

  <div class="title">SURAT KETERANGAN PENGANTAR AKTA KELAHIRAN</div>
  <div class="number">No. Reg. 145/26/35.07.20.204/IV/2018</div>

  <div class="content" style="text-align: justify;">
    Yang bertanda tangan di bawah ini kami Kepala Desa Rambipuji Kecamatan Rambipuji Kabupaten Jember menerangkan dengan sebenarnya bahwa di Kartu Keluarga:
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
    <p>Dengan ini menerangkan bahwa yang bersangkutan adalah benar penduduk Desa Rambipuji, Kecamatan Rambipuji, Kabupaten Jember.
    Surat keterangan ini digunakan sebagai pengganti sementara E-KTP yang masih dalam proses.</p>
  </div>
  <div class="ttd">
    Rambipuji, {{ \Carbon\Carbon::parse($data->updated_at)->translatedFormat('d F Y') }}<br>
    Kepala Desa Rambipuji<br><br><br><br>
    <b><u>Dwi Diyah Setyorini, S.I.Kom</u></b>
  </div>
</body>
</html>