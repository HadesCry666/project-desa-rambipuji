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
* **Edisi**: Dokumen Resmi Panduan Aplikasi Pemerintahan (Versi 2.0)

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
  * [2.7 Master Jenis Surat](#27-master-jenis-surat)
  * [2.8 Pengajuan Surat Oleh Warga](#28-pengajuan-surat-oleh-warga)
  * [2.9 Persetujuan Kepala Dusun](#29-persetujuan-kepala-dusun)
  * [2.10 Pengajuan Surat Oleh Kepala Dusun](#210-pengajuan-surat-oleh-kepala-dusun)
  * [2.11 Verifikasi Admin Desa](#211-verifikasi-admin-desa)
  * [2.12 Persetujuan Sekretaris Desa](#212-persetujuan-sekretaris-desa)
  * [2.13 Persetujuan Kepala Desa](#213-persetujuan-kepala-desa)
  * [2.14 Generate PDF dan Tanda Tangan Elektronik](#214-generate-pdf-dan-tanda-tangan-elektronik)
  * [2.15 Tracking Status Surat](#215-tracking-status-surat)
  * [2.16 Pengaduan Masyarakat](#216-pengaduan-masyarakat)
  * [2.17 Manajemen Berita](#217-manajemen-berita)
  * [2.18 Manajemen Landing Page](#218-manajemen-landing-page)
  * [2.19 Dashboard Monitoring](#219-dashboard-monitoring)
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

Tujuan khusus dari pengembangan sistem ini meliputi otomatisasi pembuatan dokumen persuratan resmi berbasis template standar pemerintahan desa, penyediaan validasi keabsahan dokumen menggunakan QR Code Tanda Tangan Elektronik (TTE) Kepala Desa, serta pengintegrasian basis data kependudukan (NIK dan Kartu Keluarga) ke dalam satu sistem terpusat. Hal ini bertujuan untuk memastikan kelengkapan data warga serta mencegah terjadinya manipulasi atau pemalsuan berkas administrasi.

Tujuan sistem ini adalah untuk memperkuat keterbukaan informasi publik dan partisipasi warga melalui penyediaan saluran informasi resmi desa (seperti portal berita desa, visi-misi, serta informasi layanan) dan fasilitas pengaduan masyarakat (*e-complaint*). Dengan demikian, aplikasi ini menjadi sarana komunikasi dua arah yang efektif antara Pemerintah Desa Rambipuji dan seluruh elemen masyarakat.

---

### 1.4 Ruang Lingkup Sistem
Ruang lingkup aplikasi Digital Village Desa Rambipuji mencakup seluruh spektrum pelayanan administrasi dan pengelolaan data pemerintahan desa. Sistem ini dirancang multi-role yang mengomodasi lima tingkatan hak akses utama, yaitu Warga Pemohon, Kepala Dusun (Kadus), Staff Admin Desa, Sekretaris Desa (Sekdes), dan Kepala Desa (Kades). Setiap role memiliki batasan kewenangan yang jelas sesuai dengan struktur organisasi dan fungsi kerja pemerintahan desa.

Secara fungsional, modul-modul yang tersedia di dalam sistem ini meliputi:
1. **Modul Landing Page Portal Publik**: Menyajikan informasi desa, profil, visi-misi, berita terkini, dan panduan layanan surat.
2. **Modul Autentikasi dan Multi-Role Login**: Mengatur akses masuk berdasarkan NIK/Username dan peran pengguna.
3. **Modul Master Data Kependudukan dan Kartu Keluarga**: Pengelolaan database warga, nomor KK, dan struktur hubungan keluarga secara dinamis.
4. **Modul Master Jenis Surat & Persyaratan**: Pengaturan katalog layanan surat beserta berkas dokumen wajib pendukung.
5. **Modul Pengajuan Persuratan (Warga & Kadus)**: Fasilitas pembuatan permohonan surat secara mandiri atau diwakilkan oleh Kepala Dusun.
6. **Modul Verifikasi Berjenjang Multi-Role**: Pemrosesan persetujuan dari tingkat Kadus, penambahan *Keterangan Admin*, validasi Sekdes, hingga pengesahan Kades.
7. **Modul Automasi PDF dan Tanda Tangan Elektronik (TTE)**: Pembentukan file PDF resmi dan pencetakan QR Code TTE otomatis oleh sistem.
8. **Modul Tracking Status Surat**: Fitur pelacakan progres pengajuan surat secara real-time.
9. **Modul Pengaduan Masyarakat**: Penampung laporan, keluhan, dan aspirasi warga beserta fitur tanggapan admin.
10. **Modul Manajemen Konten Website & Berita**: Pengaturan banner, artikel berita, dan informasi umum desa.
11. **Modul Dashboard Monitoring & Statistik**: Visualisasi grafik kinerja pelayanan persuratan dan statistik kependudukan.

---

## BAB II PENJELASAN SISTEM DIGITAL VILLAGE DESA RAMBIPUJI

### 2.1 Gambaran Umum Sistem
Sistem Digital Village Desa Rambipuji merupakan platform tata kelola administrasi desa terpadu yang menghubungkan masyarakat dan aparatur desa dalam satu alur kerja digital yang tertib dan transparan. Konsep Digital Village di Desa Rambipuji mengedepankan kemudahan akses pelayanan persuratan kependudukan serta kepastian hukum atas dokumen yang diterbitkan. Melalui alur terintegrasi, setiap pengajuan surat akan melewati serangkaian verifikasi bertingkat untuk menjamin keabsahan identitas warga serta kelengkapan dokumen persyaratan.

Alur pelayanan surat di dalam Sistem Digital Village Desa Rambipuji dirancang secara berjenjang sebagai berikut:

```
================================================================================
                                WARGA
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
              GENERATE PDF + TANDA TANGAN ELEKTRONIK
             (System Trigger Automasi Pembuatan Dokumen)
                                  ↓
                      DAPAT DIUNDUH OLEH WARGA
             (File PDF Surat Resmi Ber-TTE Siap Diterbitkan)
================================================================================
```

Secara operasional, alur di atas menjamin bahwa dokumen persuratan tidak dapat disetujui secara sepihak tanpa melalui pemeriksaan berjenjang dari pejabat berwenang. Setiap tindakan setuju maupun tolak yang dilakukan oleh Perangkat Desa terekam secara otomatis oleh sistem lengkap dengan catatan alasan dan stempel waktu (*timestamp*), sehingga mewujudkan akuntabilitas pelayanan desa yang tinggi.

---

### 2.2 Landing Page Website
Landing Page Website merupakan halaman muka utama portal Digital Village Desa Rambipuji yang dapat diakses oleh publik secara bebas tanpa perlu melakukan proses login terlebih dahulu. Tampilan landing page ini didesain secara modern, elegan, dan responsif agar memberikan kesan pertama yang profesional serta memudahkan warga dalam mencari informasi awal mengenai pelayanan desa.

Halaman Landing Page terdiri dari empat komponen navigasi dan informasi utama, yaitu:
1. **Beranda**: Menampilkan sambutan visual (*Hero Banner*), judul utama portal, slogan Digital Village, serta opsi unduh aplikasi mobile APK Desa Rambipuji.
2. **Layanan**: Menyajikan katalog lengkap jenis-jenis surat administrasi yang disajikan oleh Desa Rambipuji beserta informasi persyaratan berkas yang harus disiapkan warga.
3. **Tentang Kami**: Menyajikan profil desa, latar belakang berdiri Desa Rambipuji, sejarah singkat, struktur organisasi, serta peta lokasi Google Maps kantor desa.
4. **Login**: Tombol navigasi langsung menuju halaman autentikasi masuk ke dasbor manajemen sistem bagi Perangkat Desa maupun pengguna terdaftar.

[Tempat Screenshot Landing Page]

---

### 2.3 Sistem Login
Sistem Login merupakan pintu gerbang utama autentikasi keamanan untuk memasuki dasbor pengoperasian aplikasi. Sistem ini menerapkan keamanan berbasis peran (*Role-Based Access Control*), di mana setiap kredensial masuk akan mengarahkan pengguna ke halaman dasbor khusus yang sesuai dengan wewenang kerjanya di Pemerintah Desa Rambipuji.

Penjelasan hak akses login berdasarkan tingkatan pengguna adalah sebagai berikut:
1. **Login Admin (Role 1)**: Mengakses seluruh modul master data (Penduduk, KK, Jenis Surat), verifikasi surat masuk, pengelolaan pengaduan, berita, serta pengaturan landing page.
2. **Login Kepala Dusun (Role 2)**: Mengakses dasbor persetujuan awal surat warga dusunnya, serta membuat pengajuan surat baru atas nama warga yang membutuhkan bantuan.
3. **Login Sekretaris Desa (Role 3)**: Mengakses dasbor peninjauan surat yang telah lolos verifikasi Admin Desa untuk ditinjau kelayakan administrasinya sebelum diteruskan ke Kepala Desa.
4. **Login Kepala Desa (Role 4)**: Mengakses dasbor pengesahan akhir, melakukan verifikasi riwayat persetujuan lengkap, serta mengeksekusi Tanda Tangan Elektronik (TTE) pada surat.

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

Selain kartu statistik, dasbor ini dilengkapi dengan navigasi sidebar lengkap yang memudahkan Admin untuk beralih antar modul pengelolaan master data dan konten portal desa.

[Tempat Screenshot Dashboard Admin]

---

### 2.5 Master Data Penduduk
Master Data Penduduk merupakan modul pengelolaan pusat data kependudukan seluruh warga yang bertempat tinggal di wilayah Desa Rambipuji. Data yang tersimpan pada modul ini menjadi basis verifikasi utama untuk memastikan bahwa setiap warga yang mengajukan surat merupakan warga sah yang terdaftar di basis data kependudukan desa.

Pada modul ini, Admin Desa dan Sekretaris Desa dapat melakukan serangkaian operasi pengelolaan data meliputi:
1. **Melihat Data Penduduk**: Menampilkan tabel terstruktur yang memuat NIK, Nama Lengkap, Nomor KK, Jenis Kelamin, Tanggal Lahir, Alamat, Dusun, RT, RW, dan Status Kependudukan.
2. **Menambah Data Penduduk Baru**: Menginputkan identitas warga baru melalui formulir input yang divalidasi ketat (seperti NIK wajib 16 digit angka).
3. **Mengubah (Edit) Data Penduduk**: Memperbarui informasi kependudukan warga jika terjadi perubahan data (misalnya perubahan status perkawinan atau pekerjaan).
4. **Menghapus Data Penduduk**: Menghapus baris data warga dengan konfirmasi dialog keamanan jika warga yang bersangkutan telah pindah atau meninggal dunia.
5. **Pencarian dan Filter**: Menyaring data warga secara cepat berdasarkan kata kunci NIK, Nama, maupun lokasi Dusun/RT/RW.

[Tempat Screenshot Data Penduduk]

---

### 2.6 Master Kartu Keluarga
Master Kartu Keluarga merupakan modul khusus yang mengelola basis data Nomor Kartu Keluarga (KK) serta struktur organisasi dalam keluarga di Desa Rambipuji. Modul ini terinterkoneksi secara otomatis dengan Master Data Penduduk untuk memastikan relasi antar anggota keluarga tercatat secara tepat.

Fungsi utama pada modul Master Kartu Keluarga meliputi:
1. **Pengelolaan Nomor KK**: Menambah, mengubah, dan menghapus registrasi No. KK 16 digit beserta identitas Nama Kepala Keluarga dan Alamat Utama.
2. **Manajemen Relasi Anggota Keluarga**: Menampilkan seluruh anggota keluarga yang bernaung di bawah satu Nomor KK tertentu (seperti Kepala Keluarga, Istri, Anak, atau Anggota Keluarga Lain).
3. **Validasi Pengajuan Persuratan**: Memudahkan perangkat desa dalam melakukan pengecekan kebenaran susunan keluarga saat warga mengajukan surat yang membutuhkan data anggota keluarga (seperti Surat Keterangan Kelahiran, Surat Kematian, atau SKTM Keluarga).

[Tempat Screenshot Data KK]

---

### 2.7 Master Jenis Surat
Master Jenis Surat merupakan modul pengaturan katalog formulir dan jenis-jenis surat administrasi yang disajikan oleh Pemerintah Desa Rambipuji kepada masyarakat. Modul ini memberikan fleksibilitas bagi Admin Desa untuk menyesuaikan jenis layanan surat sesuai dengan regulasi dan kebutuhan hukum yang berlaku.

Fungsi-fungsi yang tersedia pada modul Master Jenis Surat meliputi:
1. **Penyusunan Katalog Surat**: Menambah jenis surat baru (misalnya Surat Keterangan Usaha, Surat Keterangan Domisili, Surat Keterangan Tidak Mampu, Surat Pengantar KTP/KK).
2. **Pengaturan Format & Nomor Surat**: Mengatur penamaan surat, kode klasifikasi surat pemerintahan, serta struktur format penomoran otomatis.
3. **Pengaturan Berkas Persyaratan**: Menentukan jenis-jenis dokumen pendukung yang wajib diunggah oleh warga saat mengajukan surat tersebut (seperti wajib mengunggah scan KTP, scan KK, atau Foto Tempat Usaha).

[Tempat Screenshot Jenis Surat]

---

### 2.8 Pengajuan Surat Oleh Warga
Pengajuan Surat oleh Warga merupakan proses awal di mana masyarakat pemohon mengajukan permohonan surat administrasi secara mandiri melalui aplikasi mobile ataupun portal web. Prosedur ini dirancang sangat mudah agar dapat dioperasikan oleh warga dari berbagai tingkatan umur dan latar belakang.

Langkah-langkah pengajuan surat oleh warga adalah sebagai berikut:
1. **Memilih Jenis Surat**: Warga masuk ke menu pengajuan dan memilih jenis surat yang dibutuhkan dari daftar katalog layanan.
2. **Mengisi Formulir Surat**: Warga melengkapi kolom-kolom data pada formulir pengajuan (seperti keperluan pembuatan surat, alamat tujuan, atau rincian keterangan khusus).
3. **Upload Persyaratan**: Warga mengunggah foto atau scan dokumen persyaratan yang diminta oleh sistem (format file JPG, PNG, atau PDF) melalui tombol unggah berkas.
4. **Mengirim Pengajuan**: Warga memeriksa kembali kebenaran isian data, kemudian menekan tombol **Kirim Pengajuan**. Pengajuan surat otomatis tercatat di sistem dengan status awal **Diajukan**.

[Tempat Screenshot Pengajuan Surat]

---

### 2.9 Persetujuan Kepala Dusun
Persetujuan Kepala Dusun merupakan tahap verifikasi pertama di tingkat kewilayahan setelah permohonan surat dikirim oleh warga. Kepala Dusun (Kadus) bertugas memastikan bahwa pemohon memang benar merupakan warga yang berdomisili di dusunnya serta permohonan yang diajukan sesuai dengan kondisi riil di lapangan.

Tata cara pemrosesan persetujuan oleh Kepala Dusun meliputi:
1. **Melihat Pengajuan Warga**: Kadus mengakses menu *Surat Masuk* untuk melihat daftar permohonan berstatus **Diajukan** dari warga di wilayah dusunnya.
2. **Menyetujui Pengajuan**: Jika data pemohon dan berkas pendukung sudah benar dan valid, Kadus menekan tombol **Setujui**. Status surat otomatis berubah menjadi **Disetujui Kepala Dusun** dan diteruskan ke antrean Admin Desa.
3. **Menolak Pengajuan & Alasan Penolakan**: Jika berkas tidak lengkap atau data tidak sesuai, Kadus menekan tombol **Tolak**, kemudian **wajib mengisi Alasan Penolakan** (misalnya: "Foto KTP tidak terbaca jelas, mohon unggah ulang"). Status surat berubah menjadi **Ditolak**.

[Tempat Screenshot Persetujuan Kadus]

---

### 2.10 Pengajuan Surat Oleh Kepala Dusun
Pengajuan Surat oleh Kepala Dusun merupakan fitur asistensi khusus yang disediakan untuk membantu warga masyarakat yang mengalami kendala akses teknologi, tidak memiliki smartphone, atau warga lanjut usia. Melalui fitur ini, Kepala Dusun dapat membuatkan pengajuan surat atas nama warga pemohon secara langsung dari dasbor Kadus.

Prosedur pengajuan surat atas nama warga oleh Kadus adalah sebagai berikut:
1. **Memilih NIK Warga**: Kadus membuka menu *Tambah Pengajuan*, lalu mencari dan memilih NIK/Nama Warga pemohon dari daftar pemilih kependudukan terintegrasi.
2. **Memilih Anggota Keluarga**: Jika jenis surat memerlukan data anggota keluarga tertentu, Kadus memilih nama anggota keluarga yang bersangkutan dari pilihan relasi KK.
3. **Membuat Pengajuan atas Nama Warga**: Kadus mengisi formulir keperluan surat, mengunggah dokumen persyaratan fisik yang diserahkan warga, lalu menekan tombol **Kirim Pengajuan**. Surat otomatis masuk ke alur verifikasi sistem.

[Tempat Screenshot Form Pengajuan Kadus]

---

### 2.11 Verifikasi Admin Desa
Verifikasi Admin Desa merupakan tahap verifikasi kedua di mana Staff Admin Desa melakukan pengulasan mendalam terhadap kelengkapan berkas administrasi dan kebenaran format data sebelum surat diteruskan ke tingkatan pimpinan desa.

Pada tahap ini, Admin Desa menjalankan prosedur kerja sebagai berikut:
1. **Memeriksa Surat Masuk**: Admin membuka daftar permohonan berstatus **Disetujui Kepala Dusun**.
2. **Mengulas Berkas Lampiran**: Admin memeriksa kejelasan foto lampiran KTP, KK, serta kesesuaian isian form dengan aturan penulisan persuratan resmi.
3. **Input "Keterangan Admin"**: Admin **wajib mengisi kolom Keterangan Admin** (misalnya: "Berkas lampiran KTP dan KK valid, siap diproses ke Sekdes").
4. **Menyetujui atau Menolak**: Admin menekan tombol **Setujui** sehingga status berubah menjadi **Disetujui Admin**, atau menekan **Tolak** jika ditemukan ketidaksesuaian berkas.

[Tempat Screenshot Verifikasi Admin]

---

### 2.12 Persetujuan Sekretaris Desa
Persetujuan Sekretaris Desa merupakan tahap verifikasi ketiga yang berfokus pada pengawasan mutu hukum dan kelayakan administrasi persuratan desa secara makro. Sekretaris Desa (Sekdes) memastikan bahwa kraf surat yang telah diverifikasi oleh Admin telah memenuhi standar regulasi tata naskah dinas pemerintahan desa.

Prosedur persetujuan pada dasbor Sekretaris Desa meliputi:
1. **Meninjau Pengajuan**: Sekdes mengakses menu *Surat Masuk* yang menampilkan permohonan berstatus **Disetujui Admin**.
2. **Melihat Catatan Keterangan Admin**: Sekdes membaca rincian pengajuan beserta catatan evaluasi yang ditinggalkan oleh Admin Desa pada kolom *Keterangan Admin*.
3. **Eksekusi Persetujuan**: Jika Sekdes menilai draf surat telah memenuhi syarat, Sekdes menekan tombol **Setujui**. Status surat otomatis diperbarui menjadi **Disetujui Sekretaris Desa** dan diteruskan ke dasbor Kepala Desa untuk pengesahan akhir.

[Tempat Screenshot Persetujuan Sekretaris Desa]

---

### 2.13 Persetujuan Kepala Desa
Persetujuan Kepala Desa merupakan tahap puncak (*final approval*) dari alur pelayanan persuratan di Desa Rambipuji. Kepala Desa (Kades) bertindak sebagai pejabat penandatangan resmi yang memberikan pengesahan hukum atas surat administrasi yang diajukan oleh warga.

Pada modul ini, Kepala Desa melakukan langkah-langkah kerja sebagai berikut:
1. **Pemeriksaan Riwayat Lengkap**: Kades membuka pengajuan berstatus **Disetujui Sekretaris Desa** dan meninjau riwayat persetujuan lengkap dari Kadus, Admin, dan Sekdes.
2. **Pengesahan Akhir**: Jika seluruh tahapan telah sesuai, Kades menekan tombol **Sahkan Surat (TTE)**.
3. **Tindakan Penolakan**: Jika Kades menemukan pertimbangan khusus untuk membatalkan surat, Kades dapat menekan tombol **Tolak** disertai pengisian catatan penolakan.

[Tempat Screenshot Persetujuan Kepala Desa]

---

### 2.14 Generate PDF dan Tanda Tangan Elektronik
Generate PDF dan Tanda Tangan Elektronik (TTE) merupakan proses automasi sistem backend (*GeneratePDFController*) yang terpicu secara instan pada saat Kepala Desa menekan tombol pengesahan surat. Fitur ini menjamin bahwa dokumen yang dihasilkan memiliki format resmi yang seragam dan dilindungi oleh pengesahan digital yang valid.

Proses teknis yang berlangsung pada tahap ini meliputi:
1. **Surat Disetujui Kepala Desa**: Sinyal persetujuan Kades diterima oleh sistem secara real-time.
2. **Sistem Otomatis Membuat PDF**: Engine sistem mengompilasi data pemohon, jenis surat, nomor registrasi resmi, dan tata naskah ke dalam dokumen berformat PDF bermutu tinggi.
3. **Sistem Otomatis Menambahkan TTE**: Sistem menyematkan Kode QR Tanda Tangan Elektronik (TTE) sah Kepala Desa Rambipuji pada bagian kaki surat sebagai bukti keabsahan hukum.
4. **Surat Dapat Diunduh Warga**: Status pengajuan otomatis diperbarui menjadi **Selesai**, dan berkas PDF disimpan pada direktori penyimpanan server yang aman sehingga siap diunduh oleh warga.

[Tempat Screenshot PDF Surat]

---

### 2.15 Tracking Status Surat
Tracking Status Surat merupakan fitur transparansi publik yang memungkinkan warga pemohon maupun perangkat desa untuk memantau tahapan posisi pemrosesan surat secara real-time. Fitur ini menghapuskan ketidakpastian warga mengenai lama waktu pengurusan surat di kantor desa.

Seluruh rentang status yang dapat dilacak pada sistem meliputi:
1. **Diajukan**: Permohonan surat baru saja dikirim dan menunggu verifikasi Kepala Dusun.
2. **Disetujui Kepala Dusun**: Surat telah divalidasi oleh Kadus dan masuk ke antrean Admin Desa.
3. **Disetujui Admin**: Admin telah memeriksa berkas, mengisi *Keterangan Admin*, dan meneruskan ke Sekdes.
4. **Disetujui Sekretaris Desa**: Sekdes telah memverifikasi surat dan meneruskannya ke Kepala Desa.
5. **Disetujui Kepala Desa**: Kades telah memberikan persetujuan akhir.
6. **Selesai**: Dokumen PDF resmi ber-TTE telah diterbitkan dan siap diunduh.
7. **Ditolak**: Pengajuan ditolak pada salah satu tahap verifikasi beserta rincian alasan penolakannya.

[Tempat Screenshot Tracking]

---

### 2.16 Pengaduan Masyarakat
Pengaduan Masyarakat merupakan modul komunikasi publik yang berfungsi sebagai sarana penampung aspirasi, keluhan, masukan, dan laporan warga terkait pelayanan desa maupun kondisi fasilitas di lingkungan Desa Rambipuji.

Pengelolaan modul Pengaduan Masyarakat meliputi:
1. **Pengaduan Masuk dari Warga**: Menampilkan daftar laporan baru yang dikirim oleh warga lengkap dengan judul aduan, isi laporan, tanggal pengiriman, dan foto bukti pendukung.
2. **Peninjauan Detail Aduan**: Admin dan Perangkat Desa dapat membaca rincian keluhan warga serta memeriksa foto bukti lokasi/kejadian.
3. **Pemberian Tanggapan (Feedback)**: Admin menginputkan jawaban atau penanganan resmi desa pada kolom *Tanggapan Admin* yang dapat dibaca kembali oleh warga pelapor.
4. **Monitoring Status**: Mengubah status pengaduan menjadi *Pending*, *Diproses*, atau *Selesai* untuk menjamin penyelesaian laporan yang akuntabel.

[Tempat Screenshot Pengaduan]

---

### 2.17 Manajemen Berita
Manajemen Berita merupakan modul pengelolaan publikasi artikel berita, pengumuman, dan agenda kegiatan resmi Pemerintah Desa Rambipuji. Modul ini bertujuan untuk menyajikan sumber informasi yang tepercaya bagi masyarakat luas mengenai perkembangan dan prestasi desa.

Fungsi-fungsi utama pada modul Manajemen Berita meliputi:
1. **Menambah Berita Baru**: Admin menginputkan Judul Berita, Kategori, Foto Utama Berita, dan Isi Artikel Berita melalui editor teks yang ramah pengguna.
2. **Mengubah dan Menghapus Berita**: Memperbarui isi artikel jika terdapat penyesuaian informasi atau menghapus berita yang tidak relevan.
3. **Publikasi ke Portal Utama**: Berita yang diterbitkan oleh Admin secara otomatis tampil pada seksi *Berita Terkini* di halaman depan Landing Page publik.

[Tempat Screenshot Berita]

---

### 2.18 Manajemen Landing Page
Manajemen Landing Page merupakan modul pengaturan konten dinamis yang memungkinkan Admin Desa untuk memperbarui tampilan teks dan media gambar pada halaman depan portal web tanpa harus mengubah kode pemrograman aplikasi.

Fasilitas pengubahan pada modul ini meliputi:
1. **Pengaturan Banner Utama**: Mengubah gambar hero carousel banner, judul utama sambutan, dan deskripsi singkat portal.
2. **Pengaturan Informasi Profil Desa**: Memperbarui deskripsi profil desa, alamat kantor, email resmi, dan nomor telepon kontak desa.
3. **Pengaturan Visi dan Misi**: Mengedit rincian poin-poin Visi dan Misi Kepala Desa Rambipuji.
4. **Pengaturan Sejarah & Galeri**: Memperbarui artikel sejarah berdiri desa serta mengunggah foto-foto dokumentasi kegiatan desa pada galeri publik.

[Tempat Screenshot Pengaturan Landing Page]

---

### 2.19 Dashboard Monitoring
Dashboard Monitoring merupakan modul analisis data bagi jajaran pimpinan Pemerintah Desa Rambipuji (Kepala Desa, Sekretaris Desa, dan Admin) untuk memantau performa pelayanan publik dan perkembangan kependudukan secara menyeluruh.

Fitur yang tersedia pada Dashboard Monitoring mencakup:
1. **Visualisasi Grafis Pelayanan**: Menampilkan grafik jumlah pengajuan surat per bulan, tingkat penyelesaian persuratan, serta rata-rata durasi pemrosesan surat.
2. **Statistik Kependudukan**: Menyajikan pemetaan rasio jumlah penduduk berdasarkan jenis kelamin, sebaran warga per dusun, serta kelompok umur.
3. **Evaluasi Kinerja Layanan**: Membantu pimpinan desa dalam mengambil keputusan berbasis data (*data-driven decision making*) untuk meningkatkan kualitas pelayanan publik di Desa Rambipuji.

[Tempat Screenshot Dashboard Monitoring]

---

## PENUTUP

Demikian **Manual Book Website Digital Village Desa Rambipuji** ini disusun sebagai acuan kerja resmi dalam pengoperasian dan pengelolaan Sistem Pelayanan Administrasi Desa Berbasis Digital di Desa Rambipuji, Kecamatan Rambipuji, Kabupaten Jember. Hadirnya dokumen panduan ini diharapkan dapat memberikan pemahaman yang mendalam, jelas, dan sistematis bagi seluruh tingkatan pengguna—baik masyarakat umum maupun seluruh jajaran perangkat desa.

Dengan diimplementasikannya alur verifikasi persuratan berjenjang yang aman—mulai dari tingkat Kepala Dusun, Staff Admin Desa, Sekretaris Desa, hingga penerbitan Tanda Tangan Elektronik (TTE) sah oleh Kepala Desa—diharapkan tata kelola pelayanan publik di Desa Rambipuji dapat berjalan dengan lebih cepat, efisien, transparan, dan akuntabel. Transformasi digital ini menjadi bukti nyata komitmen Pemerintah Desa Rambipuji dalam menghadirkan pelayanan terbaik yang berorientasi pada kepuasan masyarakat.

Buku manual ini dirancang agar siap digunakan dan dipindahkan langsung ke dalam Microsoft Word sebagai dokumen panduan resmi pemerintahan desa. Harapan kami, seluruh pihak dapat memanfaatkan panduan ini secara optimal serta bersama-sama menjaga keberlanjutan dan keamanan penggunaan Sistem Digital Village Desa Rambipuji demi terwujudnya tata kelola desa digital yang mandiri, modern, dan berkemajuan.

---
*Dokumen Resmi Pemerintah Desa Rambipuji, Kecamatan Rambipuji, Kabupaten Jember (2026).*
