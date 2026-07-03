# Product Requirement Document (PRD)
## Sistem Informasi Kursus Hobi (Hobby Course Platform)

---

## 1. Project Overview & Context

### 1.1 Latar Belakang
Sistem Kursus Hobi adalah sebuah platform digital terintegrasi berbasis web yang dirancang khusus untuk memfasilitasi pencarian, pendaftaran, dan pembelajaran berbagai bidang hobi secara terstruktur. Platform ini menjembatani kebutuhan masyarakat yang ingin mengembangkan minat bakat khusus (seperti musik, fotografi, memasak, rajut, dll.) secara fleksibel, baik melalui metode tatap muka langsung (Offline) maupun pembelajaran digital mandiri (Online).

### 1.2 Tujuan Proyek
* Menyediakan platform katalog kursus hobi yang interaktif, informatif, dan mudah diakses.
* Menyederhanakan alur registrasi, transaksi pembayaran manual, dan pelacakan riwayat pembelajaran bagi peserta.
* Menyediakan panel manajemen data yang efisien bagi administrator untuk mengontrol katalog, memvalidasi transaksi, serta mendistribusikan sertifikat kelulusan.
---

## 2. Tech Stack & Engineering Standard

Untuk menjaga performa, kesederhanaan arsitektur, dan kemudahan dalam pengembangan berskala lokal/proyek kampus, arsitektur monolith web klasik dipilih dengan spesifikasi teknis berikut:

* **Frontend Layout & Styling:** TailwindCSS (atau Custom CSS Modern) untuk komponen visual yang responsif.
* **Frontend Scripting:** Vanilla JavaScript untuk manajemen state UI, filter interaktif, pemutar video, dan toggle tema.
* **Backend Core Engine:** PHP (Native atau Framework berbasis MVC seperti Laravel) untuk pemrosesan logika bisnis server-side.
* **Database System:** MySQL 8.0+ untuk penyimpanan data relasional terstruktur.
* **Theme Switching:** Client-side LocalStorage / Session state syncing untuk deteksi preferensi Mode Terang (Light Mode) dan Mode Gelap (Dark Mode).

---

## 3. Role Architecture & Access Control

Sistem ini menerapkan prinsip **RBAC (Role-Based Access Control)** yang ketat dan efisien, hanya membagi hak akses ke dalam **2 Aktor Utama** yang memiliki kredensial login:

### 3.1 Admin (Administrator)
* Hak akses penuh terhadap modul administrasi sistem back-end.
* Mengelola (CRUD) Kategori Hobi, Data Kursus, Data Instruktur, dan Jadwal/Lokasi Kursus.
* Memiliki wewenang mutlak untuk melakukan validasi/verifikasi berkas bukti transfer pembayaran peserta.
* Melakukan penandaan (*flagging*) kelulusan peserta dan pengiriman sertifikat manual.

### 3.2 Peserta (User)
* Hak akses halaman front-end publik dan dashboard personal setelah melakukan autentikasi.
* Menjelajahi katalog, menyaring data, mendaftar ke kursus, mengunggah bukti pembayaran, mengakses materi belajar, dan memberikan ulasan/rating.

### 3.3 Catatan Penting Batasan Sistem (Constraints)
* **Instruktur TIDAK MEMILIKI Akun atau Hak Akses Login Tersendiri.** Data instruktur diinput dan dikelola secara mutlak oleh Admin. Instruktur murni diposisikan sebagai objek informasi pengajar yang dilekatkan pada detail kursus guna memberikan transparansi kualitas kepada calon peserta.

---

## 4. Authentication Module

Sistem pendaftaran dan masuk pengguna menggunakan validasi server-side dan session management yang aman.

### 4.1 Fitur Autentikasi
* **Register Akun:** Peserta menginputkan Nama Lengkap, Email unik, Nomor Telepon, Kata Sandi, Konfirmasi Kata Sandi, serta mengunggah Foto Profil/Avatar (Opsional).
* **Login Sistem:** Autentikasi menggunakan kombinasi Email dan Password. Sistem secara otomatis mendeteksi *role_id* pengguna untuk melakukan pengalihan rute (*redirect routing*) secara aman: Admin ke Panel Dashboard Admin, Peserta ke Dashboard User.
* **Logout Sistem:** Penghancuran data session aktif dan pengembalian pengguna ke halaman beranda publik secara aman.

---

## 5. Landing Page & Publik Interface Specification

Desain antarmuka publik berfokus pada kemudahan konversi pengunjung menjadi pendaftar aktif, dengan dukungan penuh penyesuaian kontras tinggi antara mode gelap dan terang.

