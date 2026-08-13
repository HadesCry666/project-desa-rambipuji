# MANUAL BOOK WEBSITE DIGITAL VILLAGE DESA RAMBIPUJI
## Panduan Pengoperasian Sistem Pelayanan Administrasi Desa Berbasis Digital

---

### **COVER**

```
================================================================================

                         MANUAL BOOK WEBSITE DIGITAL VILLAGE
                                  DESA RAMBIPUJI

            Panduan Pengoperasian Sistem Pelayanan Administrasi Desa Berbasis Digital
                     Pemerintah Desa Rambipuji, Kecamatan Rambipuji
                                   Kabupaten Jember

================================================================================
```

* **Judul Dokumen**: MANUAL BOOK WEBSITE DIGITAL VILLAGE DESA RAMBIPUJI
* **Subjudul**: Panduan Pengoperasian Sistem Pelayanan Administrasi Desa Berbasis Digital
* **Instansi**: Pemerintah Desa Rambipuji, Kecamatan Rambipuji, Kabupaten Jember
* **Penyusun**: Tim Pengembang & Tim Admin Sistem Informasi Desa Rambipuji
* **Tahun Terbit**: 2026
* **Edisi**: Dokumen Resmi Panduan Aplikasi Pemerintahan (Versi 2.5)

---

### **KATA PENGANTAR**

Puji dan syukur kita panjatkan ke hadirat Allah SWT, Tuhan Yang Maha Esa, karena atas rahmat, petunjuk, dan karunia-Nya, penyusunan **Manual Book Website Digital Village Desa Rambipuji** ini dapat diselesaikan dengan baik dan tepat waktu. Dokumen ini disusun sebagai wujud komitmen Pemerintah Desa Rambipuji dalam menghadirkan tata kelola pemerintahan yang transparan, akuntabel, efisien, serta berorientasi pada pelayanan publik berkualitas tinggi berbasis teknologi informasi.

Seiring pesatnya perkembangan teknologi informasi di era digital, digitalisasi pelayanan publik di tingkat desa menjadi kebutuhan mendasar yang tidak dapat ditunda. Hadirnya Sistem Digital Village Desa Rambipuji dirancang untuk memangkas birokrasi yang berbelit-belit, mempercepat proses persuratan administrasi kependudukan, serta memudahkan interaksi antara masyarakat dan perangkat desa. Melalui buku panduan ini, diharapkan seluruh lapisan pengguna—mulai dari warga masyarakat umum, Kepala Dusun, Staff Admin Desa, Sekretaris Desa, hingga Kepala Desa—memiliki acuan kerja resmi yang jelas dan mudah dipahami.

Kami menyampaikan apresiasi dan terima kasih yang setinggi-tinggi kepada Pemerintah Desa Rambipuji, tim pengembang aplikasi, serta seluruh pihak yang telah mendukung terwujudnya sistem ini. Semoga Manual Book ini bermanfaat sebagai panduan operasional sehari-hari dan menjadi pijakan kokoh dalam mewujudkan Desa Rambipuji sebagai Desa Digital yang mandiri, sejahtera, dan berkemajuan.

Rambipuji,   2026

**Tim Pengembang & Tim Admin Digital Village Desa Rambipuji**

---

### **DAFTAR ISI**

