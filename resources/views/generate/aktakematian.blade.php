<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Surat Pernyataan</title>
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

    .content, .signature-section {
      font-size: 14px;
      line-height: 1.6;
    }

    .table-info td {
      padding: 4px 8px;
      vertical-align: top;
    }

    .gray-box {
      background-color: #f0f0f0;
      padding: 2px 6px;
      display: inline-block;
      border-radius: 3px;
    }

    .signature-section {
      margin-top: 30px;
      display: flex;
      justify-content: space-between;
    }

    .signature-block {
      text-align: center;
      margin-top: 40px;
    }

    .stamp {
      margin-top: 10px;
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
  </style>
</head>
<body>
    @include('generate.partials.kop')

    <div class="title">SURAT PERNTAYAAN AKTA KEMATIAN</div>
    <div class="number">Nomor: ___ / ___ / 2020</div>


<div class="content" style="text-align: justify;">
    Saya yang bertanda tangan di bawah ini:
    <table class="table-info">
        <tr><td>Nama</td><td>: {{ $data->nama_lengkap }}</td></tr>
        <tr><td>Tempat, Tanggal Lahir</td><td>: {{ $data->tempat_tanggal_lahir }}</td></tr>
        <tr><td>NIK</td><td>: {{ $data->nik }}</td></tr>
        <tr><td>Jenis Kelamin</td><td>: {{ $data->jenis_kelamin }}</td></tr>
        <tr><td>Pekerjaan</td><td>: {{ $data->pekerjaan }}</td></tr>
        <tr><td>Alamat</td><td>: {{ $data->alamat }}</td></tr>
    </table>

    <p>Dengan ini menyatakan bahwa saya benar ingin mengurus Surat Keterangan Kematian keluarga saya yang bernama: <span class="gray-box">(alm) {{ $data->keperluan }}.</span></p>

    <p>Surat Pernyataan ini saya buat dengan sesungguhnya tanpa ada unsur paksaan dari pihak manapun. Bilamana surat pernyataan ini tidak benar, maka saya bersedia dituntut sesuai dengan peraturan yang berlaku.</p>

    <p>Demikian surat pernyataan ini saya buat untuk dapat dipergunakan seperlunya.</p>
</div>

    <div class="footer">
      <div class="ttd">
        Rambipuji,  {{ \Carbon\Carbon::parse($data->updated_at)->translatedFormat('d F Y') }}<br>
        Kepala Desa Rambipuji<br><br><br><br>
        <b><u>Dwi Diyah Setyorini, S.I.Kom</u></b>
      </div>
      <div class="clear"></div>
    </div>

</body>
</html>