### 5.1 Komponen Navbar (Navigasi Atas)
* **Identitas Visual:** Logo Sistem Kursus Hobi di sisi kiri.
* **Menu Tautan:** Home (Beranda), Kursus (Katalog), Tentang Kami, Kontak.
* **Aksi Autentikasi:** Tombol "Masuk" dan "Daftar" jika belum terautentikasi; Tombol "Dashboard" jika sudah masuk.
* **Theme Toggle Switch:** Tombol ikonik matahari/bulan untuk mengubah preferensi warna aplikasi secara instan tanpa memuat ulang halaman (*realtime theme injection*).

### 5.2 Komponen Hero Section
* **Konten Utama:** Judul besar yang persuasif mengenai pengembangan minat bakat, dilengkapi dengan deskripsi singkat keunggulan platform.
* **Call to Action (CTA):** Tombol utama "Mulai Sekarang" yang mengarahkan langsung ke halaman pendaftaran atau katalog kursus.

### 5.3 Komponen Kategori Pilihan (Hobby Categories Grid)
* Penampilan kartu grid interaktif yang berisi ikon unik dan nama kategori hobi (misalnya: Musik, Seni Rupa, Fotografi, Kuliner, IT & Teknologi, Kerajinan Tangan).
* Setiap kartu kategori dapat diklik untuk menyaring daftar kursus sesuai kategori tersebut secara otomatis.

### 5.4 Komponen Kursus Populer / Unggulan
* Menampilkan jajaran *Course Cards* berkinerja tinggi atau yang paling banyak diminati oleh peserta.
* Setiap kartu wajib menampilkan: Gambar mini (Thumbnail), Badge Tipe (Online/Offline), Judul Kursus, Nama Instruktur, Rating Bintang rata-rata, dan Label Harga.

---

## 6. Dashboard Architecture & User Interface

### 6.1 Dashboard User (Peserta)
* **Informasi Profil:** Menampilkan foto profil, nama pengguna, email, dan tanggal bergabung.
* **Widget Statistik Personal:** Ringkasan jumlah kursus aktif, jumlah pendaftaran pending (menunggu verifikasi), dan total kursus yang telah diselesaikan.
* **Sistem Tabulasi Kursus:**
  * **Tab Kursus Aktif:** Menampilkan daftar kursus yang pembayarannya telah divalidasi oleh admin dan siap diikuti oleh peserta.
  * **Tab Menunggu Verifikasi:** Menampilkan daftar transaksi pendaftaran yang berkas bukti transfernya sedang dalam antrean pengecekan admin.
  * **Tab Riwayat Kursus:** Menampilkan dokumentasi kursus terdahulu yang telah diselesaikan, lengkap dengan akses untuk mengunduh informasi sertifikat atau memberikan ulasan ulang.

### 6.2 Dashboard Admin (Control Panel)
* **Metrik Statistik Utama:** Total akumulasi Peserta Terdaftar, Total Kursus Tersedia, Jumlah Transaksi Menunggu Validasi, dan Total Pendapatan (opsional/statik).
* **Grafik Analitik Ringkas:** Visualisasi statistik kategori kursus terlaris menggunakan representasi tabel murni atau elemen visual yang adaptif.
* **Sidebar Menu Navigasi:** Akses cepat ke manajemen User, Kategori, Instruktur, Kursus, Validasi Pembayaran, dan Log Sistem.

---

## 7. Core Functional Modules (Spesifikasi Fitur Utama)

### 7.1 Modul Katalog & Eksplorasi Kursus (Advanced Filtering)
* **Sidebar Filter Parameter:**
  * **Tipe Kursus:** Checkbox pilihan untuk memisahkan kursus "Online" (Berbasis Materi Mandiri) dan "Offline" (Pertemuan Tatap Muka Langsung).
  * **Kategori Hobi:** Pilihan dropdown atau list kategori hobi yang dinamis.
  * **Rentang Harga:** Input batas minimum dan maksimum nominal harga kursus.
* **Interaksi Detail Kursus:** Tombol "Lihat Detail" membawa pengguna ke halaman spesifikasi kursus yang memuat deskripsi lengkap, silabus materi, profil pengajar (instruktur), jadwal pelaksanaan, lokasi detail (jika offline), dan tombol aksi utama "Daftar Sekarang".

