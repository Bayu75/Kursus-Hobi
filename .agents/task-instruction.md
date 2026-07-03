# Task Instruction untuk OpenCode

## Proyek: Sistem Informasi Kursus Hobi (Creative Precision Platform)

Saya telah menyimpan:
* Spesifikasi lengkap proyek → `prd.md`
* Panduan Design & UI/UX → `design.md`

---

# Instruksi Utama

Selalu baca dan ikuti file `prd.md` dan `design.md` sebelum mengerjakan task apapun.

## Aturan Penting

### PRD Priority
* Semua fitur, database, relasi, role, workflow, dan business logic harus mengikuti `prd.md`.
* **Batasan Kritis:** Instruktur tidak memiliki akun atau dashboard login tersendiri. Data instruktur diinput dan dikelola sepenuhnya oleh Admin untuk ditampilkan sebagai informasi pengajar.
* Jika menemukan konflik antara implementasi dan PRD, ikuti PRD.

### Design Priority
* Semua UI wajib mengikuti `design.md` dengan filosofi **Creative Precision**.
* **Warna Utama:** Gradien Linear Vertikal dari atas ke bawah dengan perpaduan warna `#2B7FFF` (atas) dan `#0065FF` (bawah) untuk tombol aksi primer dan navigasi aktif.
* **Sistem Tema:** Wajib menyediakan mode kontras tinggi untuk **Mode Terang (Light Mode)** dan **Mode Gelap (Dark Mode)** berbasis sinkronisasi `localStorage`.

### Development Rules
* Arsitektur: Monolith MVC klasik yang bersih dan terstruktur.
* Core Engine: PHP 8.4+ dan database MySQL 8.0+.
* Frontend Layout: TailwindCSS untuk penyusunan komponen visual.
* Frontend Interactivity: Vanilla JavaScript untuk manipulasi DOM (seperti *Playlist* materi video & interaksi bintang rating).
* Gunakan Form Request Validation di tingkat Controller.
* Gunakan **Service Layer** terisolasi untuk menangani *business logic* (pendaftaran, manajemen berkas bukti, kelulusan).
* Terapkan teknik *Eager Loading* untuk mencegah masalah performa kueri berulang (*N+1 Query Issue*).

---

# Struktur Task Checklist

Gunakan kategori berikut untuk melacak kemajuan proyek.

---

# 1. Project Setup & Configuration

## 1.1 Inisialisasi Project Laravel
* [ ] Setup lingkungan backend berbasis PHP 8.4 dan database MySQL 8.0+
* [ ] Setup konfigurasi database global dan penanganan session aman
* [ ] Setup sistem otorisasi dan manajemen session dasar (Login, Register, Logout)

## 1.2 Frontend Setup
* [ ] Integrasi utilitas kelas CSS Tailwind ke dalam aset proyek
* [ ] Setup arsitektur JavaScript Vanilla untuk pemutus state UI
* [ ] Setup skrip injeksi kelas `.dark` pada elemen bodi global melalui `localStorage`
* [ ] Pembuatan kerangka layout utama (*Reusable Master Layout*)

## 1.3 Base Architecture
* [ ] Setup struktur folder untuk Service Layer (`app/Services/`)
* [ ] Setup Middleware pelindung rute administratif (`/admin/*`)
* [ ] Pembuatan komponen UI global reusable (Tombol gradien biru, kartu kursus adaptif, input form standar)

---

# 2. Database & Migration

## 2.1 User & Access Control
* [ ] Membuat tabel `users` (id, name, email, phone, avatar, password, role_id, created_at)

## 2.2 Master Data Hobi & Pengajar
* [ ] Membuat tabel `categories` (id, name, icon_class, description, created_at)
* [ ] Membuat tabel `instructors` (id, name, profile_picture, bio, expertise, created_at)  
  *Catatan: Tanpa password atau field login tersendiri.*

## 2.3 Kursus & Jadwal Pelaksanaan
* [ ] Membuat tabel `courses` (id, category_id, instructor_id, title, slug, description, type [enum: 'online', 'offline'], price, thumbnail, created_at)
* [ ] Membuat tabel `course_schedules` (id, course_id, date, start_time, end_time, location_name, google_maps_link, quota, created_at)  
  *Konteks penunjang: Khusus tipe kursus offline.*
