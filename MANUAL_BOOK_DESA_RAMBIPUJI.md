# MANUAL BOOK WEBSITE DIGITAL VILLAGE DESA RAMBIPUJI
## Sistem Pelayanan Administrasi Desa Berbasis Digital

---

### **COVER MANUAL BOOK**

```
================================================================================

                         MANUAL BOOK WEBSITE DIGITAL VILLAGE
                                  DESA RAMBIPUJI

                   Sistem Pelayanan Administrasi Desa Berbasis Digital
                      Kecamatan Rambipuji - Kabupaten Jember

================================================================================
```

[Gambar Halaman: Logo Resmi Desa Rambipuji]

* **Judul Dokumen**: MANUAL BOOK WEBSITE DIGITAL VILLAGE DESA RAMBIPUJI
* **Subjudul**: Sistem Pelayanan Administrasi Desa Berbasis Digital
* **Instansi**: Pemerintah Desa Rambipuji, Kecamatan Rambipuji, Kabupaten Jember
* **Pengembang**: Tim Pengembang Sistem Informasi Desa Rambipuji
* **Tahun Terbit**: 2026
* **Versi Dokumen**: 2.0 (Edisi Alur Persetujuan Multi-Role & TTE)

---

## KATA PENGANTAR

Puji syukur kehadirat Allah SWT, Tuhan Yang Maha Esa, karena atas rahmat dan karunia-Nya, penyusunan **Manual Book Website Digital Village Desa Rambipuji** ini dapat diselesaikan dengan baik. 

Buku panduan ini disusun sebagai acuan resmi dalam pengoperasian dan pengelolaan Sistem Pelayanan Administrasi Desa Berbasis Digital di Desa Rambipuji, Kecamatan Rambipuji, Kabupaten Jember. Transformasi digital ini bertujuan untuk mempercepat proses birokrasi, meningkatkan transparansi publik, mempermudah pelayanan surat-menyurat bagi masyarakat, serta mendukung tata kelola pemerintahan desa yang modern, akuntabel, dan efisien.

Buku manual ini dirancang secara sistematis dengan menyajikan penjelasan fungsi, alur kerja, hingga panduan langkah demi langkah (*step-by-step*) yang dapat dipelajari dengan mudah oleh seluruh tingkatan pengguna, mulai dari masyarakat umum, Kepala Dusun (Kadus), Staff Admin Desa, Sekretaris Desa (Sekdes), hingga Kepala Desa (Kades).

Kami mengucapkan terima kasih dan apresiasi yang setinggi-tingginya kepada seluruh tim pengembang, jajaran Pemerintah Desa Rambipuji, serta pihak-pihak yang telah berkontribusi dalam pembangunan dan implementasi sistem ini. Semoga buku panduan ini memberikan manfaat yang optimal dalam mewujudkan Desa Rambipuji sebagai Desa Digital yang mandiri dan berkemajuan.


Rambipuji,   2026

**Tim Pengembang & Tim Admin Digital Village Desa Rambipuji**

---

## DAFTAR ISI