### 7.2 Modul Transaksi & Alur Pembayaran Manual (Manual Payment Gateway)
* **Inisiasi Invoice:** Saat peserta mengklik "Daftar Sekarang", sistem membuat rekaman pendaftaran (*Enrollment Record*) baru dengan status default "Pending".
* **Halaman Panduan Pembayaran:** Menampilkan nomor rekening tujuan transfer bank resmi platform, rincian biaya komparatif, dan kode unik transaksi.
* **Form Upload Bukti Bayar:**
  * Komponen input file eksklusif untuk mengunggah gambar/berkas bukti transaksi fisik.
  * **Spesifikasi Validasi File:** Format yang diizinkan hanya JPG, JPEG, PNG, dan WEBP dengan batasan ukuran berkas maksimal **20 MB**.
  * Setelah berhasil diunggah, status pendaftaran tetap terkunci pada posisi "Menunggu Verifikasi Admin".

### 7.3 Modul Manajemen Pembayaran & Sertifikat oleh Admin
* **Verifikasi Transaksi:** Admin membuka panel khusus "Validasi Pembayaran", melihat kecocokan data nominal dan gambar bukti transfer yang diunggah peserta, lalu menekan tombol aksi "Setujui" (mengubah status kursus peserta menjadi Aktif) atau "Tolak" (disertai alasan penolakan).
* **Manajemen Sertifikat Kelulusan Manual:** Jika peserta telah menyelesaikan seluruh materi kursus online atau menyelesaikan sesi kursus offline, Admin akan mengubah status kelulusan peserta di back-end secara manual menjadi "Lulus". Admin kemudian memproses penerbitan dokumen sertifikat secara eksternal dan mengirimkannya langsung ke alamat email peserta yang terdaftar pada sistem.

### 7.4 Modul Media Pembelajaran Online (Video Player Integration)
* **Layout Pembelajaran Mandiri:** Saat peserta membuka kursus online aktif, halaman bertransformasi menjadi ruang kelas digital terintegrasi.
* **Komponen Sisi Kiri (Main Player):** Pemutar video web native terintegrasi untuk memutar berkas materi video tutorial berkualitas tinggi, atau penampil dokumen PDF materi.
* **Komponen Sisi Kanan (Sidebar Playlist):** Daftar bab/silabus materi pembelajaran terstruktur yang interaktif. Pengguna dapat mengklik judul bab untuk memicu Vanilla JavaScript mengubah sumber berkas (*source src*) video utama secara instan tanpa memuat ulang seluruh halaman web.

### 7.5 Modul Sistem Penilaian & Ulasan (Rating & Review System)
* **Pemicu Interaksi:** Tersedia bagi peserta yang kursusnya telah berstatus selesai atau dalam riwayat pembelajaran.
* **Komponen Interaktif:** Form pop-up atau section ulasan yang memuat pilihan rating bintang (skala 1 sampai 5 bintang) menggunakan manipulasi CSS/JS interaktif, dikombinasikan dengan text-area untuk menulis komentar ulasan tekstual mengenai kualitas kursus dan instruktur.
* **Dampak Visual:** Akumulasi rata-rata rating akan ditampilkan secara dinamis pada kartu katalog kursus bersangkutan.

---

## 8. Database Architecture & Relational Schema

Untuk menjamin integritas referensial dan performa query database, skema relasional diatur dengan struktur kardinalitas berikut:

### 8.1 Daftar Tabel Utama dan Atribut Inti
1. **users** (id, name, email, phone, avatar, password, role_id, created_at)
2. **categories** (id, name, icon_class, description, created_at)
3. **instructors** (id, name, profile_picture, bio, expertise, created_at) *(Catatan: Tidak memiliki password/role login)*
4. **courses** (id, category_id, instructor_id, title, slug, description, type [enum: 'online', 'offline'], price, thumbnail, created_at)
5. **course_schedules** (id, course_id, date, start_time, end_time, location_name, google_maps_link, quota) *(Khusus tipe kursus offline)*
6. **enrollments** (id, user_id, course_id, status [enum: 'pending', 'active', 'completed', 'rejected'], created_at)
7. **payments** (id, enrollment_id, transfer_bank_name, account_holder_name, proof_file_path, verified_at, rejected_reason)
8. **course_materials** (id, course_id, title, file_path, sequence_order) *(Khusus tipe kursus online)*
9. **reviews** (id, user_id, course_id, rating_value [int 1-5], comment, created_at)