* [ ] Membuat tabel `course_materials` (id, course_id, title, file_path, sequence_order, created_at)  
  *Konteks penunjang: Khusus tipe kursus online.*

## 2.4 Transaksi Keuangan & Registrasi
* [ ] Membuat tabel `enrollments` (id, user_id, course_id, status [enum: 'pending', 'active', 'completed', 'rejected'], created_at)
* [ ] Membuat tabel `payments` (id, enrollment_id, transfer_bank_name, account_holder_name, proof_file_path, verified_at, rejected_reason)

## 2.5 Evaluasi & Rekaman Sistem
* [ ] Membuat tabel `reviews` (id, user_id, course_id, rating_value [int 1-5], comment, created_at)

## 2.6 Seeder & Data Awal
* [ ] Membuat Seeder Akun Utama (Admin dan User/Peserta Eksperimen)
* [ ] Membuat Seeder Master Kategori Hobi, Data Instruktur Statik, dan Dummy Kursus Populer

---

# 3. Models & Relationships

## 3.1 User Model
* [ ] Relasi ke `enrollments` (HasMany)
* [ ] Relasi ke `reviews` (HasMany)

## 3.2 Course & Category Model
* [ ] Relasi `Course` belongsTo `Category` dan `Instructor`
* [ ] Relasi `Course` hasMany `CourseSchedule`, `CourseMaterial`, dan `Enrollment`
* [ ] Relasi `Category` hasMany `Course` dengan aturan proteksi data `on delete restrict`

## 3.3 Transactional Models
* [ ] Relasi `Enrollment` belongsTo `User` dan `Course`
* [ ] Relasi `Enrollment` hasOne `Payment`
* [ ] Relasi `Payment` belongsTo `Enrollment`

---

# 4. Authentication & Authorization

## 4.1 Authentication Workflow
* [ ] Validasi keunikan registrasi akun peserta (Email unik, password terkonfirmasi)
* [ ] Otomatisasi pengalihan rute (*Redirect Routing*) pasca login sukses berdasarkan status `role_id` (Admin ke Back-end Panel, Peserta ke Dasbor User)
* [ ] Fitur pembersihan total data session dan proteksi saat Logout dijalankan

## 4.2 Route Guarding (Middleware)
* [ ] Implementasi pengunci rute admin (`/admin/*`) untuk menangkal akses ilegal dari peserta biasa

---

# 5. Backend Logic & Business Features

## 5.1 Dashboard System
* [ ] **Dashboard User:** Pembuatan ringkasan statistik personal (aktif, pending, riwayat) dan pemisahan data via Tabulasi Interaktif (Vanilla JS)
* [ ] **Dashboard Admin:** Pembuatan metrik total akumulasi peserta terdaftar, jumlah kursus tersedia, total pengajuan pembayaran pending, dan ringkasan distribusi hobi

## 5.2 Katalog & Advanced Filtering
* [ ] Implementasi sistem kueri filter silang (Kombinasi Tipe Kelas Online/Offline, Dropdown Kategori hobi, dan batas minimal-maksimal rentang harga)
* [ ] Optimasi kueri katalog menggunakan teknik *Eager Loading* (`with(['category', 'instructor'])`)

## 5.3 Modul Pembayaran Manual (Manual Gateway)
* [ ] Inisiasi rekaman data invoice pendaftaran baru berstatus default "Pending"
* [ ] Pembuatan fungsi enkapsulasi penyimpanan berkas upload gambar bukti transfer ke direktori penyimpanan lokal terproteksi

## 5.4 Modul Administrasi Back-end (Oleh Admin)
* [ ] Panel Verifikasi Pembayaran: Aksi "Setujui" (mengubah kelas peserta menjadi Aktif) atau "Tolak" (disertai pengisian alasan penolakan data)
* [ ] Panel Kelulusan & Manajemen Sertifikat Manual: Pengubahan status peserta menjadi "Lulus" secara manual, diikuti instruksi pencatatan dokumen sertifikat untuk dikirim eksternal via email peserta

## 5.5 Ruang Kelas Online (Video Classroom)
* [ ] Implementasi layout pemutar media mandiri responsif (*Cinema Mode*)
* [ ] Penulisan skrip pemrograman Vanilla JS DOM manipulation untuk memuat jalur sumber berkas video tutorial baru dari sidebar daftar putar materi tanpa memicu penyegaran (*reload*) halaman penuh