* [COVER MANUAL BOOK](#cover-manual-book)
* [KATA PENGANTAR](#kata-pengantar)
* [DAFTAR ISI](#daftar-isi)
* [BAB I PENDAHULUAN](#bab-i-pendahuluan)
  * [1.1 Latar Belakang](#11-latar-belakang)
  * [1.2 Tujuan Penggunaan Website](#12-tujuan-penggunaan-website)
  * [1.3 Manfaat Website Bagi Masyarakat dan Perangkat Desa](#13-manfaat-website-bagi-masyarakat-dan-perangkat-desa)
* [BAB II LANDING PAGE WEBSITE](#bab-ii-landing-page-website)
  * [2.1 Cara Membuka Website](#21-cara-membuka-website)
  * [2.2 Tampilan Beranda Utama](#22-tampilan-beranda-utama)
  * [2.3 Navigation Bar dan Menu Beranda](#23-navigation-bar-dan-menu-beranda)
  * [2.4 Menu Layanan](#24-menu-layanan)
  * [2.5 Menu Tentang Kami](#25-menu-tentang-kami)
  * [2.6 Tombol Login dan Komponen Navigasi](#26-tombol-login-dan-komponen-navigasi)
* [BAB III LOGIN SISTEM](#bab-iii-login-sistem)
  * [3.1 Akses Halaman Login](#31-akses-halaman-login)
  * [3.2 Pengisian Username / NIK](#32-pengisian-username--nik)
  * [3.3 Pengisian Password](#33-pengisian-password)
  * [3.4 Penekanan Tombol Masuk](#34-penekanan-tombol-masuk)
  * [3.5 Handling Notifikasi Login Gagal](#35-handling-notifikasi-login-gagal)
  * [3.6 Handling Notifikasi Login Berhasil](#36-handling-notifikasi-login-berhasil)
* [BAB IV DASHBOARD ADMIN DESA](#bab-iv-dashboard-admin-desa)
  * [4.1 Kartu Statistik Utama Dashboard](#41-kartu-statistik-utama-dashboard)
  * [4.2 Indikator Surat Masuk, Verifikasi, Selesai, dan Pengaduan](#42-indikator-surat-masuk-verifikasi-selesai-dan-pengaduan)
  * [4.3 Struktur Menu Sidebar Admin](#43-struktur-menu-sidebar-admin)
* [BAB V MASTER DATA PENDUDUK](#bab-v-master-data-penduduk)
  * [5.1 Navigasi dan Tampilan Tabel Penduduk](#51-navigasi-dan-tampilan-tabel-penduduk)
  * [5.2 Menambah Data Penduduk Baru](#52-menambah-data-penduduk-baru)
  * [5.3 Mengubah Data Penduduk](#53-mengubah-data-penduduk)
  * [5.4 Menghapus Data Penduduk](#54-menghapus-data-penduduk)
  * [5.5 Fitur Pencarian dan Filtering Penduduk](#55-fitur-pencarian-dan-filtering-penduduk)
* [BAB VI MASTER KARTU KELUARGA (KK)](#bab-vi-master-kartu-keluarga-kk)
  * [6.1 Tampilan Master Kartu Keluarga](#61-tampilan-master-kartu-keluarga)
  * [6.2 Menambah Kartu Keluarga Baru](#62-menambah-kartu-keluarga-baru)
  * [6.3 Mengubah Data Kartu Keluarga](#63-mengubah-data-kartu-keluarga)
  * [6.4 Menghapus Data Kartu Keluarga](#64-menghapus-data-kartu-keluarga)
  * [6.5 Pengelolaan Relasi Anggota Keluarga](#65-pengelolaan-relasi-anggota-keluarga)
* [BAB VII MASTER JENIS SURAT](#bab-vii-master-jenis-surat)
  * [7.1 Katalog Jenis Surat Pelayanan](#71-katalog-jenis-surat-pelayanan)
  * [7.2 Menambah Jenis Surat Baru](#72-menambah-jenis-surat-baru)
  * [7.3 Mengubah Jenis Surat dan Template](#73-mengubah-jenis-surat-dan-template)
  * [7.4 Menghapus Jenis Surat](#74-menghapus-jenis-surat)
  * [7.5 Mengatur Syarat & Berkas Persyaratan Surat](#75-mengatur-syarat--berkas-persyaratan-surat)
* [BAB VIII PENGELOLAAN PENGAJUAN SURAT (ALUR DESA RAMBIPUJI)](#bab-viii-pengelolaan-pengajuan-surat-alur-desa-rambipuji)
  * [8.1 Grand Flowchart Persetujuan Berjenjang](#81-grand-flowchart-persetujuan-berjenjang)
  * [8.2 Rincian Status Pengajuan Surat](#82-rincian-status-pengajuan-surat)
* [BAB IX DASHBOARD KEPALA DUSUN (KADUS)](#bab-ix-dashboard-kepala-dusun-kadus)
  * [9.1 Ringkasan Dashboard Kadus](#91-ringkasan-dashboard-kadus)
  * [9.2 Statistik Surat Masuk, Diproses, Selesai, dan Ditolak](#92-statistik-surat-masuk-diproses-selesai-dan-ditolak)
* [BAB X PENGAJUAN SURAT OLEH KEPALA DUSUN](#bab-x-pengajuan-surat-oleh-kepala-dusun)
  * [10.1 Memilih NIK Warga Pemohon](#101-memilih-nik-warga-pemohon)
  * [10.2 Memilih Anggota Keluarga Terkait](#102-memilih-anggota-keluarga-terkait)
  * [10.3 Pengisian Formulir Surat](#103-pengisian-formulir-surat)
  * [10.4 Mengunggah Berkas Persyaratan](#104-mengunggah-berkas-persyaratan)
  * [10.5 Mengirim Pengajuan Atas Nama Warga](#105-mengirim-pengajuan-atas-nama-warga)
* [BAB XI PERSETUJUAN SURAT OLEH KEPALA DUSUN](#bab-xi-persetujuan-surat-oleh-kepala-dusun)
  * [11.1 Memeriksa Daftar Pengajuan Masuk Warga](#111-memeriksa-daftar-pengajuan-masuk-warga)
  * [11.2 Prosedur Menyetujui Pengajuan Surat](#112-prosedur-menyetujui-pengajuan-surat)
  * [11.3 Prosedur Menolak Pengajuan Surat](#113-prosedur-menolak-pengajuan-surat)
  * [11.4 Pengisian Alasan Penolakan Kadus](#114-pengisian-alasan-penolakan-kadus)
* [BAB XII DASHBOARD SEKRETARIS DESA (SEKDES)](#bab-xii-dashboard-sekretaris-desa-sekdes)
  * [12.1 Ringkasan Dashboard Sekdes](#121-ringkasan-dashboard-sekdes)
  * [12.2 Statistik Menunggu Persetujuan, Selesai, dan Ditolak](#122-statistik-menunggu-persetujuan-selesai-dan-ditolak)
* [BAB XIII PERSETUJUAN SURAT OLEH SEKRETARIS DESA](#bab-xiii-persetujuan-surat-oleh-sekretaris-desa)
  * [13.1 Memeriksa Surat Hasil Verifikasi Admin Desa](#131-memeriksa-surat-hasil-verifikasi-admin-desa)
  * [13.2 Meninjau Catatan Keterangan Admin](#132-meninjau-catatan-keterangan-admin)
  * [13.3 Prosedur Menyetujui Surat oleh Sekdes](#133-prosedur-menyetujui-surat-oleh-sekdes)
  * [13.4 Prosedur Menolak Surat dan Catatan Penolakan](#134-prosedur-menolak-surat-dan-catatan-penolakan)
* [BAB XIV DASHBOARD KEPALA DESA (KADES)](#bab-xiv-dashboard-kepala-desa-kades)
  * [14.1 Ringkasan Dashboard Kepala Desa](#141-ringkasan-dashboard-kepala-desa)
  * [14.2 Indikator Surat Menunggu TTE, Selesai, dan Ditolak](#142-indikator-surat-menunggu-tte-selesai-dan-ditolak)
* [BAB XV PERSETUJUAN SURAT DAN TANDA TANGAN ELEKTRONIK (TTE) KEPALA DESA](#bab-xv-persetujuan-surat-dan-tanda-tangan-elektronik-tte-kepala-desa)
  * [15.1 Memeriksa Pengajuan Disetujui Sekdes](#151-memeriksa-pengajuan-disetujui-sekdes)
  * [15.2 Prosedur Menyetujui Surat (Pengesahan TTE)](#152-prosedur-menyetujui-surat-pengesahan-tte)
  * [15.3 Prosedur Menolak Pengajuan oleh Kades](#153-prosedur-menolak-pengajuan-oleh-kades)
  * [15.4 Pembuatan PDF Otomatis dan Penyematan QR TTE](#154-pembuatan-pdf-otomatis-dan-penyematan-qr-tte)
  * [15.5 Penerbitan dan Pengunduhan Dokumen oleh Warga](#155-penerbitan-dan-pengunduhan-dokumen-oleh-warga)
* [BAB XVI PENGELOLAAN PENGADUAN MASYARAKAT](#bab-xvi-pengelolaan-pengaduan-masyarakat)
  * [16.1 Mengakses Daftar Pengaduan Masuk](#161-mengakses-daftar-pengaduan-masuk)
  * [16.2 Membaca Detail Pengaduan dan Bukti Lampiran](#162-membaca-detail-pengaduan-dan-bukti-lampiran)
  * [16.3 Memberikan Tanggapan / Feedback Admin](#163-memberikan-tanggapan--feedback-admin)
  * [16.4 Monitoring Status Penyelesaian Pengaduan](#164-monitoring-status-penyelesaian-pengaduan)
* [BAB XVII MANAJEMEN LANDING PAGE](#bab-xvii-manajemen-landing-page)
  * [17.1 Mengubah Banner Utama Landing Page](#171-mengubah-banner-utama-landing-page)
  * [17.2 Mengubah Informasi Profil Desa](#172-mengubah-informasi-profil-desa)
  * [17.3 Mengubah Visi dan Misi Desa](#173-mengubah-visi-dan-misi-desa)
  * [17.4 Mengubah Sejarah Desa](#174-mengubah-sejarah-desa)
  * [17.5 Mengubah Kontak dan Alamat Desa](#175-mengubah-kontak-dan-alamat-desa)
  * [17.6 Mengubah Galeri Foto Landing Page](#176-mengubah-galeri-foto-landing-page)
* [BAB XVIII MANAJEMEN BERITA DESA](#bab-xviii-manajemen-berita-desa)
  * [18.1 Menambah Berita Desa Baru](#181-menambah-berita-desa-baru)
  * [18.2 Mengubah / Mengedit Berita Desa](#182-mengubah--mengedit-berita-desa)
  * [18.3 Menghapus Berita Desa](#183-menghapus-berita-desa)
  * [18.4 Mempublikasikan Berita ke Portal Utama](#184-mempublikasikan-berita-ke-portal-utama)
* [BAB XIX LOGOUT SISTEM](#bab-xix-logout-sistem)
  * [19.1 Prosedur Logout dari Aplikasi Web](#191-prosedur-logout-dari-aplikasi-web)
* [BAB XX PENUTUP](#bab-xx-penutup)
  * [20.1 Kesimpulan dan Harapan](#201-kesimpulan-dan-harapan)

---

## BAB I PENDAHULUAN

### 1.1 Latar Belakang
Desa Rambipuji yang terletak di Kecamatan Rambipuji, Kabupaten Jember, terus melakukan percepatan pelayanan publik demi memberikan kenyamanan dan efisiensi terbaik bagi seluruh elemen masyarakat. Sebelum diterapkannya sistem digital, pelayanan administrasi persuratan dan pengelolaan data kependudukan masih dilakukan secara konvensional. Hal tersebut kerap menimbulkan kendala seperti antrean fisik yang panjang di kantor desa, risiko kehilangan berkas fisik, serta lamanya durasi persetujuan surat karena proses verifikasi berjenjang yang memerlukan kehadiran fisik dari perangkat desa.

Melalui pengembangan **Website Digital Village Desa Rambipuji**, Pemerintah Desa Rambipuji menghadirkan solusi berbasis teknologi informasi modern. Sistem ini mengintegrasikan seluruh lini pelayanan administrasi desa secara *online*, terautomasi, dan real-time. Dengan dukungan alur verifikasi multi-role (mulai dari Kepala Dusun, Admin Desa, Sekretaris Desa, hingga pengesahan Tanda Tangan Elektronik oleh Kepala Desa), sistem ini menjamin keamanan, keabsahan hukum, dan akurasi pelayanan persuratan bagi seluruh warga Desa Rambipuji.

[Gambar Halaman: Beranda Utama Digital Village Desa Rambipuji]

---

### 1.2 Tujuan Penggunaan Website
Tujuan utama penyediaan Website Digital Village Desa Rambipuji adalah:
1. **Digitalisasi Pelayanan Surat**: Mengubah proses permohonan surat administrasi dari manual menjadi sistem digital yang fleksibel dan dapat diakses dari mana saja.
2. **Efisiensi Rantai Persetujuan**: Memangkas waktu pemrosesan persuratan dengan alur verifikasi digital berjenjang yang transparan dan dapat dipantau statusnya secara real-time.
3. **Integritas Data Kependudukan**: Menyediakan pusat data kependudukan dan Kartu Keluarga (KK) yang terintegrasi, terkini, dan mudah dikelola oleh perangkat desa.
4. **Pemberdayaan Transparansi Publik**: Menyediakan media informasi resmi desa yang memuat berita, pengumuman, visi-misi, sejarah, serta fasilitas penampung aspirasi/pengaduan masyarakat.

---

### 1.3 Manfaat Website Bagi Masyarakat dan Perangkat Desa

#### A. Bagi Masyarakat (Warga Desa Rambipuji)
* **Kemudahan Akses**: Warga dapat mengajukan permohonan surat kapan saja tanpa harus mengantre lama di kantor desa.
* **Transparansi Status**: Warga dapat memantau secara langsung status pengajuan surat (apakah sedang berada di tahap Kepala Dusun, Admin, Sekdes, atau Kades).
* **Unduh Dokumen Mandiri**: Surat yang telah disahkan dengan Tanda Tangan Elektronik (TTE) dapat langsung diunduh dalam format PDF resmi bermutu tinggi.
* **Saluran Pengaduan Mudah**: Memudahkan warga dalam menyampaikan masukan, aspirasi, atau pengaduan secara terstruktur.

#### B. Bagi Perangkat Desa (Kadus, Admin, Sekdes, Kades)
* **Manajemen Berkas Efisien**: Pengelolaan data penduduk, KK, dan pengajuan surat tersimpan secara rapi dalam basis data digital terpusat.
* **Kemudahan Verifikasi**: Setiap pejabat/perangkat desa dapat melakukan pengulasan dokumen, pemberian catatan admin, serta persetujuan cukup melalui dasbor sistem.
* **Pengesahan TTE Praktis**: Kepala Desa dapat mengesahkan dokumen resmi menggunakan Tanda Tangan Elektronik secara legal dan praktis tanpa terhalang kendala geografis.
* **Pengambilan Keputusan Berbasis Data**: Grafik dan statistik dasbor membantu pimpinan desa dalam memantau tren pelayanan kependudukan dan responsivitas pengaduan.

---

## BAB II LANDING PAGE WEBSITE

### 2.1 Cara Membuka Website
Untuk mengakses portal publik Digital Village Desa Rambipuji, pengguna dapat mengikuti langkah-langkah berikut:
1. Buka aplikasi peramban web (*web browser*) pada perangkat komputer, laptop, ataupun ponsel pintar (seperti Google Chrome, Mozilla Firefox, Microsoft Edge, atau Safari).
2. Ketikkan alamat URL resmi sistem pada *address bar* peramban: `http://desa-rambipuji.test` atau domain resmi yang ditunjuk oleh Pemerintah Desa Rambipuji.
3. Tekan **Enter** pada papan ketik.
4. Halaman beranda utama (*Landing Page*) akan dimuat secara penuh.

[Gambar Halaman: Pengaksesan URL dan Loading Tampilan Landing Page]

---

### 2.2 Tampilan Beranda Utama
Halaman Beranda Utama dirancang dengan estetika modern, responsif, dan ramah pengguna. Tampilan ini menyajikan sambutan visual (*Hero Banner*), ringkasan profil desa, statistik pelayanan, berita terkini, serta tautan cepat menuju layanan administrasi.

[Gambar Halaman: Tampilan Beranda Utama Landing Page]

---

### 2.3 Navigation Bar dan Menu Beranda
Pada bagian atas halaman (*Header/Navigation Bar*), terdapat logo resmi Desa Rambipuji beserta menu navigasi utama:
* **Menu Beranda**: Mengarahkan pengguna kembali ke tampilan paling atas halaman utama.
* **Fungsi**: Memudahkan pengguna untuk kembali ke tampilan awal dari bagian mana pun di landing page.

[Gambar Halaman: Navigation Bar Halaman Utama]

---

### 2.4 Menu Layanan
Menu **Layanan** berisi informasi seputar jenis-jenis surat administrasi yang disediakan oleh Pemerintah Desa Rambipuji (seperti Surat Keterangan Tidak Mampu, Surat Keterangan Usaha, Surat Keterangan Domisili, dll.).
* **Fungsi**: Memberikan informasi transparan mengenai persyaratan berkas yang harus disiapkan oleh warga sebelum mengajukan surat.

[Gambar Halaman: Bagian Menu Layanan Desa]

---

### 2.5 Menu Tentang Kami
Menu **Tentang Kami** menyajikan profil lengkap Desa Rambipuji meliputi:
* Sejarah singkat pembentukan Desa Rambipuji.
* Visi dan Misi Pemerintah Desa Rambipuji.
* Struktur organisasi dan peta wilayah desa.
* **Fungsi**: Memberikan edukasi dan transparansi profil desa kepada masyarakat luas.

[Gambar Halaman: Bagian Menu Tentang Kami]

---

### 2.6 Tombol Login dan Komponen Navigasi
Pada pojok kanan atas *Navigation Bar*, terdapat tombol menonjol bertuliskan **LOGIN**.
* **Fungsi Tombol Login**: Mengarahkan Perangkat Desa (Admin, Kepala Dusun, Sekretaris Desa, Kepala Desa) serta pengguna terdaftar menuju halaman autentikasi masuk ke dalam Dasbor Manajemen Sistem.

[Gambar Halaman: Tombol Login pada Navigation Bar]

---

## BAB III LOGIN SISTEM

### 3.1 Akses Halaman Login
Untuk masuk ke dasbor pengelolaan, perangkat desa harus mengakses halaman autentikasi terlebih dahulu.
1. Klik tombol **Login** pada pojok kanan atas Landing Page, atau ketikkan URL `/login` pada peramban web.
2. Sistem akan menampilkan formulir autentikasi Login yang aman.

[Gambar Halaman: Formulir Antarmuka Login Sistem]

---

### 3.2 Pengisian Username / NIK
1. Arahkan kursor pada kolom input **Username / NIK**.
2. Masukkan NIK (Nomor Induk Kependudukan) atau Username terdaftar sesuai dengan kredensial yang dimiliki oleh Perangkat Desa/Admin.

[Gambar Halaman: Pengisian Kolom Username/NIK]

---

### 3.3 Pengisian Password
1. Arahkan kursor pada kolom input **Password**.
2. Ketikkan kata sandi rahasia akun Anda. Pastikan memperhatikan huruf kapital dan karakter khusus karena kolom berkonsep *case-sensitive*.

[Gambar Halaman: Pengisian Kolom Password]

---

### 3.4 Penekanan Tombol Masuk
1. Setelah memastikan Username/NIK dan Password terisi dengan benar, tekan tombol **MASUK** / **LOGIN**.
2. Sistem akan memproses validasi hak akses dan kecocokan kredensial pada basis data.

[Gambar Halaman: Penekanan Tombol Masuk/Login]

---

### 3.5 Handling Notifikasi Login Gagal
Jika kredensial yang dimasukkan tidak cocok atau akun tidak aktif:
* Sistem akan tetap berada di halaman Login.
* Tampil notifikasi pesan peringatan berwarna merah (*Alert Danger*): **"Username/NIK atau Password yang Anda masukkan salah!"**
* **Langkah Solusi**: Periksa kembali ketikan NIK/Password Anda atau hubungi Admin Utama Desa untuk pemulihan kata sandi.

[Gambar Halaman: Notifikasi Peringatan Login Gagal]

---

### 3.6 Handling Notifikasi Login Berhasil
Jika kredensial valid:
* Tampil notifikasi pesan sukses (*Alert Success*): **"Selamat Datang di Sistem Digital Village Desa Rambipuji!"**
* Sistem secara otomatis mengarahkan (*redirect*) pengguna ke Dasbor sesuai dengan *Role* (Peran) masing-masing (Admin, Kadus, Sekdes, atau Kades).

[Gambar Halaman: Notifikasi Login Berhasil dan Process Redirect]

---

## BAB IV DASHBOARD ADMIN DESA

### 4.1 Kartu Statistik Utama Dashboard
Setelah Login sebagai Admin Desa (Role 1), pengguna akan disambut oleh Dasbor Admin yang menyajikan visualisasi data dan ringkasan statistik kinerja pelayanan desa secara *real-time*.

[Gambar Halaman: Dashboard Utama Admin Desa]

---

### 4.2 Indikator Surat Masuk, Verifikasi, Selesai, dan Pengaduan
Pada bagian atas Dasbor Admin, terdapat 4 Kartu Statistik utama:
1. **Kartu Total Surat Masuk**: Menampilkan akumulasi seluruh permohonan surat yang masuk ke sistem.
2. **Kartu Menunggu Verifikasi**: Menampilkan jumlah surat yang saat ini membutuhkan tindakan pengulasan dan verifikasi oleh Admin Desa.
3. **Kartu Surat Selesai**: Menampilkan total surat yang telah berhasil disahkan hingga tahap TTE Kades.
4. **Kartu Pengaduan Masyarakat**: Menampilkan total laporan aspirasi/pengaduan yang masuk dari warga.

[Gambar Halaman: Kartu Indikator Statistik Dashboard Admin]

---

### 4.3 Struktur Menu Sidebar Admin
Sidebar di sebelah kiri layar menyediakan navigasi ke seluruh modul pengelolaan sistem:
* **Dashboard**: Halaman utama indikator statistik.
* **Master Penduduk**: Pengelolaan database warga Desa Rambipuji.
* **Master Kartu Keluarga**: Pengelolaan data KK dan struktur keluarga.
* **Master Jenis Surat**: Pengaturan katalog dan formulir surat.
* **Pengajuan Surat (Surat Masuk, Surat Selesai, Surat Ditolak)**: Pemrosesan permohonan surat warga.
* **Tambah Pengajuan**: Fasilitas membuat pengajuan surat atas nama warga.
* **Pengaduan Masyarakat**: Pengelolaan laporan pengaduan warga.
* **Manajemen Landingpage**: Pengaturan konten portal publik.
* **Logout**: Keluar dari sistem.

[Gambar Halaman: Struktur Menu Sidebar Admin Desa]

---

## BAB V MASTER DATA PENDUDUK

### 5.1 Navigasi dan Tampilan Tabel Penduduk
Akses menu **Master Data -> Data Penduduk** pada sidebar. Halaman ini menampilkan tabel seluruh warga terdaftar yang dilengkapi informasi NIK, Nama Lengkap, Jenis Kelamin, Tanggal Lahir, Dusun, RT/RW, dan Status Kependudukan.

[Gambar Halaman: Tabel Master Data Penduduk]

---

### 5.2 Menambah Data Penduduk Baru
Langkah-langkah menambah data warga baru:
1. Klik tombol **+ Tambah Penduduk** di bagian atas tabel.
2. Tampil modal formulir input data penduduk.
3. Isi data wajib: NIK (16 digit), Nama Lengkap, No. KK, Tempat/Tgl Lahir, Jenis Kelamin, Agama, Pekerjaan, Alamat, Dusun, RT, dan RW.
4. Klik tombol **Simpan Data**.
5. Data baru otomatis tersimpan dan memperbarui database kependudukan.

[Gambar Halaman: Formulir Tambah Data Penduduk Baru]

---

### 5.3 Mengubah Data Penduduk
1. Cari nama/NIK penduduk yang ingin diubah pada tabel.
2. Klik tombol **Edit** (ikon pensil kuning/biru) pada kolom Aksi.
3. Ubah data pada formulir sesuai kebutuhan.
4. Klik tombol **Perbarui / Update**.

[Gambar Halaman: Formulir Edit Data Penduduk]

---

### 5.4 Menghapus Data Penduduk
1. Klik tombol **Hapus** (ikon tempat sampah merah) pada baris data penduduk yang sesuai.
2. Konfirmasi konfirmasi dialog: **"Apakah Anda yakin ingin menghapus data penduduk ini?"**
3. Klik **Ya, Hapus**. Data akan terhapus dari sistem.

[Gambar Halaman: Modal Konfirmasi Hapus Data Penduduk]

---

### 5.5 Fitur Pencarian dan Filtering Penduduk
* **Kolom Pencarian (*Search Bar*)**: Ketikkan NIK atau Nama Penduduk untuk memfilter data secara cepat.
* **Filter Dusun / RT / RW**: Pilih Dusun tertentu pada drop-down filter untuk menampilkan warga per wilayah.

[Gambar Halaman: Penggunaan Fitur Search dan Filter Penduduk]

---

## BAB VI MASTER KARTU KELUARGA (KK)

### 6.1 Tampilan Master Kartu Keluarga
Akses menu **Master Data -> Data Kartu Keluarga**. Halaman ini menampilkan daftar seluruh No. KK yang terdaftar di Desa Rambipuji beserta Nama Kepala Keluarga dan Alamat Utama.

[Gambar Halaman: Tampilan Master Kartu Keluarga]

---

### 6.2 Menambah Kartu Keluarga Baru
1. Klik tombol **+ Tambah Kartu Keluarga**.
2. Masukkan **Nomor Kartu Keluarga (16 Digit)**.
3. Pilih NIK/Nama Penduduk yang bertindak sebagai **Kepala Keluarga**.
4. Isi Alamat Lengkap, Dusun, RT, dan RW.
5. Klik **Simpan KK**.

[Gambar Halaman: Formulir Tambah Kartu Keluarga]

---

### 6.3 Mengubah Data Kartu Keluarga
1. Pilih baris KK yang hendak diperbarui, klik tombol **Edit**.
2. Perbarui Nomor KK atau Alamat Utama.
3. Klik **Simpan Perubahan**.

[Gambar Halaman: Formulir Edit Kartu Keluarga]

---

### 6.4 Menghapus Data Kartu Keluarga
1. Klik tombol **Hapus** pada baris KK target.
2. Konfirmasi penghapusan pada pop-up yang muncul.
3. Klik **Hapus Data**.

[Gambar Halaman: Konfirmasi Hapus Kartu Keluarga]

---

### 6.5 Pengelolaan Relasi Anggota Keluarga
1. Klik tombol **Detail / Anggota Keluarga** pada tabel KK.
2. Sistem akan menampilkan daftar seluruh anggota yang berada dalam KK tersebut (Istri, Anak, Orang Tua, dll.).
3. Admin dapat menambahkan atau menghapus hubungan anggota keluarga dari No. KK tersebut.

[Gambar Halaman: Tampilan Manajemen Relasi Anggota Keluarga]

---

## BAB VII MASTER JENIS SURAT

### 7.1 Katalog Jenis Surat Pelayanan
Akses menu **Master Surat -> Jenis Surat**. Halaman ini memuat seluruh daftar formulir layanan surat yang disediakan Desa Rambipuji (seperti Surat Keterangan Usaha, Surat Keterangan Tidak Mampu, Surat Keterangan Domisili, dll.).

[Gambar Halaman: Katalog Master Jenis Surat]

---

### 7.2 Menambah Jenis Surat Baru
1. Klik tombol **+ Tambah Jenis Surat**.
2. Isi Nama Surat, Kode Surat, Judul Surat, dan Format Nomor Surat.
3. Tentukan persyaratan dokumen yang wajib diunggah oleh warga (misal: KTP, KK, Pengantar RT/RW).
4. Klik **Simpan Jenis Surat**.

[Gambar Halaman: Formulir Tambah Jenis Surat Baru]

---

### 7.3 Mengubah Jenis Surat dan Template
1. Klik tombol **Edit** pada jenis surat yang diinginkan.
2. Perbarui judul, deskripsi, atau template dokumen PDF.
3. Klik **Perbarui Data**.

[Gambar Halaman: Formulir Edit Jenis Surat]

---

### 7.4 Menghapus Jenis Surat
1. Klik tombol **Hapus** pada baris jenis surat target.
2. Konfirmasi hapus untuk mengonfirmasi tindakan.

[Gambar Halaman: Konfirmasi Hapus Jenis Surat]

---

### 7.5 Mengatur Syarat & Berkas Persyaratan Surat
Admin dapat mencentang atau menambahkan kolom syarat khusus (misal: Foto Usaha untuk SKU, Surat Keterangan Rawat Inap untuk SKTM Berobat).
* **Fungsi**: Memastikan warga mengunggah dokumen pendukung yang valid sebelum pengajuan diproses.

[Gambar Halaman: Pengaturan Berkas Persyaratan Surat]

---

## BAB VIII PENGELOLAAN PENGAJUAN SURAT (ALUR DESA RAMBIPUJI)

### 8.1 Grand Flowchart Persetujuan Berjenjang
Proses pengajuan persuratan di Desa Rambipuji menerapkan alur verifikasi multi-role berjenjang yang aman dan transparan:

```
+-------------------------------------------------------------------------+
|                  1. WARGA (MOBILE / WEB) / KADUS                        |
|             Mengajukan permohonan surat & unggah berkas                |
+-------------------------------------------------------------------------+
                                    |
                                    v
+-------------------------------------------------------------------------+
|                      2. KEPALA DUSUN (KADUS)                            |
|        Verifikasi awal kewilayahan & kecocokan data warga               |
|      [ Setuju: Status -> Disetujui Kepala Dusun | Tolak -> Ditolak ]      |
+-------------------------------------------------------------------------+
                                    |
                                    v
+-------------------------------------------------------------------------+
|                         3. ADMIN DESA                                   |
|   Verifikasi kelengkapan berkas & WAJIB input "Keterangan Admin"        |
|        [ Setuju: Status -> Disetujui Admin | Tolak -> Ditolak ]         |
+-------------------------------------------------------------------------+
                                    |
                                    v
+-------------------------------------------------------------------------+
|                     4. SEKRETARIS DESA (SEKDES)                         |
|   Ulas keabsahan surat & periksa "Keterangan Admin"                     |
|     [ Setuju: Status -> Disetujui Sekretaris Desa | Tolak -> Ditolak ]   |
+-------------------------------------------------------------------------+
                                    |
                                    v
+-------------------------------------------------------------------------+
|                      5. KEPALA DESA (KADES)                             |
|   Pengesahan Akhir & Eksekusi Tanda Tangan Elektronik (TTE)             |
|   System Automatic Trigger -> Generate PDF + QR Code TTE                |
|               [ Status Berubah Menjadi: SELESAI ]                       |
+-------------------------------------------------------------------------+
                                    |
                                    v
+-------------------------------------------------------------------------+
|                      6. SURAT SIAP DIUNDUH                              |
|   Warga / Kadus / Admin mengunduh PDF Resmi Ber-TTE dari Sistem         |
+-------------------------------------------------------------------------+
```

[Gambar Halaman: Diagram Flowchart Alur Pengajuan Surat Multi-Role]

---

### 8.2 Rincian Status Pengajuan Surat
1. **Status Diajukan**: Surat baru saja dikirim oleh Warga/Kadus dan menunggu verifikasi Kepala Dusun.
2. **Disetujui Kepala Dusun**: Surat telah lolos pemeriksaan Kadus dan masuk ke antrean Admin Desa.
3. **Disetujui Admin**: Admin telah memeriksa berkas, mengisi **Keterangan Admin**, dan meneruskan ke Sekretaris Desa.
4. **Disetujui Sekretaris Desa**: Sekdes telah menyetujui kraf surat dan meneruskannya ke Kepala Desa.
5. **Disetujui Kepala Desa / Selesai**: Kepala Desa melakukan pengesahan TTE, PDF diterbitkan otomatis, dan status menjadi **Selesai**.
6. **Ditolak**: Pengajuan ditolak pada salah satu tahap verifikasi (Kadus/Admin/Sekdes/Kades) beserta catatan alasan penolakan.

---

## BAB IX DASHBOARD KEPALA DUSUN (KADUS)

### 9.1 Ringkasan Dashboard Kadus
Saat Kepala Dusun (Role 2) login, sistem menampilkan Dasbor khusus Kepala Dusun yang menyajikan statistik pengajuan surat warga di wilayah dusun yang bersangkutan.

[Gambar Halaman: Dashboard Utama Kepala Dusun]

---

### 9.2 Statistik Surat Masuk, Diproses, Selesai, dan Ditolak
* **Surat Masuk (Diajukan)**: Jumlah permohonan baru dari warga dusun yang butuh verifikasi Kadus.
* **Surat Diproses**: Jumlah surat yang telah disetujui Kadus dan sedang berada di tahap Admin/Sekdes/Kades.
* **Surat Selesai**: Total surat warga dusun yang sudah resmi terbit ber-TTE.
* **Surat Ditolak**: Total permohonan warga dusun yang ditolak beserta alasannya.

[Gambar Halaman: Indikator Kartu Statistik Dashboard Kadus]

---

## BAB X PENGAJUAN SURAT OLEH KEPALA DUSUN

### 10.1 Memilih NIK Warga Pemohon
Kadus dapat membantu warga yang mengalami kendala teknologi dengan mengajukan surat atas nama warga.
1. Masuk ke menu **Tambah Pengajuan Surat**.
2. Pada kolom pencarian NIK Warga, ketikkan NIK atau Nama Warga pemohon.
3. Pilih data warga yang sesuai dari daftar pencarian otomatis (*autocomplete*).

[Gambar Halaman: Pemilihan NIK Warga pada Pengajuan Kadus]

---

### 10.2 Memilih Anggota Keluarga Terkait
Jika pengajuan memerlukan data anggota keluarga (misal: Surat Keterangan Kelahiran/Kematian):
1. Pilih Anggota Keluarga yang relevan dari drop-down relasi KK.
2. Data diri anggota keluarga akan otomatis terisi pada form.

[Gambar Halaman: Pemilihan Anggota Keluarga]

---

### 10.3 Pengisian Formulir Surat
1. Pilih **Jenis Surat** yang dituju.
2. Isi kolom formulir spesifik (misal: Keperluan Surat, Keterangan Usaha, Alamat Tujuan).

[Gambar Halaman: Pengisian Formulir rincian Surat]

---

### 10.4 Mengunggah Berkas Persyaratan
1. Unggah foto/scan berkas pendukung (KTP, KK, Surat Pengantar) pada kolom unggah file (format JPG/PNG/PDF).
2. Pastikan file terbaca dengan jelas.

[Gambar Halaman: Pengunggahan Berkas Persyaratan Surat]

---

### 10.5 Mengirim Pengajuan Atas Nama Warga
1. Periksa kembali seluruh runsian data.
2. Klik tombol **Kirim Pengajuan Surat**.
3. Pengajuan otomatis tercatat di sistem dengan status awal **Diajukan**.

[Gambar Halaman: Penekanan Tombol Kirim Pengajuan]

---

## BAB XI PERSETUJUAN SURAT OLEH KEPALA DUSUN

### 11.1 Memeriksa Daftar Pengajuan Masuk Warga
1. Masuk ke menu **Surat Masuk** pada Dasbor Kadus.
2. Tabel akan menampilkan daftar permohonan surat berstatus **Diajukan** dari warga dusun Anda.

[Gambar Halaman: Daftar Surat Masuk pada Menu Kadus]

---

### 11.2 Prosedur Menyetujui Pengajuan Surat
1. Klik tombol **Detail / Ulas** pada baris pengajuan warga.
2. Periksa kebenaran data warga dan berkas persyaratan.
3. Jika data sudah benar dan valid, klik tombol **SETUJUI**.
4. Status pengajuan otomatis berubah menjadi **Disetujui Kepala Dusun** dan diteruskan ke Admin Desa.

[Gambar Halaman: Modal Penyetujuan Surat oleh Kadus]

---

### 11.3 Prosedur Menolak Pengajuan Surat
1. Jika data tidak valid atau berkas tidak lengkap, klik tombol **TOLAK**.
2. Modal konfirmasi penolakan akan terbuka.

[Gambar Halaman: Tombol Tolak Surat Kadus]

---

### 11.4 Pengisian Alasan Penolakan Kadus
1. Ketikkan alasan penolakan secara jelas pada kolom **Alasan Penolakan** (misal: "Foto KTP buram, mohon unggah ulang").
2. Klik **Konfirmasi Tolak**.
3. Status berubah menjadi **Ditolak** dan pesan alasan dapat dilihat oleh pemohon.

[Gambar Halaman: Form Pengisian Alasan Penolakan Kadus]

---

## BAB XII DASHBOARD SEKRETARIS DESA (SEKDES)

### 12.1 Ringkasan Dashboard Sekdes
Sekretaris Desa (Role 3) mengakses Dasbor Sekdes untuk memantau kelancaran administrasi desa secara makro serta memproses surat yang telah diverifikasi oleh Admin.

[Gambar Halaman: Dashboard Utama Sekretaris Desa]

---

### 12.2 Statistik Menunggu Persetujuan, Selesai, dan Ditolak
* **Menunggu Persetujuan**: Menampilkan surat berstatus **Disetujui Admin** yang membutuhkan tindakan persetujuan Sekdes.
* **Surat Selesai**: Menampilkan daftar surat yang telah rampung ber-TTE.
* **Surat Ditolak**: Rekapitulasi surat yang ditolak pada berbagai tahap.

[Gambar Halaman: Kartu Indikator Dashboard Sekdes]

---

## BAB XIII PERSETUJUAN SURAT OLEH SEKRETARIS DESA

### 13.1 Memeriksa Surat Hasil Verifikasi Admin Desa
1. Akses menu **Surat Masuk** pada sidebar Sekdes.
2. Daftar akan memuat surat-surat berstatus **Disetujui Admin**.

[Gambar Halaman: Daftar Surat Masuk Sekdes]

---

### 13.2 Meninjau Catatan Keterangan Admin
1. Klik tombol **Detail Surat**.
2. Sekdes dapat melihat rincian pemohon, lampiran dokumen, serta catatan khusus yang diinput oleh Admin Desa pada kolom **Keterangan Admin**.

[Gambar Halaman: Tampilan Peninjauan Catatan Keterangan Admin]

---

### 13.3 Prosedur Menyetujui Surat oleh Sekdes
1. Setelah memeriksa draft surat dan Keterangan Admin, klik tombol **SETUJUI**.
2. Status pengajuan diperbarui menjadi **Disetujui Sekretaris Desa** dan diteruskan ke dasbor Kepala Desa untuk pengesahan TTE.

[Gambar Halaman: Modal Persetujuan Surat Sekretaris Desa]

---

### 13.4 Prosedur Menolak Surat dan Catatan Penolakan
1. Jika terdapat kesalahan format atau ketidaksesuaian aturan, klik tombol **TOLAK**.
2. Isi kolom **Alasan Penolakan Sekdes**.
3. Klik **Kirim Penolakan**. Status berubah menjadi **Ditolak**.

[Gambar Halaman: Form Penolakan Surat oleh Sekdes]

---

## BAB XIV DASHBOARD KEPALA DESA (KADES)

### 14.1 Ringkasan Dashboard Kepala Desa
Dasbor Kepala Desa (Role 4) menyajikan ringkasan eksekutif persuratan desa serta pintu utama eksekusi Tanda Tangan Elektronik (TTE).

[Gambar Halaman: Dashboard Utama Kepala Desa]

---

### 14.2 Indikator Surat Menunggu TTE, Selesai, dan Ditolak
* **Menunggu TTE**: Menampilkan surat yang telah lolos verifikasi Sekdes (**Disetujui Sekretaris Desa**) dan siap disahkan secara TTE.
* **Surat Selesai**: Rekapitulasi dokumen yang telah sukses diterbitkan.
* **Surat Ditolak**: Rekapitulasi pengajuan yang ditolak.

[Gambar Halaman: Kartu Indikator Dashboard Kades]

---

## BAB XV PERSETUJUAN SURAT DAN TANDA TANGAN ELEKTRONIK (TTE) KEPALA DESA

### 15.1 Memeriksa Pengajuan Disetujui Sekdes
1. Akses menu **Surat Masuk** pada Dasbor Kades.
2. Tampil daftar pengajuan bermutu tinggi yang telah melalui verifikasi Kadus, Admin, dan Sekdes.

[Gambar Halaman: Daftar Surat Menunggu TTE Kades]

---

### 15.2 Prosedur Menyetujui Surat (Pengesahan TTE)
1. Klik tombol **Detail & Sahkan TTE**.
2. Periksa riwayat persetujuan dari Kadus, Keterangan Admin, dan Sekdes.
3. Klik tombol **SAHKAN SURAT (TTE)**.

[Gambar Halaman: Tombol Sahkan Surat TTE Kepala Desa]

---

### 15.3 Prosedur Menolak Pengajuan oleh Kades
1. Jika Kades memutuskan untuk membatalkan pengajuan, klik **TOLAK**.
2. Masukkan alasan penolakan dan konfirmasi.

[Gambar Halaman: Modal Penolakan Pengajuan oleh Kades]

---

### 15.4 Pembuatan PDF Otomatis dan Penyematan QR TTE
* Saat Kades mengklik **SAHKAN SURAT (TTE)**, sistem backend (*GeneratePDFController*) secara otomatis:
  1. Membuat file dokumen resmi PDF.
  2. Menyematkan Kode QR Tanda Tangan Elektronik (TTE) sah Kepala Desa Rambipuji.
  3. Mengubah status pengajuan menjadi **Selesai**.
  4. Menyimpan berkas PDF resmi ke dalam folder penyimpanan server yang aman.

[Gambar Halaman: Proses Otomatisasi Generate PDF dan Pengesahan TTE]

---

### 15.5 Penerbitan dan Pengunduhan Dokumen oleh Warga
* Warga/Kadus/Admin kini dapat mengakses menu **Surat Selesai** dan mengklik tombol **Unduh Surat (PDF)**.
* Dokumen PDF resmi siap dicetak atau digunakan untuk keperluan administrasi warga.

[Gambar Halaman: Tampilan Unduh Dokumen PDF Ber-TTE Resmi]

---

## BAB XVI PENGELOLAAN PENGADUAN MASYARAKAT

### 16.1 Mengakses Daftar Pengaduan Masuk
Admin Desa dapat mengelola aspirasi dan laporan warga melalui menu **Pengaduan Masyarakat**.

[Gambar Halaman: Tabel Daftar Pengaduan Masuk]

---

### 16.2 Membaca Detail Pengaduan dan Bukti Lampiran
1. Klik tombol **Detail Pengaduan**.
2. Tampil rincian judul laporan, identitas pelapor, isi aduan, serta bukti lampiran foto yang diunggah warga.

[Gambar Halaman: Detail Pengaduan dan Lampiran Foto Warga]

---

### 16.3 Memberikan Tanggapan / Feedback Admin
1. Ketikkan balasan atau langkah penanganan desa pada kolom **Tanggapan Admin**.
2. Klik tombol **Kirim Tanggapan**.
3. Balasan Admin otomatis dapat dibaca oleh warga pelapor.

[Gambar Halaman: Form Pemberian Tanggapan Pengaduan]

---

### 16.4 Monitoring Status Penyelesaian Pengaduan
* Admin dapat mengubah status pengaduan menjadi **Pending**, **Diproses**, atau **Selesai**.
* **Fungsi**: Menjamin bahwa setiap aspirasi warga ditindaklanjuti secara bertanggung jawab.

[Gambar Halaman: Pengaturan Status Monitoring Pengaduan]

---

## BAB XVII MANAJEMEN LANDING PAGE

### 17.1 Mengubah Banner Utama Landing Page
1. Masuk ke menu **Manajemen Landingpage -> Banner**.
2. Unggah gambar banner baru dan isi teks judul promosi/himbauan desa.
3. Klik **Simpan Perubahan Banner**.

[Gambar Halaman: Manajemen Banner Utama Landing Page]

---

### 17.2 Mengubah Informasi Profil Desa
1. Masuk ke tab **Informasi Desa**.
2. Perbarui deskripsi profil, alamat kantor desa, serta email resmi.
3. Klik **Update Informasi**.

[Gambar Halaman: Pengaturan Informasi Profil Desa]

---

### 17.3 Mengubah Visi dan Misi Desa
1. Pilih tab **Visi & Misi**.
2. Ketikkan poin-poin Visi dan Misi Kepala Desa Rambipuji.
3. Klik **Simpan Visi Misi**.

[Gambar Halaman: Pengaturan Teks Visi dan Misi Desa]

---

### 17.4 Mengubah Sejarah Desa
1. Masuk ke tab **Sejarah Desa**.
2. Tuliskan atau perbarui uraian ringkas sejarah berdiri Desa Rambipuji.
3. Klik **Simpan Sejarah**.

[Gambar Halaman: Pengaturan Artikel Sejarah Desa]

---

### 17.5 Mengubah Kontak dan Alamat Desa
1. Masuk ke tab **Kontak & Lokasi**.
2. Masukkan nomor telepon kantor, WhatsApp layanan, serta tautan koordinat Google Maps kantor desa.
3. Klik **Simpan Kontak**.

[Gambar Halaman: Pengaturan Kontak dan Lokasi Desa]

---

### 17.6 Mengubah Galeri Foto Landing Page
1. Masuk ke tab **Galeri Desa**.
2. Klik **+ Tambah Foto Galeri**, pilih file foto kegiatan desa.
3. Klik **Unggah Foto**. Foto baru akan tampil di portal publik.

[Gambar Halaman: Manajemen Galeri Foto Desa]

---

## BAB XVIII MANAJEMEN BERITA DESA

### 18.1 Menambah Berita Desa Baru
1. Akses menu **Manajemen Berita -> Tambah Berita**.
2. Isi Judul Berita, Kategori, Foto Utama Berita, dan Isi Artikel Berita.
3. Klik **Publikasikan Berita**.

[Gambar Halaman: Form Tambah Berita Desa Baru]

---

### 18.2 Mengubah / Mengedit Berita Desa
1. Pilih berita yang ingin diperbarui dari tabel daftar berita, klik **Edit**.
2. Perbarui judul, foto, atau isi konten berita.
3. Klik **Perbarui Berita**.

[Gambar Halaman: Form Edit Berita Desa]

---

### 18.3 Menghapus Berita Desa
1. Klik tombol **Hapus** pada baris berita target.
2. Konfirmasi hapus data. Berita akan dihapus dari portal.

[Gambar Halaman: Konfirmasi Hapus Berita Desa]

---

### 18.4 Mempublikasikan Berita ke Portal Utama
* Berita yang diterbitkan otomatis muncul di seksi **Berita Terkini** pada Landing Page publik Desa Rambipuji sehingga dapat dibaca oleh seluruh masyarakat.

[Gambar Halaman: Tampilan Berita Publik pada Landing Page]

---

## BAB XIX LOGOUT SISTEM

### 19.1 Prosedur Logout dari Aplikasi Web
Untuk menjaga keamanan data dan mencegah akses tanpa wewenang:
1. Klik nama profil atau tombol profil pada pojok kanan atas Dasbor.
2. Klik opsi **Logout / Keluar**.
3. Sistem secara otomatis menghapus sesi (*session*) login Anda dan mengarahkan kembali ke Halaman Login Utama.

[Gambar Halaman: Prosedur Logout dari Dasbor Sistem]

---

## BAB XX PENUTUP

### 20.1 Kesimpulan dan Harapan
Penyusunan **Manual Book Website Digital Village Desa Rambipuji** ini diharapkan dapat menjadi panduan baku bagi seluruh Perangkat Desa dan masyarakat Desa Rambipuji dalam memanfaatkan teknologi pelayanan administrasi publik digital.

Dengan pemahaman alur kerja yang baik—mulai dari tingkatan Kepala Dusun, Admin Desa, Sekretaris Desa, hingga penerbitan Tanda Tangan Elektronik oleh Kepala Desa—diharapkan pelayanan publik di Desa Rambipuji berjalan semakin cepat, efisien, transparan, serta memberikan kepuasan maksimal bagi seluruh lapisan masyarakat.

---
*Dokumen ini diterbitkan secara resmi oleh Pemerintah Desa Rambipuji, Kecamatan Rambipuji, Kabupaten Jember (2026).*
