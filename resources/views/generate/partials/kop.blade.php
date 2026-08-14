{{-- KOP SURAT (struktur tabel 2 kolom, kompatibel dengan DomPDF) --}}
<style>
    .kop {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
        padding: 0;
    }

    .kop-logo {
        width: 100px;
        text-align: left;
        vertical-align: middle;
        padding: 0;
    }

    .kop-logo img {
        width: 100px;
        height: auto;
        display: block;
    }

    .kop-text {
        vertical-align: middle;
        text-align: center;
    }

    .kop-text h2,
    .kop-text h3,
    .kop-text p {
        margin: 2px;
    }

    .kop-text h2 {
        font-size: 18px;
    }

    .kop-text h3 {
        font-size: 16px;
    }

    .kop-text p {
        font-size: 13px;
    }

    .kop-line {
        border: 0;
        border-top: 2px solid #000;
        margin: 0;
        padding: 0;
    }
</style>

<table class="kop">
    <tr>
        <td class="kop-logo">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('image/logo/logo.png'))) }}" alt="Logo Desa">
        </td>
        <td class="kop-text">
            <h3>PEMERINTAH KABUPATEN JEMBER</h3>
            <h2>KECAMATAN RAMBIPUJI</h2>
            <h2>DESA RAMBIPUJI</h2>
            <p>Alamat: Jl. Gajah Mada No. 193, Kode Pos 68152</p>
            <p>E-mail: drambipuji@gmail.com</p>
        </td>
    </tr>
</table>
<hr class="kop-line">
