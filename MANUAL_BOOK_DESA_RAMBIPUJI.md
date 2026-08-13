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
* **Versi Dokumen**: 2.5 (Edisi Lengkap Multi-Role, Master Akun RT/RW, TTE Kades & Mobile API)

---

## KATA PENGANTAR

Puji syukur kehadirat Allah SWT, Tuhan Yang Maha Esa, karena atas rahmat dan karunia-Nya, penyusunan **Manual Book Website Digital Village Desa Rambipuji** ini dapat diselesaikan dengan baik dan selaras dengan implementasi sistem terbaru.

Buku panduan ini disusun sebagai acuan resmi dalam pengoperasian dan pengelolaan Sistem Pelayanan Administrasi Desa Berbasis Digital di Desa Rambipuji, Kecamatan Rambipuji, Kabupaten Jember. Transformasi digital ini bertujuan untuk mempercepat proses birokrasi, meningkatkan transparansi publik, mempermudah pelayanan surat-menyurat bagi masyarakat, serta mendukung tata kelola pemerintahan desa yang modern, akuntabel, dan efisien.

Buku manual ini dirancang secara sistematis dengan menyajikan penjelasan fungsi, alur kerja, hingga panduan langkah demi langkah (*step-by-step*) yang dapat dipelajari dengan mudah oleh seluruh tingkatan pengguna, mulai dari masyarakat umum/warga, Kepala Dusun (Kadus), Staff Admin Desa, Sekretaris Desa (Sekdes), hingga Kepala Desa (Kades), serta mencakup integrasi aplikasi mobile dan layanan REST API.

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
* [BAB II LANDING PAGE WEBSITE & PORTAL PUBLIK](#bab-ii-landing-page-website--portal-publik)
  * [2.1 Cara Membuka Website](#21-cara-membuka-website)
  * [2.2 Tampilan Beranda Utama](#22-tampilan-beranda-utama)
  * [2.3 Navigation Bar dan Menu Beranda](#23-navigation-bar-dan-menu-beranda)
  * [2.4 Menu Layanan Surat](#24-menu-layanan-surat)
  * [2.5 Menu Tentang Kami & Berita Desa](#25-menu-tentang-kami--berita-desa)
  * [2.6 Tombol Login dan Akses Manajemen](#26-tombol-login-dan-akses-manajemen)
* [BAB III LOGIN SISTEM & AUTENTIKASI](#bab-iii-login-sistem--autentikasi)
  * [3.1 Akses Halaman Login Web](#31-akses-halaman-login-web)
  * [3.2 Pengisian Username / NIK](#32-pengisian-username--nik)
  * [3.3 Pengisian Password](#33-pengisian-password)
  * [3.4 Penekanan Tombol Masuk](#34-penekanan-tombol-masuk)
  * [3.5 Handling Notifikasi Login Gagal](#35-handling-notifikasi-login-gagal)
  * [3.6 Handling Notifikasi Login Berhasil & Redirect Peran](#36-handling-notifikasi-login-berhasil--redirect-peran)
* [BAB IV DASHBOARD ADMIN DESA](#bab-iv-dashboard-admin-desa)
  * [4.1 Kartu Statistik Utama Dashboard Admin](#41-kartu-statistik-utama-dashboard-admin)
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
* [BAB VII MASTER AKUN (AKUN RT & AKUN RW)](#bab-vii-master-akun-akun-rt--akun-rw)
  * [7.1 Konsep Manajemen Akun Kewilayahan RT/RW](#71-konsep-manajemen-akun-kewilayahan-rtrw)
  * [7.2 Pengelolaan Master Akun RW](#72-pengelolaan-master-akun-rw)
  * [7.3 Pengelolaan Master Akun RT](#73-pengelolaan-master-akun-rt)
  * [7.4 Integrasi Data NIK Penduduk sebagai Ketua RT/RW](#74-integrasi-data-nik-penduduk-sebagai-ketua-rtrw)
* [BAB VIII MASTER JENIS SURAT](#bab-viii-master-jenis-surat)
  * [8.1 Katalog Jenis Surat Pelayanan](#81-katalog-jenis-surat-pelayanan)
  * [8.2 Menambah Jenis Surat Baru](#82-menambah-jenis-surat-baru)
  * [8.3 Mengubah Jenis Surat dan Template](#83-mengubah-jenis-surat-dan-template)
  * [8.4 Menghapus Jenis Surat](#84-menghapus-jenis-surat)
  * [8.5 Mengatur Syarat & Berkas Persyaratan Surat](#85-mengatur-syarat--berkas-persyaratan-surat)
* [BAB IX PENGELOLAAN PENGAJUAN SURAT (ALUR 5 TINGKAT DESA RAMBIPUJI)](#bab-ix-pengelolaan-pengajuan-surat-alur-5-tingkat-desa-rambipuji)
  * [9.1 Grand Flowchart Persetujuan Berjenjang](#91-grand-flowchart-persetujuan-berjenjang)
  * [9.2 Rincian Status Pengajuan Surat](#92-rincian-status-pengajuan-surat)
* [BAB X DASHBOARD KEPALA DUSUN (KADUS)](#bab-x-dashboard-kepala-dusun-kadus)
  * [10.1 Ringkasan Dashboard Kadus](#101-ringkasan-dashboard-kadus)
  * [10.2 Statistik Surat Masuk, Diproses, Selesai, dan Ditolak](#102-statistik-surat-masuk-diproses-selesai-dan-ditolak)
  * [10.3 Fitur Pengajuan Surat Atas Nama Warga Oleh Kadus](#103-fitur-pengajuan-surat-atas-nama-warga-oleh-kadus)
* [BAB XI PERSETUJUAN SURAT OLEH KEPALA DUSUN](#bab-xi-persetujuan-surat-oleh-kepala-dusun)
  * [11.1 Memeriksa Daftar Pengajuan Masuk Warga](#111-memeriksa-daftar-pengajuan-masuk-warga)
  * [11.2 Prosedur Menyetujui Pengajuan Surat (`Disetujui Kepala Dusun`)](#112-prosedur-menyetujui-pengajuan-surat-disetujui-kepala-dusun)
  * [11.3 Prosedur Menolak Pengajuan Surat (`Ditolak`)](#113-prosedur-menolak-pengajuan-surat-ditolak)
* [BAB XII VERIFIKASI SURAT OLEH ADMIN DESA](#bab-xii-verifikasi-surat-oleh-admin-desa)
  * [12.1 Memeriksa Surat Masuk (`Disetujui Kepala Dusun` / `Diajukan`)](#121-memeriksa-surat-masuk-disetujui-kepala-dusun--diajukan)
  * [12.2 Prosedur Input Wajib "Keterangan Admin"](#122-prosedur-input-wajib-keterangan-admin)
  * [12.3 Menyetujui Surat (`Disetujui Admin`)](#123-menyetujui-surat-disetujui-admin)
  * [12.4 Menolak Surat (`Ditolak`)](#124-menolak-surat-ditolak)
* [BAB XIII DASHBOARD & PERSETUJUAN SEKRETARIS DESA (SEKDES)](#bab-xiii-dashboard--persetujuan-sekretaris-desa-sekdes)
  * [13.1 Ringkasan Dashboard Sekdes](#131-ringkasan-dashboard-sekdes)
  * [13.2 Memeriksa Surat Masuk (`Disetujui Admin`)](#132-memeriksa-surat-masuk-disetujui-admin)
  * [13.3 Meninjau Catatan Keterangan Admin](#133-meninjau-catatan-keterangan-admin)
  * [13.4 Prosedur Menyetujui Surat (`Disetujui Sekretaris Desa`)](#134-prosedur-menyetujui-surat-disetujui-sekretaris-desa)
  * [13.5 Prosedur Menolak Surat (`Ditolak`)](#135-prosedur-menolak-surat-ditolak)
* [BAB XIV DASHBOARD & PERSETUJUAN KEPALA DESA (KADES)](#bab-xiv-dashboard--persetujuan-kepala-desa-kades)
  * [14.1 Ringkasan Dashboard Kades](#141-ringkasan-dashboard-kades)
  * [14.2 Memeriksa Pengajuan (`Disetujui Sekretaris Desa`)](#142-memeriksa-pengajuan-disetujui-sekretaris-desa)
  * [14.3 Prosedur Pengesahan Surat & Eksekusi TTE](#143-prosedur-pengesahan-surat--eksekusi-tte)
  * [14.4 Prosedur Menolak Pengajuan oleh Kades](#144-prosedur-menolak-pengajuan-oleh-kades)
* [BAB XV GENERATE PDF OTOMATIS DAN TANDA TANGAN ELEKTRONIK (TTE)](#bab-xv-generate-pdf-otomatis-dan-tanda-tangan-elektronik-tte)
  * [15.1 Backend Automasi PDF Engine (`GeneratePDFController`)](#151-backend-automasi-pdf-engine-generatepdfcontroller)
  * [15.2 Penyematan QR Code TTE Resmi Kades](#152-penyematan-qr-code-tte-resmi-kades)
  * [15.3 Penerbitan dan Pengunduhan Dokumen PDF Resmi](#153-penerbitan-dan-pengunduhan-dokumen-pdf-resmi)
* [BAB XVI INTEGRASI APLIKASI MOBILE & REST API SYSTEM](#bab-xvi-integrasi-aplikasi-mobile--rest-api-system)
  * [16.1 Arsitektur REST API & Token Sanctum](#161-arsitektur-rest-api--token-sanctum)
  * [16.2 Fitur Lupa Password & OTP WhatsApp](#162-fitur-lupa-password--otp-whatsapp)
  * [16.3 Layanan Chatbot Syarat Surat](#163-layanan-chatbot-syarat-surat)
  * [16.4 Fitur Tracking Status & Notifikasi Realtime](#164-fitur-tracking-status--notifikasi-realtime)
* [BAB XVII PENGELOLAAN PENGADUAN MASYARAKAT](#bab-xvii-pengelolaan-pengaduan-masyarakat)
  * [17.1 Mengakses Daftar Pengaduan Masuk](#171-mengakses-daftar-pengaduan-masuk)
  * [17.2 Membaca Detail Pengaduan dan Bukti Lampiran](#172-membaca-detail-pengaduan-dan-bukti-lampiran)
  * [17.3 Memberikan Tanggapan / Feedback Admin](#173-memberikan-tanggapan--feedback-admin)
  * [17.4 Monitoring Status Penyelesaian Pengaduan](#174-monitoring-status-penyelesaian-pengaduan)
* [BAB XVIII MANAJEMEN LANDING PAGE](#bab-xviii-manajemen-landing-page)
  * [18.1 Mengubah Banner Utama Landing Page](#181-mengubah-banner-utama-landing-page)
  * [18.2 Mengubah Informasi Profil Desa](#182-mengubah-informasi-profil-desa)
  * [18.3 Mengubah Visi dan Misi Desa](#183-mengubah-visi-dan-misi-desa)
  * [18.4 Mengubah Sejarah Desa](#184-mengubah-sejarah-desa)
  * [18.5 Mengubah Kontak dan Alamat Desa](#185-mengubah-kontak-dan-alamat-desa)
  * [18.6 Mengubah Galeri Foto Landing Page](#186-mengubah-galeri-foto-landing-page)
* [BAB XIX MANAJEMEN BERITA DESA](#bab-xix-manajemen-berita-desa)
  * [19.1 Menambah Berita Desa Baru](#191-menambah-berita-desa-baru)
  * [19.2 Mengubah / Mengedit Berita Desa](#192-mengubah--mengedit-berita-desa)
  * [19.3 Menghapus Berita Desa](#193-menghapus-berita-desa)
  * [19.4 Mempublikasikan Berita ke Portal Utama](#194-mempublikasikan-berita-ke-portal-utama)
* [BAB XX LOGOUT SISTEM](#bab-xx-logout-sistem)
  * [20.1 Prosedur Logout dari Aplikasi Web](#201-prosedur-logout-dari-aplikasi-web)
* [BAB XXI PENUTUP](#bab-xxi-penutup)
  * [21.1 Kesimpulan dan Harapan](#211-kesimpulan-dan-harapan)

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
3. **Integritas Data Kependudukan**: Menyediakan pusat data kependudukan, Kartu Keluarga (KK), dan Master Akun RT/RW yang terintegrasi, terkini, dan mudah dikelola oleh perangkat desa.
4. **Pemberdayaan Transparansi Publik**: Menyediakan media informasi resmi desa yang memuat berita, pengumuman, visi-misi, sejarah, serta fasilitas penampung aspirasi/pengaduan masyarakat.

---

### 1.3 Manfaat Website Bagi Masyarakat dan Perangkat Desa

#### A. Bagi Masyarakat (Warga Desa Rambipuji)
* **Kemudahan Akses**: Warga dapat mengajukan permohonan surat kapan saja melalui portal web maupun aplikasi mobile tanpa harus mengantre lama di kantor desa.
* **Transparansi Status**: Warga dapat memantau secara langsung status pengajuan surat (apakah sedang berada di tahap `Diajukan`, `Disetujui Kepala Dusun`, `Disetujui Admin`, `Disetujui Sekretaris Desa`, atau `Selesai`).
* **Unduh Dokumen Mandiri**: Surat yang telah disahkan dengan Tanda Tangan Elektronik (TTE) dapat langsung diunduh dalam format PDF resmi bermutu tinggi.
* **Saluran Pengaduan Mudah**: Memudahkan warga dalam menyampaikan masukan, aspirasi, atau pengaduan secara terstruktur.

#### B. Bagi Perangkat Desa (Kadus, Admin, Sekdes, Kades)
* **Manajemen Berkas Efisien**: Pengelolaan data penduduk, KK, akun RT/RW, dan pengajuan surat tersimpan secara rapi dalam basis data digital terpusat.
* **Kemudahan Verifikasi**: Setiap pejabat/perangkat desa dapat melakukan pengulasan dokumen, pemberian catatan admin wajib (*Keterangan Admin*), serta persetujuan cukup melalui dasbor sistem.
* **Pengesahan TTE Praktis**: Kepala Desa dapat mengesahkan dokumen resmi menggunakan Tanda Tangan Elektronik secara legal dan praktis tanpa terhalang kendala geografis.
* **Pengambilan Keputusan Berbasis Data**: Grafik dan statistik dasbor membantu pimpinan desa dalam memantau tren pelayanan kependudukan dan responsivitas pengaduan.

---

## BAB II LANDING PAGE WEBSITE & PORTAL PUBLIK

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

### 2.4 Menu Layanan Surat
Menu **Layanan** berisi informasi seputar jenis-jenis surat administrasi yang disediakan oleh Pemerintah Desa Rambipuji (seperti Surat Keterangan Tidak Mampu, Surat Keterangan Usaha, Surat Keterangan Domisili, dll.).
* **Fungsi**: Memberikan informasi transparan mengenai persyaratan berkas yang harus disiapkan oleh warga sebelum mengajukan surat.

[Gambar Halaman: Bagian Menu Layanan Desa]

---

### 2.5 Menu Tentang Kami & Berita Desa
Menu **Tentang Kami** dan **Berita Desa** menyajikan profil lengkap Desa Rambipuji meliputi:
* Sejarah singkat pembentukan Desa Rambipuji.
* Visi dan Misi Pemerintah Desa Rambipuji.
* Struktur organisasi, peta wilayah desa, serta berita publikasi resmi desa.

[Gambar Halaman: Bagian Menu Tentang Kami dan Berita]

---

### 2.6 Tombol Login dan Akses Manajemen
Pada pojok kanan atas *Navigation Bar*, terdapat tombol menonjol bertuliskan **LOGIN**.
* **Fungsi Tombol Login**: Mengarahkan Perangkat Desa (Admin Desa, Kepala Dusun, Sekretaris Desa, Kepala Desa) serta pengguna terdaftar menuju halaman autentikasi masuk ke dalam Dasbor Manajemen Sistem.

[Gambar Halaman: Tombol Login pada Navigation Bar]

---

## BAB III LOGIN SISTEM & AUTENTIKASI

### 3.1 Akses Halaman Login Web
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

### 3.6 Handling Notifikasi Login Berhasil & Redirect Peran
Jika kredensial valid:
* Tampil notifikasi pesan sukses (*Alert Success*): **"Selamat Datang di Sistem Digital Village Desa Rambipuji!"**
* Sistem secara otomatis mengarahkan (*redirect*) pengguna ke Dasbor sesuai dengan *Role* (Peran) masing-masing:
  * **Role 1 (Admin Desa)** -> Direct ke `/admin/dashboard`
  * **Role 2 (Kepala Dusun)** -> Direct ke `/kepaladusun/dashboard`
  * **Role 3 (Sekretaris Desa)** -> Direct ke `/sekretarisdesa/dashboard`
  * **Role 4 (Kepala Desa)** -> Direct ke `/kepaladesa/dashboard`

[Gambar Halaman: Notifikasi Login Berhasil dan Process Redirect]

---

## BAB IV DASHBOARD ADMIN DESA

### 4.1 Kartu Statistik Utama Dashboard Admin
Setelah Login sebagai Admin Desa (Role 1), pengguna akan disambut oleh Dasbor Admin yang menyajikan visualisasi data dan ringkasan statistik kinerja pelayanan desa secara *real-time*.

[Gambar Halaman: Dashboard Utama Admin Desa]

---

### 4.2 Indikator Surat Masuk, Verifikasi, Selesai, dan Pengaduan
Pada bagian atas Dasbor Admin, terdapat 4 Kartu Statistik utama:
1. **Kartu Total Surat Masuk**: Menampilkan akumulasi seluruh permohonan surat yang masuk ke sistem.
2. **Kartu Menunggu Verifikasi**: Menampilkan jumlah surat yang saat ini membutuhkan tindakan pengulasan dan verifikasi oleh Admin Desa (surat berstatus `Disetujui Kepala Dusun` atau `Diajukan`).
3. **Kartu Surat Selesai**: Menampilkan total surat yang telah berhasil disahkan hingga tahap TTE Kades.
4. **Kartu Pengaduan Masyarakat**: Menampilkan total laporan aspirasi/pengaduan yang masuk dari warga.

[Gambar Halaman: Kartu Indikator Statistik Dashboard Admin]

---

### 4.3 Struktur Menu Sidebar Admin
Sidebar di sebelah kiri layar menyediakan navigasi lengkap sesuai struktur program terbaru (`sidebar.blade.php`):
* **Dashboard**: Halaman utama indikator statistik (`/admin/dashboard`).
* **Kartu Keluarga**: Pengelolaan data Kartu Keluarga dan anggota KK (`/admin/master_kartukeluarga`).
* **Pengajuan Surat (Dropdown)**:
  * **Tambah Pengajuan**: Fasilitas membuat pengajuan surat atas nama warga (`/admin/tambah-pengajuan`).
  * **Surat Masuk**: Pemrosesan surat masuk (`/admin/suratmasuk`).
  * **Surat Selesai**: Arsip pengajuan surat selesai (`/admin/suratselesai`).
  * **Surat Ditolak**: Rekapitulasi permohonan ditolak (`/admin/suratditolak`).
* **Master Akun (Dropdown)**:
  * **Akun RW**: Pengelolaan akun Ketua RW (`/admin/akunrw`).
  * **Akun RT**: Pengelolaan akun Ketua RT (`/admin/akunrt`).
* **Master Surat**: Pengaturan katalog dan formulir jenis surat (`/admin/mastersurat`).
* **Pengaduan Masyarakat**: Pengelolaan dan pemberian tanggapan pengaduan (`/admin/pengaduan`).
* **Kelola Website**: Pengaturan konten landing page portal (`/admin/landingpage`).

[Gambar Halaman: Struktur Menu Sidebar Admin Desa]

---

## BAB V MASTER DATA PENDUDUK

### 5.1 Navigasi dan Tampilan Tabel Penduduk
Akses menu **Master Data -> Data Penduduk** pada sidebar (atau URL `/admin/master_penduduk`). Halaman ini menampilkan tabel seluruh warga terdaftar yang dilengkapi informasi NIK, Nama Lengkap, Jenis Kelamin, Tanggal Lahir, Dusun, RT/RW, dan Status Kependudukan.

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
2. Klik tombol **Edit** (ikon pensil) pada kolom Aksi.
3. Ubah data pada formulir sesuai kebutuhan.
4. Klik tombol **Perbarui / Update**.

[Gambar Halaman: Formulir Edit Data Penduduk]

---

### 5.4 Menghapus Data Penduduk
1. Klik tombol **Hapus** (ikon tempat sampah) pada baris data penduduk yang sesuai.
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
Akses menu **Kartu Keluarga** (`/admin/master_kartukeluarga`). Halaman ini menampilkan daftar seluruh No. KK yang terdaftar di Desa Rambipuji beserta Nama Kepala Keluarga dan Alamat Utama.

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

## BAB VII MASTER AKUN (AKUN RT & AKUN RW)

### 7.1 Konsep Manajemen Akun Kewilayahan RT/RW
Modul **Master Akun** dirancang khusus untuk memetakan dan mengelola kredensial pengurus kewilayahan di tingkat Rukun Tetangga (RT) dan Rukun Warga (RW) di Desa Rambipuji. Penunjukan pengurus RT/RW dilakukan secara otomatis dengan mengaitkan NIK warga yang telah terdaftar di Master Data Penduduk.

---

### 7.2 Pengelolaan Master Akun RW
Akses menu **Master Akun -> Akun RW** (`/admin/akunrw`):
1. **Daftar Akun RW**: Menampilkan tabel Ketua RW yang memuat ID RTRW (format otomatis `R2026-001`), NIK, Nama Ketua RW, Nomor HP, dan Wilayah RW.
2. **Tambah Akun RW Baru**:
   * Klik **+ Tambah Akun RW**.
   * Cari NIK / Nama Warga melalui fitur *autocomplete* data penduduk.
   * Masukkan Nomor Handphone aktif dan Nomor RW.
   * Klik **Simpan Data**. Sistem memvalidasi bahwa 1 RW hanya memiliki 1 Ketua RW yang aktif.
3. **Edit & Hapus Akun RW**: Admin dapat memperbarui nomor telepon/RW atau menghapus penunjukan pengurus RW.

[Gambar Halaman: Halaman Pengelolaan Master Akun RW]

---

### 7.3 Pengelolaan Master Akun RT
Akses menu **Master Akun -> Akun RT** (`/admin/akunrt`):
1. **Daftar Akun RT**: Menampilkan tabel Ketua RT lengkap dengan relasi Nomor RT dan Nomor RW pengampu.
2. **Tambah Akun RT Baru**:
   * Klik **+ Tambah Akun RT**.
   * Pilih NIK Ketua RT terdaftar dari database penduduk.
   * Tentukan Nomor RT dan Nomor RW tempatnya bertugas.
   * Klik **Simpan Data**.
3. **Pencarian & Validasi**: Sistem menyediakan validasi otomatis agar tidak terjadi ganda NIK pada pengurus RT/RW.

[Gambar Halaman: Halaman Pengelolaan Master Akun RT]

---

### 7.4 Integrasi Data NIK Penduduk sebagai Ketua RT/RW
Pengaitan NIK penduduk menjamin keabsahan identitas pengurus RT/RW. Jika terdapat perubahan data pribadi pada Master Penduduk, informasi pada Akun RT/RW akan tersinkronisasi secara otomatis.

---

## BAB VIII MASTER JENIS SURAT

### 8.1 Katalog Jenis Surat Pelayanan
Akses menu **Master Surat** (`/admin/mastersurat`). Halaman ini memuat seluruh daftar formulir layanan surat yang disediakan Desa Rambipuji (seperti Surat Keterangan Usaha, Surat Keterangan Tidak Mampu, Surat Keterangan Domisili, dll.).

[Gambar Halaman: Katalog Master Jenis Surat]

---

### 8.2 Menambah Jenis Surat Baru
1. Klik tombol **+ Tambah Jenis Surat**.
2. Isi Nama Surat, Kode Surat, Judul Surat, dan Format Nomor Surat.
3. Tentukan persyaratan dokumen yang wajib diunggah oleh warga (misal: KTP, KK, Pengantar RT/RW).
4. Klik **Simpan Jenis Surat**.

[Gambar Halaman: Formulir Tambah Jenis Surat Baru]

---

### 8.3 Mengubah Jenis Surat dan Template
1. Klik tombol **Edit** pada jenis surat yang diinginkan.
2. Perbarui judul, deskripsi, atau template dokumen PDF.
3. Klik **Perbarui Data**.

[Gambar Halaman: Formulir Edit Jenis Surat]

---

### 8.4 Menghapus Jenis Surat
1. Klik tombol **Hapus** pada baris jenis surat target.
2. Konfirmasi hapus untuk mengonfirmasi tindakan.

[Gambar Halaman: Konfirmasi Hapus Jenis Surat]

---

### 8.5 Mengatur Syarat & Berkas Persyaratan Surat
Admin dapat mencentang atau menambahkan kolom syarat khusus (misal: Foto Usaha untuk SKU, Surat Keterangan Rawat Inap untuk SKTM Berobat).
* **Fungsi**: Memastikan warga mengunggah dokumen pendukung yang valid (format `foto1` hingga `foto9`) sebelum pengajuan diproses.

[Gambar Halaman: Pengaturan Berkas Persyaratan Surat]

---

## BAB IX PENGELOLAAN PENGAJUAN SURAT (ALUR 5 TINGKAT DESA RAMBIPUJI)

### 9.1 Grand Flowchart Persetujuan Berjenjang
Proses pengajuan persuratan di Desa Rambipuji menerapkan alur verifikasi multi-role 5 tingkat yang aman dan transparan:

```
+-------------------------------------------------------------------------+
|                1. WARGA (WEB / MOBILE APP) / KADUS                      |
|           Mengajukan permohonan surat & unggah berkas pendukung        |
|                         [ Status: Diajukan ]                            |
+-------------------------------------------------------------------------+
                                    |
                                    v
+-------------------------------------------------------------------------+
|                    2. KEPALA DUSUN (KADUS) (ROLE 2)                     |
|        Verifikasi awal kewilayahan & kecocokan data warga               |
|      [ Setuju: Status -> Disetujui Kepala Dusun | Tolak -> Ditolak ]      |
+-------------------------------------------------------------------------+
                                    |
                                    v
+-------------------------------------------------------------------------+
|                       3. ADMIN DESA (ROLE 1)                            |
|   Verifikasi kelengkapan berkas & WAJIB input "Keterangan Admin"        |
|        [ Setuju: Status -> Disetujui Admin | Tolak -> Ditolak ]         |
+-------------------------------------------------------------------------+
                                    |
                                    v
+-------------------------------------------------------------------------+
|                   4. SEKRETARIS DESA (SEKDES) (ROLE 3)                  |
|   Ulas keabsahan surat & periksa "Keterangan Admin"                     |
|     [ Setuju: Status -> Disetujui Sekretaris Desa | Tolak -> Ditolak ]   |
+-------------------------------------------------------------------------+
                                    |
                                    v
+-------------------------------------------------------------------------+
|                    5. KEPALA DESA (KADES) (ROLE 4)                      |
|   Pengesahan Akhir & Eksekusi Tanda Tangan Elektronik (TTE)             |
|   System Automatic Trigger -> Generate PDF + QR Code TTE                |
|               [ Status Berubah Menjadi: SELESAI ]                       |
+-------------------------------------------------------------------------+
                                    |
                                    v
+-------------------------------------------------------------------------+
|                    6. DOKUMEN SIAP DIUNDUH MANDIRI                      |
|   Warga / Kadus / Admin mengunduh PDF Resmi Ber-TTE dari Sistem         |
+-------------------------------------------------------------------------+
```

[Gambar Halaman: Diagram Flowchart Alur Pengajuan Surat Multi-Role]

---

### 9.2 Rincian Status Pengajuan Surat
1. **Status Diajukan**: Surat baru saja dikirim oleh Warga/Kadus dan menunggu verifikasi Kepala Dusun.
2. **Disetujui Kepala Dusun**: Surat telah lolos pemeriksaan Kadus dan masuk ke antrean Admin Desa.
3. **Disetujui Admin**: Admin telah memeriksa berkas, mengisi **Keterangan Admin**, dan meneruskan ke Sekretaris Desa.
4. **Disetujui Sekretaris Desa**: Sekdes telah menyetujui kraf surat dan meneruskannya ke Kepala Desa.
5. **Selesai**: Kepala Desa melakukan pengesahan TTE, PDF diterbitkan otomatis oleh backend, dan dokumen siap diunduh.
6. **Ditolak**: Pengajuan ditolak pada salah satu tahap verifikasi (Kadus/Admin/Sekdes/Kades) disertai alasan penolakan pada kolom `keterangan_ditolak`.

---

## BAB X DASHBOARD KEPALA DUSUN (KADUS)

### 10.1 Ringkasan Dashboard Kadus
Saat Kepala Dusun (Role 2) login ke `/kepaladusun/dashboard`, sistem menampilkan Dasbor khusus Kepala Dusun yang menyajikan statistik pengajuan surat warga di wilayah dusun yang bersangkutan.

[Gambar Halaman: Dashboard Utama Kepala Dusun]

---

### 10.2 Statistik Surat Masuk, Diproses, Selesai, dan Ditolak
* **Surat Masuk (Diajukan)**: Jumlah permohonan baru dari warga dusun yang butuh verifikasi Kadus.
* **Surat Diproses**: Jumlah surat yang telah disetujui Kadus dan sedang berada di tahap Admin/Sekdes/Kades.
* **Surat Selesai**: Total surat warga dusun yang sudah resmi terbit ber-TTE.
* **Surat Ditolak**: Total permohonan warga dusun yang ditolak beserta alasannya.

---

### 10.3 Fitur Pengajuan Surat Atas Nama Warga Oleh Kadus
Kadus dapat membantu warga lansia atau warga yang mengalami keterbatasan teknologi melalui menu **Tambah Pengajuan** (`/kepaladusun/tambah-pengajuan`):
1. Cari NIK Warga melalui pencarian otomatis.
2. Pilih relasi No. KK & Anggota Keluarga yang bersangkutan.
3. Isi formulir surat & unggah berkas fisik warga.
4. Klik **Kirim Pengajuan**. Surat langsung tercatat dan dapat diproses.

[Gambar Halaman: Indikator Kartu Grafik Dashboard Kadus]

---

## BAB XI PERSETUJUAN SURAT OLEH KEPALA DUSUN

### 11.1 Memeriksa Daftar Pengajuan Masuk Warga
1. Masuk ke menu **Surat Masuk** pada Dasbor Kadus (`/kepaladusun/suratmasuk`).
2. Tabel akan menampilkan daftar permohonan surat berstatus **Diajukan** dari warga dusun Anda.

[Gambar Halaman: Daftar Surat Masuk pada Menu Kadus]

---

### 11.2 Prosedur Menyetujui Pengajuan Surat (`Disetujui Kepala Dusun`)
1. Klik tombol **Detail / Ulas** pada baris pengajuan warga.
2. Periksa kebenaran data warga dan berkas persyaratan.
3. Jika data sudah benar dan valid, klik tombol **SETUJUI**.
4. Status pengajuan otomatis berubah menjadi **Disetujui Kepala Dusun** dan diteruskan ke Admin Desa.

[Gambar Halaman: Modal Penyetujuan Surat oleh Kadus]

---

### 11.3 Prosedur Menolak Pengajuan Surat (`Ditolak`)
1. Jika data tidak valid atau berkas tidak lengkap, klik tombol **TOLAK**.
2. Modal konfirmasi penolakan akan terbuka.
3. Ketikkan alasan penolakan secara jelas pada kolom **Alasan Penolakan**.
4. Klik **Konfirmasi Tolak**. Status berubah menjadi **Ditolak**.

[Gambar Halaman: Form Pengisian Alasan Penolakan Kadus]

---

## BAB XII VERIFIKASI SURAT OLEH ADMIN DESA

### 12.1 Memeriksa Surat Masuk (`Disetujui Kepala Dusun` / `Diajukan`)
Admin Desa mengakses menu **Surat Masuk** (`/admin/suratmasuk`). Halaman ini menampilkan permohonan surat yang telah disetujui oleh Kepala Dusun untuk dilakukan verifikasi teknis administrasi.

---

### 12.2 Prosedur Input Wajib "Keterangan Admin"
Sebelum menyetujui pengajuan, Admin Desa **WAJIB** melengkapi kolom catatan **Keterangan Admin** (seperti *"Berkas lampiran KTP dan KK valid, foto usaha sesuai, diteruskan ke Sekdes"*).
* Keterangan Admin ini menjadi acuan evaluasi bagi Sekretaris Desa dan Kepala Desa.

---

### 12.3 Menyetujui Surat (`Disetujui Admin`)
1. Klik tombol **Setuju**.
2. Masukkan teks *Keterangan Admin*.
3. Klik **Simpan & Teruskan**. Status surat berubah menjadi **Disetujui Admin** dan otomatis masuk ke Dasbor Sekdes.

---

### 12.4 Menolak Surat (`Ditolak`)
Jika ditemukan ketidaksesuaian dokumen, Admin menekan **Tolak** dan mengisi alasan penolakan. Status berubah menjadi **Ditolak**.

[Gambar Halaman: Form Verifikasi dan Keterangan Admin]

---

## BAB XIII DASHBOARD & PERSETUJUAN SEKRETARIS DESA (SEKDES)

### 13.1 Ringkasan Dashboard Sekdes
Sekretaris Desa (Role 3) mengakses Dasbor Sekdes (`/sekretarisdesa/dashboard`) untuk memantau kelancaran administrasi desa secara makro serta memproses surat yang telah diverifikasi oleh Admin.

[Gambar Halaman: Dashboard Utama Sekretaris Desa]

---

### 13.2 Memeriksa Surat Masuk (`Disetujui Admin`)
1. Akses menu **Surat Masuk** (`/sekretarisdesa/suratmasuk`).
2. Daftar akan memuat surat-surat berstatus **Disetujui Admin**.

---

### 13.3 Meninjau Catatan Keterangan Admin
1. Klik tombol **Detail Surat**.
2. Sekdes dapat melihat rincian pemohon, lampiran dokumen, serta catatan khusus yang diinput oleh Admin Desa pada kolom **Keterangan Admin**.

---

### 13.4 Prosedur Menyetujui Surat (`Disetujui Sekretaris Desa`)
1. Setelah memeriksa draf surat dan Keterangan Admin, klik tombol **SETUJUI**.
2. Status pengajuan diperbarui menjadi **Disetujui Sekretaris Desa** dan diteruskan ke dasbor Kepala Desa untuk pengesahan TTE.

---

### 13.5 Prosedur Menolak Surat (`Ditolak`)
 Jika terdapat kesalahan format atau ketidaksesuaian aturan, klik tombol **TOLAK** dan berikan catatan alasan penolakan.

[Gambar Halaman: Form Persetujuan Sekretaris Desa]

---

## BAB XIV DASHBOARD & PERSETUJUAN KEPALA DESA (KADES)

### 14.1 Ringkasan Dashboard Kades
Dasbor Kepala Desa (Role 4) (`/kepaladesa/dashboard`) menyajikan ringkasan eksekutif persuratan desa serta pintu utama eksekusi Tanda Tangan Elektronik (TTE).

[Gambar Halaman: Dashboard Utama Kepala Desa]

---

### 14.2 Memeriksa Pengajuan (`Disetujui Sekretaris Desa`)
1. Akses menu **Surat Masuk** (`/kepaladesa/suratmasuk`).
2. Tampil daftar pengajuan berstatus **Disetujui Sekretaris Desa** yang siap disahkan secara sah.

---

### 14.3 Prosedur Pengesahan Surat & Eksekusi TTE
1. Klik tombol **Detail & Sahkan TTE**.
2. Periksa riwayat persetujuan dari Kadus, Keterangan Admin, dan Sekdes.
3. Klik tombol **SAHKAN SURAT (TTE)**.
4. Status surat berubah menjadi **Selesai** dan PDF resmi diterbitkan otomatis oleh backend.

---

### 14.4 Prosedur Menolak Pengajuan oleh Kades
Jika Kades membatalkan pengajuan, klik **TOLAK** dan masukkan catatan penolakan.

[Gambar Halaman: Tombol Pengesahan TTE Kepala Desa]

---

## BAB XV GENERATE PDF OTOMATIS DAN TANDA TANGAN ELEKTRONIK (TTE)

### 15.1 Backend Automasi PDF Engine (`GeneratePDFController`)
Saat Kepala Desa menekan tombol pengesahan, sistem memanggil backend controller `GeneratePDFController::generateAndStorePdf()`. Controller ini menyusun tata naskah dinas resmi secara dinamis berdasarkan template jenis surat.

---

### 15.2 Penyematan QR Code TTE Resmi Kades
Sistem backend menyematkan **Kode QR Tanda Tangan Elektronik (TTE)** Kepala Desa Rambipuji di bagian bawah surat. Kode QR ini berisi token validasi unik yang dapat dipindai untuk membuktikan keabsahan dokumen resmi.

---

### 15.3 Penerbitan dan Pengunduhan Dokumen PDF Resmi
* Berkas PDF resmi disimpan secara otomatis di direktori penyimpanan server (`storage/app/public/pdf_surat/`).
* Warga, Kadus, maupun Admin Desa dapat mengunduh dokumen kapan saja melalui tombol **Unduh PDF**.

[Gambar Halaman: Tampilan Hasil PDF Surat Resmi Ber-TTE]

---

## BAB XVI INTEGRASI APLIKASI MOBILE & REST API SYSTEM

### 16.1 Arsitektur REST API & Token Sanctum
Sistem Digital Village Desa Rambipuji dilengkapi dengan RESTful API berbasis Laravel Sanctum (`routes/api.php`) yang menghubungkan aplikasi mobile Android/Flutter bagi warga dan perangkat desa.

---

### 16.2 Fitur Lupa Password & OTP WhatsApp
Warga yang lupa kata sandi dapat melakukan pemulihan akun melalui aplikasi mobile:
1. Pilih menu **Lupa Password**.
2. Masukkan NIK / Nomor WhatsApp terdaftar.
3. Backend mengirimkan kode OTP unik melalui WhatsApp API.
4. Masukkan kode OTP untuk membuat password baru.

---

### 16.3 Layanan Chatbot Syarat Surat
Tersedia fitur **Chatbot Surat** (`/api/surat-chatbot`) yang menjawab pertanyaan warga secara otomatis mengenai persyaratan berkas dan tata cara pembuatan jenis surat di Desa Rambipuji.

---

### 16.4 Fitur Tracking Status & Notifikasi Realtime
Pengguna mobile mendapatkan notifikasi push/realtime serta linimasa tracking untuk mengetahui pembaruan posisi surat (Kadus -> Admin -> Sekdes -> Kades -> Selesai).

[Gambar Halaman: Tampilan Antarmuka Aplikasi Mobile Desa]

---

## BAB XVII PENGELOLAAN PENGADUAN MASYARAKAT

### 17.1 Mengakses Daftar Pengaduan Masuk
Admin Desa dapat mengelola aspirasi dan laporan warga melalui menu **Pengaduan Masyarakat** (`/admin/pengaduan`).

---

### 17.2 Membaca Detail Pengaduan dan Bukti Lampiran
1. Klik tombol **Detail Pengaduan**.
2. Tampil rincian judul laporan, identitas pelapor, isi aduan, serta bukti lampiran foto yang diunggah warga.

---

### 17.3 Memberikan Tanggapan / Feedback Admin
1. Ketikkan balasan atau langkah penanganan desa pada kolom **Tanggapan Admin**.
2. Klik tombol **Kirim Tanggapan**.
3. Balasan Admin otomatis dapat dibaca oleh warga pelapor di aplikasi/portal web.

---

### 17.4 Monitoring Status Penyelesaian Pengaduan
Admin dapat mengubah status pengaduan menjadi **Pending**, **Diproses**, atau **Selesai**.

[Gambar Halaman: Form Tanggapan Pengaduan Masyarakat]

---

## BAB XVIII MANAJEMEN LANDING PAGE

### 18.1 Mengubah Banner Utama Landing Page
1. Masuk ke menu **Kelola Website -> Banner** (`/admin/landingpage`).
2. Unggah gambar banner baru dan isi teks judul promosi/himbauan desa.
3. Klik **Simpan Perubahan Banner**.

---

### 18.2 Mengubah Informasi Profil Desa
1. Perbarui deskripsi profil, alamat kantor desa, serta email resmi.
2. Klik **Update Informasi**.

---

### 18.3 Mengubah Visi dan Misi Desa
Edit dan perbarui poin-poin Visi dan Misi Kepala Desa Rambipuji.

---

### 18.4 Mengubah Sejarah Desa
Tuliskan atau perbarui uraian ringkas sejarah berdiri Desa Rambipuji.

---

### 18.5 Mengubah Kontak dan Alamat Desa
Masukkan nomor telepon kantor, WhatsApp layanan, serta tautan koordinat Google Maps kantor desa.

---

### 18.6 Mengubah Galeri Foto Landing Page
Unggah foto-foto dokumentasi kegiatan desa untuk ditayangkan di portal publik.

[Gambar Halaman: Manajemen Landingpage Website]

---

## BAB XIX MANAJEMEN BERITA DESA

### 19.1 Menambah Berita Desa Baru
1. Akses menu **Kelola Website -> Berita**.
2. Isi Judul Berita, Kategori, Foto Utama Berita, dan Isi Artikel Berita.
3. Klik **Publikasikan Berita**.

---

### 19.2 Mengubah / Mengedit Berita Desa
Pilih berita yang ingin diperbarui dari tabel daftar berita, klik **Edit**, perbarui isinya, lalu simpan.

---

### 19.3 Menghapus Berita Desa
Klik tombol **Hapus** pada baris berita target untuk menghapus artikel dari portal.

---

### 19.4 Mempublikasikan Berita ke Portal Utama
Berita yang diterbitkan otomatis muncul di seksi **Berita Terkini** pada Landing Page publik Desa Rambipuji.

[Gambar Halaman: Form Pengelolaan Berita Desa]

---

## BAB XX LOGOUT SISTEM

### 20.1 Prosedur Logout dari Aplikasi Web
Untuk menjaga keamanan data dan mencegah akses tanpa wewenang:
1. Klik nama profil atau tombol profil pada pojok kanan atas Dasbor.
2. Klik opsi **Logout / Keluar**.
3. Sistem secara otomatis menghapus sesi (*session*) login Anda dan mengarahkan kembali ke Halaman Login Utama.

[Gambar Halaman: Prosedur Logout dari Dasbor Sistem]

---

## BAB XXI PENUTUP

### 21.1 Kesimpulan dan Harapan
Penyusunan **Manual Book Website Digital Village Desa Rambipuji** ini diharapkan dapat menjadi panduan baku bagi seluruh Perangkat Desa dan masyarakat Desa Rambipuji dalam memanfaatkan teknologi pelayanan administrasi publik digital.

Dengan pemahaman alur kerja yang baik—mulai dari tingkatan Kepala Dusun, Admin Desa, Sekretaris Desa, hingga penerbitan Tanda Tangan Elektronik oleh Kepala Desa—diharapkan pelayanan publik di Desa Rambipuji berjalan semakin cepat, efisien, transparan, serta memberikan kepuasan maksimal bagi seluruh lapisan masyarakat.

---
*Dokumen ini diterbitkan secara resmi oleh Pemerintah Desa Rambipuji, Kecamatan Rambipuji, Kabupaten Jember (2026).*
