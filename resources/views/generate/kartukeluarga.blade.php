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

  
    @include('generate.partials.kop')
        
        <div class="title">SURAT PENGAJUAN PEMBUATAN KARTU KELUARGA</div>
        <div class="number">Nomor: {{ $data->nomor_surat_keluar ?? '___/___/___/___' }}</div>

  <div class="info">
    Yang bertanda tangan di bawah ini:
    <table class="table-info">
      <tr><td>Nama</td><td>: Dwi Diyah Setyorini, S.I.Kom</td></tr>
      <tr><td>Jabatan</td><td>: Kepala Desa Rambipuji</td></tr>
      <tr><td>Alamat</td><td>: Jl. Gajah Mada No. 193</td></tr>
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
      <tr><td>Alamat</td><td>: {{ $data->alamat }}</td></tr>
      <tr><td>Keperluan</td><td>: {{ $data->keperluan }}</td></tr>
      <tr><td>Keterangan lain-lain</td><td>: Keterangan secara lengkap terlampir</td></tr>
    </table>

    <p>Demikian Surat Keterangan ini dibuat untuk digunakan seperlunya.</p>
  </div>

  <div class="ttd">
    Rambipuji,{{ \Carbon\Carbon::parse($data->updated_at)->translatedFormat('d F Y') }}<br>
    Kepala Desa Rambipuji<br><br><br><br>
    <b><u>Dwi Diyah Setyorini, S.I.Kom</u></b>
  </div>
  </div>

</body>
</html>