## 5.6 Sistem Penilaian (Rating & Review)
* [ ] Pembuatan form modal popup ulasan berlatar belakang buram (*backdrop-blur layout*) yang terpicu dari tab riwayat kursus selesai
* [ ] Penulisan algoritma interaksi pemilih ikon bintang (skala 1 sampai 5) menggunakan pelacakan indeks berbasis JavaScript frontend (*mouse-over* dan *click state*)

---

# 6. Security & Data Validation

## 6.1 Form Request Validation
* [ ] Aturan validasi input teks (Sanitasi dari tag HTML berbahaya penangkal serangan XSS)
* [ ] Penegasan token pengaman CSRF pada seluruh metode pengiriman data form (POST/PUT/DELETE)

## 6.2 File Upload Security
* [ ] Penerapan filter tipe MIME khusus gambar asli (`jpeg, png, jpg, webp`) pada kolom unggah bukti transfer
* [ ] Pembatasan ketat kapasitas ukuran file unggahan maksimal **20 Megabytes (MB)** guna mencegah eksploitasi ruang server

---

# 7. Frontend & Blade Views

## 7.1 Public Halaman Depan
* [ ] **Halaman Beranda:** Pembuatan Hero Section dengan tombol gradien vertikal, grid interaktif kartu kategori hobi, dan deretan kartu kelas populer/unggulan
* [ ] **Halaman Eksplorasi Kursus:** Implementasi tata letak dua kolom (25% Sidebar Filter, 75% Grid Konten Utama) sesuai dengan `kursus.jpg`
* [ ] Halaman login dan pendaftaran akun yang responsif dan mobile-first

## 7.2 Halaman Workspace Peserta
* [ ] Antarmuka Dasbor Tabulasi User (`dashboard user.jpg`)
* [ ] Tampilan halaman instruksi invoice transfer bank dan area upload bukti (`payment.png`)
* [ ] Antarmuka ruang kelas digital mandiri (`materi video.png`)

## 7.3 Panel Kontrol Administratif Admin
* [ ] Manajemen CRUD data Kategori Hobi, Data Instruktur, dan Data Kursus (termasuk modul silabus/jadwal)
* [ ] Tabel daftar transaksi masuk menunggu validasi admin

---

# 8. Performance Optimization & Final Polish

## 8.1 Optimasi Kecepatan Rendering
* [ ] Implementasi fungsi kontrol pembatasan halaman (*Pagination*) otomatis pada baris tabel transaksi admin dan grid katalog kursus (Maksimal 8-12 baris per halaman)
* [ ] Pengujian waktu respon muat halaman web di bawah batas sasaran **500 milidetik (ms)**

## 8.2 Uji Responsivitas Tata Letak
* [ ] Pengujian konsistensi kontras keterbacaan teks dan fungsionalitas elemen klik (minimal ukuran area sentuh 44px) dari resolusi smartphone, tablet, hingga layar komputer desktop pada kedua mode (Light/Dark)

---

# Aturan Wajib Update Tasklist (PENTING)

Setiap kali selesai mengerjakan satu task atau satu grup task, WAJIB melakukan langkah berikut sebelum melapor:

## 1. Update File
Perbarui isi berkas `.agents/tasklist.md`.

## 2. Checklist Progress
Task selesai wajib diubah menjadi:
* [x] ✅ Task selesai

## 3. Update Progress Percentage
Contoh:
* Progress: 15% → Progress: 40% → Progress: 100%

## 4. Tambahkan Catatan Realisasi
Setiap task selesai harus memiliki catatan singkat mengenai komponen konkret apa saja yang telah berhasil dibuat dan diuji keamanannya.

---

# Workflow Kerja

Urutan pengerjaan wajib dipatuhi secara linier dari awal hingga akhir:
1. **Project Setup & Environment Integration**
2. **Database Migration Construction & Seeding**
3. **Data Relationship Definition (Models)**
4. **Authentication & Authorization Guarding System**
5. **Backend Logic Core Features Implementation** (Katalog -> Pembayaran -> Verifikasi Admin -> Kelas Video -> Rating)
6. **Security Hardening Validation**
7. **Frontend Blade UI Styling Component Assembly** (Tuning Kontras Mode Terang/Gelap)
8. **Performance Tuning & Final Polish Validation**