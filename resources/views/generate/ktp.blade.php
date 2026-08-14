<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Surat Pengantar</title>
  <style>
    body {
            font-family: 'Times New Roman', Times, serif;
            margin: 40px;
        }
    
    .clear {
      clear: both;
    }
    .kode-pos {
      text-align: center;
      font-size: 12px;
      margin: 5px 0 20px 0;
      font-weight: bold;
    }
    .title {
      text-align: center;
      font-weight: bold;
      font-size: 18px;
      text-decoration: underline;
      margin: 20px 0 10px;
    }
    .nomor {
      text-align: center;
      margin-bottom: 20px;
    }
    .content {
      line-height: 1.8;
      font-size: 14px;
    }
    .table td {
      padding: 3px 10px 3px 0;
      vertical-align: top;
    }
    .footer {
      margin-top: 40px;
    }
    .ttd {
      float: right;
      text-align: center;
      font-size: 14px;
    }
    .signature {
      font-weight: bold;
      text-align: center;
      margin-top: 60px;
    }
    .double-signature {
      display: flex;
      justify-content: space-between;
      margin-top: 80px;
    }
    .sign-box {
      text-align: center;
      width: 45%;
    }
    .sign-name {
      margin-top: 60px;
      font-weight: bold;
      text-decoration: underline;
    }
  </style>
</head>
<body>
  @include('generate.partials.kop')
    <div class="title">SURAT PENGANTAR PEMBUATAN KTP  </div>
    <div class="nomor">Nomor: 002/SP/RTR 001.008/VI/2022</div>

    <div class="content">
      Yang bertanda tangan di bawah ini menerangkan bahwa:
      <br><br>
      <table class="table">
        <tr><td>Nama</td><td>: {{ $data->nama_lengkap }}</</td></tr>
        <tr><td>Tempat / Tanggal Lahir</td><td>: {{ $data->tempat_tanggal_lahir }}</td></tr>
        <tr><td>Jenis Kelamin</td><td>: {{ $data->jenis_kelamin }}</td></tr>
        <tr><td>No KTP / KK / Nopen</td><td>: {{ $data->nik }}</td></tr>
        <tr><td>Kewarganegaraan / Agama</td><td>: {{ $data->warga_agama }}</td></tr>
        <tr><td>Pekerjaan</td><td>: {{ $data->pekerjaan }}</td></tr>
        <tr><td>Status Perkawinan</td><td>: BELUM KAWIN</td></tr>
        <tr><td>Alamat</td><td>: {{ $data->alamat }}</td></tr>
      </table>
      <p style="text-align: justify;">
        Nama tersebut di atas saat ini bertempat tinggal di lingkungan kami RT {{ $data->rt }}RW {{ $data->rw }}. Selanjutnya surat pengantar/keterangan ini diberikan kepada yang bersangkutan untuk keperluan: <strong>{{ $data->keperluan }}</strong>.
        <br><br>
        Demikian surat pengantar ini kami buat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.
      </p>
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