### 8.2 Hubungan & Aturan Kardinalitas Data Model
* **Categories (1) : (N) Courses:** Satu kategori menampung banyak jenis kursus hobi. Jika kategori dihapus, kursus di dalamnya wajib memiliki aturan proteksi (*on delete restrict*).
* **Instructors (1) : (N) Courses:** Satu instruktur dapat mengajar lebih dari satu kursus hobi yang berbeda.
* **Courses (1) : (N) Course_Schedules:** Relasi khusus untuk tipe kursus offline untuk merinci waktu dan tempat pelaksanaan sesi kelas tatap muka.
* **Users (1) : (N) Enrollments:** Seorang peserta diperbolehkan mendaftar dan mengikuti banyak kursus hobi sekaligus dalam satu waktu.
* **Courses (1) : (N) Enrollments:** Sebuah kelas kursus hobi dapat diisi oleh banyak peserta yang terdaftar secara sah.
* **Enrollments (1) : (1) Payments:** Setiap rekaman pendaftaran memiliki tepat satu rekaman transaksi pembayaran manual yang melampirkan berkas bukti transfer fisik.

---

## 9. Security, Data Validation, & Performance Strategy

### 9.1 Mekanisme Keamanan Sistem (Security Measures)
* **Form Protection:** Wajib menyertakan token CSRF (Cross-Site Request Forgery) di setiap pengiriman form metode POST untuk mencegah eksploitasi eksternal.
* **Data Sanitization:** Seluruh input teks dari pengguna wajib melewati proses *escaping* dan sanitasi ketat untuk membersihkan tag HTML berbahaya guna menangkal serangan XSS (Cross-Site Scripting).
* **Authentication Middleware:** Pembatasan hak akses rute url (*Route Guarding*) berdasarkan status login dan jenis peran akun. Pengguna biasa dilarang keras mengakses folder atau berkas administratif `/admin/*`.
* **Password Hashing:** Enkripsi kata sandi pengguna menggunakan algoritma satu arah yang aman (Bcrypt atau Argon2id) sebelum disimpan ke dalam database MySQL.

### 9.2 Aturan Validasi File Bukti Pembayaran
* **Allowed Extensions:** Hanya berkas dengan tipe MIME gambar asli yang diizinkan (`image/jpeg`, `image/png`, `image/webp`).
* **Maximum Capacity:** Ukuran berkas dibatasi maksimal **20 Megabytes (MB)** guna mencegah eksploitasi ruang penyimpanan server oleh pihak tidak bertanggung jawab.

### 9.3 Strategi Optimasi Performa (Performance Goals)
* **Eager Loading:** Memaksa penarikan data relasi database utama (seperti detail kategori dan nama instruktur) secara kolektif di awal query untuk menghindari problem performa kueri berulang *N+1 Query Issue*.
* **Pagination Control:** Mengaplikasikan pembagian halaman (*pagination*) otomatis untuk rendering kartu katalog kursus dan daftar tabel transaksi admin, dengan batasan maksimal 8-12 baris data per halaman demi menjaga waktu muat halaman tetap di bawah **500 milidetik (ms)**.

---

## 10. UI/UX Styling & Aesthetic Guidelines

Aplikasi ini mengadopsi gaya visual **Modern Educational Dashboard** yang bersih, berfokus penuh pada kenyamanan membaca, keterbacaan teks yang tinggi, serta kejelasan navigasi komponen.

### 10.1 Skema Palet Warna Aplikasi
* **Primary Color Gradient: Mengubah keterangan warna utama menjadi Linear Gradient (Top to Bottom) menggunakan rumus CSS linear-gradient(to bottom, #2B7FFF, #0065FF) - Gradien ini dikonfigurasikan untuk diaplikasikan pada tombol aksi utama (Call to Action seperti "Mulai Sekarang" & "Daftar Sekarang"), latar belakang navigasi aktif, hover states, serta elemen penekanan visual (branding highlights) di seluruh halaman beranda, katalog, maupun dashboard peserta
* **Secondary Color (Warna Pendukung):** Aqua Blue (`#00B4D8`) - Digunakan untuk komponen penanda, lencana tipe kursus online, dan aksen visual.
* **Success Indicator:** Hijau Daun (`#22C55E`) - Digunakan untuk status pembayaran disetujui, label kursus aktif, dan notifikasi keberhasilan.
* **Danger/Alert Indicator:** Merah Tegas (`#EF4444`) - Digunakan untuk status pendaftaran ditolak, tombol hapus, dan indikator error validasi.
* **Dark Slate Background:** Abu-abu Gelap (`#0F172A`) - Menjadi landasan utama latar belakang seluruh elemen aplikasi ketika pengguna beralih ke fitur **Dark Mode**.

### 10.2 Standar Tata Letak & Responsivitas (Mobile First Layout)
* Seluruh halaman dirancang menggunakan pendekatan grid dan layout yang fleksibel agar komponen secara adaptif melakukan restrukturisasi tampilan dari layar monitor komputer desktop ke layar ponsel cerdas tanpa merusak integritas fungsional sistem.