* [COVER](#cover)
* [KATA PENGANTAR](#kata-pengantar)
* [DAFTAR ISI](#daftar-isi)
* [BAB I PENDAHULUAN](#bab-i-pendahuluan)
  * [1.1 Latar Belakang](#11-latar-belakang)
  * [1.2 Tujuan Manual Book](#12-tujuan-manual-book)
  * [1.3 Tujuan Sistem](#13-tujuan-sistem)
  * [1.4 Ruang Lingkup Sistem](#14-ruang-lingkup-sistem)
* [BAB II PENJELASAN SISTEM DIGITAL VILLAGE DESA RAMBIPUJI](#bab-ii-penjelasan-sistem-digital-village-desa-rambipuji)
  * [2.1 Gambaran Umum Sistem](#21-gambaran-umum-sistem)
  * [2.2 Landing Page Website](#22-landing-page-website)
  * [2.3 Sistem Login](#23-sistem-login)
  * [2.4 Dashboard Admin Desa](#24-dashboard-admin-desa)
  * [2.5 Master Data Penduduk](#25-master-data-penduduk)
  * [2.6 Master Kartu Keluarga](#26-master-kartu-keluarga)
  * [2.7 Master Akun RT dan RW](#27-master-akun-rt-dan-rw)
  * [2.8 Master Jenis Surat](#28-master-jenis-surat)
  * [2.9 Pengajuan Surat Oleh Warga & Kadus](#29-pengajuan-surat-oleh-warga--kadus)
  * [2.10 Persetujuan Kepala Dusun](#210-persetujuan-kepala-dusun)
  * [2.11 Verifikasi Admin Desa & Catatan Admin](#211-verifikasi-admin-desa--catatan-admin)
  * [2.12 Persetujuan Sekretaris Desa](#212-persetujuan-sekretaris-desa)
  * [2.13 Persetujuan Kepala Desa](#213-persetujuan-kepala-desa)
  * [2.14 Generate PDF dan Tanda Tangan Elektronik](#214-generate-pdf-dan-tanda-tangan-elektronik)
  * [2.15 Layanan Mobile App & REST API System](#215-layanan-mobile-app--rest-api-system)
  * [2.16 Tracking Status Surat](#216-tracking-status-surat)
  * [2.17 Pengaduan Masyarakat](#217-pengaduan-masyarakat)
  * [2.18 Manajemen Berita Desa](#218-manajemen-berita-desa)
  * [2.19 Manajemen Landing Page](#219-manajemen-landing-page)
  * [2.20 Dashboard Monitoring](#220-dashboard-monitoring)
* [PENUTUP](#penutup)

---

## BAB I PENDAHULUAN

### 1.1 Latar Belakang
Perkembangan teknologi informasi dan komunikasi yang sangat pesat telah mengubah lanskap pelayanan publik di Indonesia, termasuk di tingkat pemerintahan desa. Desa Rambipuji yang terletak di Kecamatan Rambipuji, Kabupaten Jember, merupakan salah satu wilayah yang dinamis dengan jumlah penduduk yang terus berkembang. Sebelum diimplementasikannya Sistem Digital Village, proses administrasi dan pelayanan persuratan warga masih dilakukan secara manual dan konvensional. Kondisi ini sering kali memicu berbagai hambatan operasional, seperti terbatasnya jam layanan fisik kantor desa, potensi penumpukan antrean warga, risiko kehilangan berkas fisik, serta lamanya durasi validasi dokumen karena harus menunggu ketersediaan fisik perangkat desa yang berwenang.

Pentingnya digitalisasi pelayanan administrasi desa menjadi solusi krusial dalam mengatasi keterbatasan tersebut. Melalui implementasi **Sistem Digital Village Desa Rambipuji**, Pemerintah Desa Rambipuji mengintegrasikan seluruh alur pemrosesan persuratan kependudukan ke dalam platform digital berbasis web dan mobile secara real-time. Sistem ini memungkinkan warga untuk mengajukan permohonan surat administrasi kapan saja dan dari mana saja tanpa harus hadir secara fisik pada tahap awal pengajuan. Integrasi ini juga membangun transparansi kerja perangkat desa, di mana setiap permohonan dapat dipantau posisi verifikasinya secara akurat dan objektif.

Peran Sistem Digital Village Desa Rambipuji sangat strategis dalam meningkatkan efisiensi pelayanan publik desa. Dengan menerapkan alur persetujuan berjenjang yang melibatkan Kepala Dusun, Staff Admin Desa, Sekretaris Desa, hingga penerbitan Tanda Tangan Elektronik (TTE) sah oleh Kepala Desa, rantai birokrasi dapat dipangkas secara signifikan. Efisiensi ini tidak hanya menghemat waktu dan biaya transportasi warga, tetapi juga mengoptimalkan kinerja internal perangkat desa dalam mengelola basis data kependudukan dan persuratan secara tertib, aman, dan mudah dipertanggungjawabkan.

---

### 1.2 Tujuan Manual Book
Penyusunan Manual Book ini bertujuan untuk menyediakan dokumen panduan standar (*Standard Operating Procedure*) yang komprehensif, terstruktur, dan resmi mengenai seluruh tata cara penggunaan dan pengelolaan Sistem Digital Village Desa Rambipuji. Dokumen ini disusun untuk menjamin bahwa seluruh pengguna aplikasi—baik dari kalangan masyarakat umum maupun aparatur Pemerintah Desa Rambipuji—memiliki pemahaman mendasar yang seragam terkait fitur, peran, dan alur kerja aplikasi.

Selain itu, buku panduan ini bertujuan untuk memberikan kemudahan bagi perangkat desa dalam menjalankan tugas-tugas verifikasi, validasi, pengelolaan master data kependudukan, hingga penerbitan dokumen persuratan resmi. Dengan penjelasan langkah demi langkah yang sistematis dan formal, pengguna dapat mempelajari fungsi-fungsi sistem secara mandiri tanpa menemui kesulitan teknis yang berarti.

Secara lebih luas, Manual Book ini berfungsi sebagai media transfer pengetahuan (*knowledge transfer*) yang menjamin keberlanjutan operasional aplikasi di lingkungan Pemerintah Desa Rambipuji. Jika terjadi pergantian atau rotasi personel perangkat desa di masa mendatang, buku manual ini menjadi acuan utama untuk melatih pengguna baru agar kualitas pelayanan publik berbasis digital tetap terjaga secara konsisten.

---

### 1.3 Tujuan Sistem
Pengembangan aplikasi Digital Village Desa Rambipuji pada dasarnya bertujuan untuk mentransformasi tata kelola pelayanan administrasi desa menuju ekosistem digital yang modern, responsif, dan terpadu. Sistem ini dirancang untuk menghilangkan sekat-sekat birokrasi manual yang lambat dan rentan kesalahan, sehingga masyarakat Desa Rambipuji dapat menikmati pelayanan publik yang cepat, tepat, dan mudah diakses.

Tujuan khusus dari pengembangan sistem ini meliputi otomatisasi pembuatan dokumen persuratan resmi berbasis template standar pemerintahan desa, penyediaan validasi keabsahan dokumen menggunakan QR Code Tanda Tangan Elektronik (TTE) Kepala Desa, serta pengintegrasian basis data kependudukan (NIK, Kartu Keluarga, dan Master Akun RT/RW) ke dalam satu sistem terpusat. Hal ini bertujuan untuk memastikan kelengkapan data warga serta mencegah terjadinya manipulasi atau pemalsuan berkas administrasi.

Tujuan sistem ini adalah untuk memperkuat keterbukaan informasi publik dan partisipasi warga melalui penyediaan saluran informasi resmi desa (seperti portal berita desa, visi-misi, serta informasi layanan) dan fasilitas pengaduan masyarakat (*e-complaint*). Dengan demikian, aplikasi ini menjadi sarana komunikasi dua arah yang efektif antara Pemerintah Desa Rambipuji dan seluruh elemen masyarakat.

---

### 1.4 Ruang Lingkup Sistem
Ruang lingkup aplikasi Digital Village Desa Rambipuji mencakup seluruh spektrum pelayanan administrasi dan pengelolaan data pemerintahan desa. Sistem ini dirancang multi-role yang mengomodasi lima tingkatan hak akses utama, yaitu Warga Pemohon, Kepala Dusun (Kadus), Staff Admin Desa, Sekretaris Desa (Sekdes), dan Kepala Desa (Kades). Setiap role memiliki batasan kewenangan yang jelas sesuai dengan struktur organisasi dan fungsi kerja pemerintahan desa.

Secara fungsional, modul-modul yang tersedia di dalam sistem ini meliputi:
1. **Modul Landing Page Portal Publik**: Menyajikan informasi desa, profil, visi-misi, berita terkini, dan panduan layanan surat.
2. **Modul Autentikasi dan Multi-Role Login**: Mengatur akses masuk berdasarkan NIK/Username dan peran pengguna (Role 1: Admin, Role 2: Kadus, Role 3: Sekdes, Role 4: Kades).
3. **Modul Master Data Kependudukan dan Kartu Keluarga**: Pengelolaan database warga, nomor KK, dan struktur hubungan keluarga secara dinamis.
4. **Modul Master Akun RT dan RW**: Pemetaan dan penunjukan pengurus kewilayahan RT/RW berbasis NIK terdaftar.
5. **Modul Master Jenis Surat & Persyaratan**: Pengaturan katalog layanan surat beserta berkas dokumen wajib pendukung.
6. **Modul Pengajuan Persuratan (Warga & Kadus)**: Fasilitas pembuatan permohonan surat secara mandiri atau diwakilkan oleh Kepala Dusun.
7. **Modul Verifikasi Berjenjang Multi-Role**: Pemrosesan persetujuan dari tingkat Kadus, penambahan *Keterangan Admin*, validasi Sekdes, hingga pengesahan Kades.
8. **Modul Automasi PDF dan Tanda Tangan Elektronik (TTE)**: Pembentukan file PDF resmi dan pencetakan QR Code TTE otomatis oleh sistem.
9. **Modul Integration Mobile API & OTP WA**: Layanan mobile app Sanctum, lupa password via OTP WhatsApp, dan chatbot surat.
10. **Modul Tracking Status Surat**: Fitur pelacakan progres pengajuan surat secara real-time.
11. **Modul Pengaduan Masyarakat**: Penampung laporan, keluhan, dan aspirasi warga beserta fitur tanggapan admin.
12. **Modul Manajemen Konten Website & Berita**: Pengaturan banner, artikel berita, dan informasi umum desa.
13. **Modul Dashboard Monitoring & Statistik**: Visualisasi grafik kinerja pelayanan persuratan dan statistik kependudukan.

---

## BAB II PENJELASAN SISTEM DIGITAL VILLAGE DESA RAMBIPUJI

### 2.1 Gambaran Umum Sistem
Sistem Digital Village Desa Rambipuji merupakan platform tata kelola administrasi desa terpadu yang menghubungkan masyarakat dan aparatur desa dalam satu alur kerja digital yang tertib dan transparan. Konsep Digital Village di Desa Rambipuji mengedepankan kemudahan akses pelayanan persuratan kependudukan serta kepastian hukum atas dokumen yang diterbitkan. Melalui alur terintegrasi, setiap pengajuan surat akan melewati serangkaian verifikasi bertingkat untuk menjamin keabsahan identitas warga serta kelengkapan dokumen persyaratan.

Alur pelayanan surat di dalam Sistem Digital Village Desa Rambipuji dirancang secara berjenjang sebagai berikut:

```
================================================================================
                                WARGA / KADUS
             (Mengajukan Permohonan Surat & Upload Berkas)
                                   ↓
                             KEPALA DUSUN
        (Verifikasi Awal Kewilayahan & Kecocokan Berkas Warga)
                                   ↓
                              ADMIN DESA
       (Pemeriksaan Kelengkapan Berkas & Input "Keterangan Admin")
                                   ↓
                          SEKRETARIS DESA
         (Verifikasi Administrasi & Peninjauan Catatan Admin)
                                   ↓
                             KEPALA DESA
            (Pengesahan Akhir & Eksekusi Tanda Tangan Elektronik)
                                   ↓
               GENERATE PDF + TANDA TANGAN ELEKTRONIK (TTE)
              (System Trigger Automasi Pembuatan Dokumen)
                                   ↓
                       DAPAT DIUNDUH OLEH WARGA
              (File PDF Surat Resmi Ber-TTE Siap Diterbitkan)
================================================================================
```

Secara operasional, alur di atas menjamin bahwa dokumen persuratan tidak dapat disetujui secara sepihak tanpa melalui pemeriksaan berjenjang dari pejabat berwenang. Setiap tindakan setuju maupun tolak yang dilakukan oleh Perangkat Desa terekam secara otomatis oleh sistem lengkap dengan catatan alasan (`keterangan_ditolak` / `keterangan_admin`) dan stempel waktu (*timestamp*), sehingga mewujudkan akuntabilitas pelayanan desa yang tinggi.

---

### 2.2 Landing Page Website
Landing Page Website merupakan halaman muka utama portal Digital Village Desa Rambipuji yang dapat diakses oleh publik secara bebas tanpa perlu melakukan proses login terlebih dahulu. Tampilan landing page ini didesain secara modern, elegan, dan responsif agar memberikan kesan pertama yang profesional serta memudahkan warga dalam mencari informasi awal mengenai pelayanan desa.

Halaman Landing Page terdiri dari komponen navigasi dan informasi utama, yaitu:
1. **Beranda**: Menampilkan sambutan visual (*Hero Banner*), judul utama portal, slogan Digital Village, serta tautan publikasi berita.
2. **Layanan**: Menyajikan katalog lengkap jenis-jenis surat administrasi yang disajikan oleh Desa Rambipuji beserta informasi persyaratan berkas yang harus disiapkan warga.
3. **Tentang Kami & Berita**: Menyajikan profil desa, latar belakang berdiri Desa Rambipuji, sejarah singkat, struktur organisasi, berita resmi desa, serta peta lokasi Google Maps kantor desa.
4. **Login**: Tombol navigasi langsung menuju halaman autentikasi masuk ke dasbor manajemen sistem bagi Perangkat Desa maupun pengguna terdaftar.

[Tempat Screenshot Landing Page]

---

### 2.3 Sistem Login
Sistem Login merupakan pintu gerbang utama autentikasi keamanan untuk memasuki dasbor pengoperasian aplikasi. Sistem ini menerapkan keamanan berbasis peran (*Role-Based Access Control*), di mana setiap kredensial masuk akan mengarahkan pengguna ke halaman dasbor khusus yang sesuai dengan wewenang kerjanya di Pemerintah Desa Rambipuji.

Penjelasan hak akses login berdasarkan tingkatan pengguna adalah sebagai berikut:
1. **Login Admin (Role 1)**: Mengakses seluruh modul master data (Penduduk, KK, Master Akun RT/RW, Jenis Surat), verifikasi surat masuk, pengaduan, berita, serta pengaturan landing page (`/admin/dashboard`).
2. **Login Kepala Dusun (Role 2)**: Mengakses dasbor persetujuan awal surat warga dusunnya, serta membuat pengajuan surat baru atas nama warga yang membutuhkan bantuan (`/kepaladusun/dashboard`).
3. **Login Sekretaris Desa (Role 3)**: Mengakses dasbor peninjauan surat yang telah lolos verifikasi Admin Desa (`Disetujui Admin`) untuk ditinjau kelayakan administrasinya sebelum diteruskan ke Kepala Desa (`/sekretarisdesa/dashboard`).
4. **Login Kepala Desa (Role 4)**: Mengakses dasbor pengesahan akhir (`Disetujui Sekretaris Desa`), melakukan verifikasi riwayat persetujuan lengkap, serta mengeksekusi Tanda Tangan Elektronik (TTE) pada surat (`/kepaladesa/dashboard`).

Untuk melakukan login, pengguna memasukkan **Username / NIK** dan **Password** terdaftar pada formulir autentikasi, lalu menekan tombol **Masuk**. Jika kredensial sesuai, sistem akan menampilkan pesan sukses dan melakukan pengalihan (*redirect*) otomatis ke dasbor peran pengguna. Jika kredensial salah, sistem akan menampilkan notifikasi peringatan berwarna merah.

[Tempat Screenshot Login]

---

### 2.4 Dashboard Admin Desa
Dashboard Admin Desa merupakan pusat kendali operasional bagi Staff Admin Desa setelah berhasil melakukan login ke dalam sistem. Dasbor ini dirancang intuitif dengan menampilkan kartu-kartu statistik utama yang memberikan gambaran menyeluruh mengenai kinerja dan beban kerja pelayanan persuratan desa secara *real-time*.

Empat indikator utama yang ditampilkan pada Dashboard Admin Desa meliputi:
1. **Total Pengajuan Surat**: Menampilkan akumulasi seluruh permohonan surat yang pernah masuk ke dalam sistem sejak awal operasional.
2. **Menunggu Verifikasi**: Menampilkan jumlah pengajuan surat yang saat ini sedang berada pada tahap antrean verifikasi Admin Desa (surat yang telah disetujui oleh Kepala Dusun).
3. **Surat Selesai**: Menampilkan total surat administrasi yang telah berhasil disahkan hingga tahap TTE Kepala Desa dan terbit sebagai berkas PDF resmi.
4. **Pengaduan Masuk**: Menampilkan jumlah laporan aspirasi atau pengaduan masyarakat yang memerlukan tindak lanjut dan balasan tanggapan dari Admin.

[Tempat Screenshot Dashboard Admin]

---

### 2.5 Master Data Penduduk
Master Data Penduduk merupakan modul pengelolaan pusat data kependudukan seluruh warga yang bertempat tinggal di wilayah Desa Rambipuji. Data yang tersimpan pada modul ini menjadi basis verifikasi utama untuk memastikan bahwa setiap warga yang mengajukan surat merupakan warga sah yang terdaftar di basis data kependudukan desa.

Pada modul ini, Admin Desa dan Sekretaris Desa dapat melakukan serangkaian operasi pengelolaan data meliputi:
1. **Melihat Data Penduduk**: Menampilkan tabel terstruktur yang memuat NIK, Nama Lengkap, Nomor KK, Jenis Kelamin, Tanggal Lahir, Alamat, Dusun, RT, RW, dan Status Kependudukan.
2. **Menambah Data Penduduk Baru**: Menginputkan identitas warga baru melalui formulir input yang divalidasi ketat (seperti NIK wajib 16 digit angka).
3. **Mengubah (Edit) Data Penduduk**: Memperbarui informasi kependudukan warga jika terjadi perubahan data.
4. **Menghapus Data Penduduk**: Menghapus baris data warga dengan konfirmasi dialog keamanan jika warga yang bersangkutan telah pindah atau meninggal dunia.
5. **Pencarian dan Filter**: Menyaring data warga secara cepat berdasarkan kata kunci NIK, Nama, maupun lokasi Dusun/RT/RW.

[Tempat Screenshot Data Penduduk]

---

### 2.6 Master Kartu Keluarga
Master Kartu Keluarga merupakan modul khusus yang mengelola basis data Nomor Kartu Keluarga (KK) serta struktur organisasi dalam keluarga di Desa Rambipuji. Modul ini terinterkoneksi secara otomatis dengan Master Data Penduduk untuk memastikan relasi antar anggota keluarga tercatat secara tepat.

Fungsi utama pada modul Master Kartu Keluarga meliputi:
1. **Pengelolaan Nomor KK**: Menambah, mengubah, dan menghapus registrasi No. KK 16 digit beserta identitas Nama Kepala Keluarga dan Alamat Utama.
2. **Manajemen Relasi Anggota Keluarga**: Menampilkan seluruh anggota keluarga yang bernaung di bawah satu Nomor KK tertentu (seperti Kepala Keluarga, Istri, Anak, atau Anggota Keluarga Lain).
3. **Validasi Pengajuan Persuratan**: Memudahkan perangkat desa dalam melakukan pengecekan kebenaran susunan keluarga saat warga mengajukan surat yang membutuhkan data anggota keluarga.

[Tempat Screenshot Data KK]

---

### 2.7 Master Akun RT dan RW
Master Akun RT dan RW merupakan modul pengelolaan pengurus kewilayahan di tingkat RT dan RW yang dikaitkan langsung dengan NIK penduduk terdaftar.
1. **Master Akun RW**: Mengatur penunjukan Ketua RW untuk setiap wilayah RW di Desa Rambipuji (ID RTRW otomatis format `R2026-001`).
2. **Master Akun RT**: Mengatur penunjukan Ketua RT dengan pemetaan nomor RT dan RW pengampu.
3. **Validasi Kewilayahan**: Mencegah duplikasi penunjukan Ketua RT/RW serta menjaga integrasi data saat pengurus RT/RW membantu pelayanan warga.

[Tempat Screenshot Master Akun RT/RW]

---

### 2.8 Master Jenis Surat
Master Jenis Surat merupakan modul pengaturan katalog formulir dan jenis-jenis surat administrasi yang disajikan oleh Pemerintah Desa Rambipuji kepada masyarakat. Modul ini memberikan fleksibilitas bagi Admin Desa untuk menyesuaikan jenis layanan surat sesuai dengan regulasi dan kebutuhan hukum yang berlaku.

Fungsi-fungsi yang tersedia pada modul Master Jenis Surat meliputi:
1. **Penyusunan Katalog Surat**: Menambah jenis surat baru (misalnya Surat Keterangan Usaha, Surat Keterangan Domisili, Surat Keterangan Tidak Mampu, Surat Pengantar KTP/KK).
2. **Pengaturan Format & Nomor Surat**: Mengatur penamaan surat, kode klasifikasi surat pemerintahan, serta struktur format penomoran otomatis.
3. **Pengaturan Berkas Persyaratan**: Menentukan jenis-jenis dokumen pendukung yang wajib diunggah oleh warga (`foto1` s/d `foto9`).

[Tempat Screenshot Jenis Surat]

---

### 2.9 Pengajuan Surat Oleh Warga & Kadus
Pengajuan Surat dapat dilakukan secara mandiri oleh Warga melalui aplikasi mobile / portal web, ataupun dibuatkan oleh Kepala Dusun atas nama warga:
1. **Memilih Jenis Surat**: Memilih jenis surat dari katalog layanan.
2. **Mengisi Formulir Surat**: Melengkapi data keperluan dan rincian permohonan.
3. **Upload Persyaratan**: Mengunggah berkas persyaratan wajib (Scan KTP, KK, foto lokasi, dll.).
4. **Mengirim Pengajuan**: Pengajuan terkirim dan tercatat dengan status awal **Diajukan**.

[Tempat Screenshot Pengajuan Surat]

---

### 2.10 Persetujuan Kepala Dusun
Kepala Dusun (Role 2) memverifikasi permohonan berstatus **Diajukan** dari warga di wilayah dusunnya:
1. **Menyetujui**: Menekan tombol **Setujui** sehingga status berubah menjadi **Disetujui Kepala Dusun**.
2. **Menolak**: Menekan tombol **Tolak** dan mengisi kolom **Alasan Penolakan**. Status berubah menjadi **Ditolak**.

[Tempat Screenshot Persetujuan Kadus]

---

### 2.11 Verifikasi Admin Desa & Catatan Admin
Staff Admin Desa (Role 1) melakukan verifikasi kelengkapan berkas pada permohonan berstatus **Disetujui Kepala Dusun**:
1. **Input Catatan Admin**: Admin **wajib mengisi kolom Keterangan Admin** untuk mencatat hasil evaluasi berkas.
2. **Menyetujui**: Menekan **Setujui** sehingga status berubah menjadi **Disetujui Admin** dan diteruskan ke Sekdes.
3. **Menolak**: Menekan **Tolak** jika berkas tidak valid.

[Tempat Screenshot Verifikasi Admin]

---

### 2.12 Persetujuan Sekretaris Desa
Sekretaris Desa (Role 3) meninjau kelayakan administrasi persuratan pada permohonan berstatus **Disetujui Admin**:
1. **Membaca Catatan Admin**: Meninjau rincian pengajuan dan isian `Keterangan Admin`.
2. **Menyetujui**: Menekan tombol **Setujui** sehingga status berubah menjadi **Disetujui Sekretaris Desa**.
3. **Menolak**: Menekan tombol **Tolak** jika ada draf yang tidak sesuai aturan.

[Tempat Screenshot Persetujuan Sekdes]

---

### 2.13 Persetujuan Kepala Desa
Kepala Desa (Role 4) memberikan pengesahan akhir atas permohonan berstatus **Disetujui Sekretaris Desa**:
1. **Pemeriksaan Riwayat**: Meninjau riwayat persetujuan lengkap dari Kadus, Admin, dan Sekdes.
2. **Pengesahan Akhir**: Menekan tombol **SAHKAN SURAT (TTE)**. Status berubah menjadi **Selesai**.

[Tempat Screenshot Persetujuan Kades]

---

### 2.14 Generate PDF dan Tanda Tangan Elektronik
Saat Kepala Desa memberikan pengesahan, engine backend `GeneratePDFController` secara otomatis:
1. Menyusun dokumen PDF resmi sesuai template naskah dinas.
2. Menyematkan Kode QR Tanda Tangan Elektronik (TTE) sah Kepala Desa Rambipuji.
3. Menyimpan file PDF pada server dan memperbarui status menjadi **Selesai**.

[Tempat Screenshot PDF Surat]

---

### 2.15 Layanan Mobile App & REST API System
Sistem terintegrasi dengan RESTful API berbasis Laravel Sanctum (`routes/api.php`):
1. **Autentikasi Mobile**: Login & Register warga via mobile app.
2. **Lupa Password via OTP WhatsApp**: Fitur pemulihan kata sandi instan berbasis kode OTP WhatsApp.
3. **Chatbot Surat**: Layanan informasi interaktif seputar syarat persuratan desa.
4. **Notifikasi Realtime**: Pemberitahuan otomatis perkembangan pengajuan surat warga.

[Tempat Screenshot Mobile App & API]

---

### 2.16 Tracking Status Surat
Fitur pelacakan linimasa status persuratan real-time (`Diajukan` -> `Disetujui Kepala Dusun` -> `Disetujui Admin` -> `Disetujui Sekretaris Desa` -> `Selesai` / `Ditolak`).

---

### 2.17 Pengaduan Masyarakat
Modul penerimaan keluhan, masukan, dan laporan warga dilengkapi fitur balasan **Tanggapan Admin** dan monitoring status penyelesaian laporan (*Pending*, *Diproses*, *Selesai*).

---

### 2.18 Manajemen Berita Desa
Modul pengelolaan artikel berita resmi, pengumuman, dan agenda kegiatan desa yang dipublikasikan ke portal publik.

---

### 2.19 Manajemen Landing Page
Pengaturan konten dinamis landing page meliputi Hero Banner, Profil Desa, Visi-Misi, Sejarah Desa, Kontak, dan Galeri Foto.

---

### 2.20 Dashboard Monitoring
Visualisasi grafis kinerja pelayanan persuratan dan pemetaan statistik kependudukan bagi jajaran pimpinan desa.

---

## PENUTUP

Demikian **Manual Book Website Digital Village Desa Rambipuji** ini disusun sebagai acuan kerja resmi dalam pengoperasian dan pengelolaan Sistem Pelayanan Administrasi Desa Berbasis Digital di Desa Rambipuji, Kecamatan Rambipuji, Kabupaten Jember. Hadirnya dokumen panduan ini diharapkan dapat memberikan pemahaman yang mendalam, jelas, dan sistematis bagi seluruh tingkatan pengguna—baik masyarakat umum maupun seluruh jajaran perangkat desa.

Dengan diimplementasikannya alur verifikasi persuratan berjenjang yang aman—mulai dari tingkat Kepala Dusun, Staff Admin Desa, Sekretaris Desa, hingga penerbitan Tanda Tangan Elektronik (TTE) sah oleh Kepala Desa—diharapkan tata kelola pelayanan publik di Desa Rambipuji dapat berjalan dengan lebih cepat, efisien, transparan, dan akuntabel. Transformasi digital ini menjadi bukti nyata komitmen Pemerintah Desa Rambipuji dalam menghadirkan pelayanan terbaik yang berorientasi pada kepuasan masyarakat.

---
*Dokumen Resmi Pemerintah Desa Rambipuji, Kecamatan Rambipuji, Kabupaten Jember (2026).*
