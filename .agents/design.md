---
version: 1.0
name: Hobby Course Platform - Creative Precision
description: Premium Non-Formal Educational Platform. Modern digital-learning tech design with creative trust, accessibility, fluidity, and modern aesthetic.

colors:
  primary-start: "#2B7FFF"
  primary-end: "#0065FF"
  secondary: "#081C3A"
  tertiary: "#00B4D8"
  success: "#22C55E"
  warning: "#F59E0B"
  danger: "#EF4444"
  surface: "#F8FAFC"
  surface-alt: "#FFFFFF"
  border: "#E2E8F0"
  text-primary: "#0F172A"
  text-secondary: "#64748B"
  text-muted: "#94A3B8"
  on-primary: "#FFFFFF"
  dark-bg: "#0F172A"
  dark-surface: "#1E293B"

typography:
  display:
    fontFamily: Outfit
    fontSize: 4rem
    fontWeight: 700
    letterSpacing: "-0.03em"
  h1:
    fontFamily: Outfit
    fontSize: 3rem
    fontWeight: 700
  h2:
    fontFamily: Outfit
    fontSize: 2.25rem
    fontWeight: 700
  h3:
    fontFamily: Outfit
    fontSize: 1.5rem
    fontWeight: 600
  body:
    fontFamily: Outfit
    fontSize: 1rem
    lineHeight: 1.7
  small:
    fontFamily: Outfit
    fontSize: 0.875rem
  label:
    fontFamily: Outfit
    fontSize: 0.875rem
    fontWeight: 500

rounded:
  sm: 10px
  md: 16px
  lg: 20px
  xl: 28px
  full: 9999px

spacing:
  xs: 4px
  sm: 8px
  md: 16px
  lg: 24px
  xl: 32px
  xxl: 64px

shadow:
  sm: "0 4px 12px rgba(15,23,42,0.05)"
  md: "0 10px 30px rgba(15,23,42,0.08)"
  lg: "0 20px 40px rgba(15,23,42,0.12)"

components:
  button-primary:
    background: "linear-gradient(to bottom, {colors.primary-start}, {colors.primary-end})"
    textColor: "{colors.on-primary}"
    rounded: "{rounded.full}"
    padding: "12px 24px"
    transition: "transform 150ms ease, opacity 150ms ease"
  button-secondary:
    backgroundColor: "{colors.surface-alt}"
    textColor: "{colors.text-primary}"
    border: "1px solid {colors.border}"
    rounded: "{rounded.full}"
    padding: "12px 24px"
  card:
    backgroundColor: "{colors.surface-alt}"
    textColor: "{colors.text-primary}"
    rounded: "{rounded.lg}"
    shadow: "{shadow.md}"
    padding: "24px"
  course-card:
    backgroundColor: "{colors.surface-alt}"
    rounded: "{rounded.lg}"
    shadow: "{shadow.sm}"
    border: "1px solid {colors.border}"
  glass-playlist:
    backgroundColor: "rgba(255,255,255,0.05)"
    backdropFilter: "blur(20px)"
    border: "1px solid rgba(255,255,255,0.1)"
    rounded: "{rounded.md}"
  input:
    backgroundColor: "#FFFFFF"
    border: "1px solid {colors.border}"
    rounded: "{rounded.md}"
    padding: "12px 16px"
---

# Overview

Sistem Informasi Kursus Hobi menggunakan filosofi desain **Creative Precision**.

Desain harus memberikan kesan:
* Kreatif & Menyenangkan (Inspiring)
* Profesional & Terstruktur
* Modern & Fluid (Mulus)
* Terpercaya & Transparan
* Premium EdTech UX

UI harus terasa seperti gabungan estetika platform edutainment kelas dunia:
* MasterClass Dashboard
* Coursera Premium UI
* Stripe Dashboard
* Vercel Clean Interface

Namun tetap ramah, inklusif, dan sangat mudah digunakan oleh masyarakat umum Indonesia yang ingin mengeksplorasi minat dan bakat baru.

---

# Core Design Principles

## 1. Creative Trust
Setiap layar harus menumbuhkan antusiasme belajar sekaligus rasa aman. Gunakan whitespace yang lega, hierarki visual tipografi yang kuat, ikon yang konsisten, dan struktur transparan untuk informasi kurikulum serta profil instruktur.

## 2. Dynamic Theme Synergy (Light & Dark)
Aplikasi harus mempertahankan kontras tinggi dan kenyamanan membaca yang setara baik dalam Mode Terang maupun Mode Gelap. Desain tidak boleh kehilangan identitas estetika utamanya saat preferensi warna dialihkan oleh pengguna.

## 3. Mobile First Accessibility
Mayoritas peserta mengakses materi video, jadwal, dan dasbor pendaftaran melalui smartphone. Alur responsivitas tata letak diwajibkan mengikuti prioritas: Mobile -> Tablet -> Desktop.

## 4. Visual Layout Continuity
Data pendaftaran, riwayat belajar, transaksi keuangan manual, dan status materi (online/offline) wajib disajikan dalam struktur linier atau tabulasi yang ringkas untuk mencegah kejenuhan informasi (*cognitive overload*).

---

# Layout Rules

## Container
* Max-width: 1280px
* Center aligned (`margin: 0 auto`)

## Section Spacing
* Desktop: 80px - 120px
* Tablet: 64px - 80px
* Mobile: 48px - 64px

## Grid
* 12 kolom desktop (gap: 24px)
* 6 kolom tablet (gap: 16px)
* 1 kolom mobile (gap: 16px)

---

# Navigation

## Navbar
* **Tinggi:** 80px
* **Isi:** Logo Kursus Hobi, Menu (Home, Kursus, Tentang Kami, Kontak), Theme Toggle Switch (Ikon Matahari/Bulan), Tombol Login/Register (atau Menu Profil jika sudah masuk).
* **Perilaku Sifat:** Sticky di bagian atas layar. Menggunakan properti efek `backdrop-filter: blur(12px)`. Transparan sempurna saat berada di posisi paling atas (*top*), dan bertransisi mulus menjadi solid (dengan border bawah tipis) saat discroll ke bawah.

---

# Landing Page

## Hero Section
* **Layout:** Dua kolom (Desktop) beralih menjadi Satu kolom vertikal (Mobile).
  * **Kiri:** Judul Display berukuran besar dengan penekanan gradien pada kata kunci kreatif, Deskripsi ringkas ajakan mengembangkan bakat, tombol CTA Utama bergradien biru.
  * **Kanan:** Gambar representatif (Hero Image) berkualitas tinggi yang menampilkan aktivitas kreativitas/hobi dengan pemotongan sudut (*rounded corner*) yang halus.

## Hobby Categories Grid
* Menampilkan barisan kartu grid yang responsif berisi kategori hobi (Musik, Fotografi, Kuliner, Seni Rupa, dll).
* **Hover Animation:** Kartu akan terangkat naik (`transform: translateY(-6px)`) dengan penambahan ketebalan shadow secara halus (`shadow.lg`) dan transisi berdurasi 200ms.

## Featured Course Cards
* Grid kartu materi populer dengan detail ringkas: Gambar mini (*Thumbnail*) berasio aspek 16:9, lencana absolut (*absolute badge*) status tipe kelas ("Online" / "Offline"), judul, nama instruktur, 5-bintang rating emas statis, dan label harga tebal.

---

# Dashboard Design

Dasbor dirancang dengan pendekatan manajemen SaaS modern yang berfokus pada konten pembelajaran.

* **Layout:** Sidebar kiri tetap (*Fixed Sidebar* lebar 280px) untuk navigasi administratif, berpasangan dengan area Konten Utama di sisi kanan yang adaptif. Pada layar mobile, sidebar bertransformasi menjadi *Off-canvas Drawer Menu* yang dipicu via tombol hamburger.

## Dashboard Cards
* Menggunakan kelengkukan `rounded.lg` (20px), bayangan halus (`shadow.md`), serta perubahan warna latar belakang yang responsif terhadap deteksi *Dark Mode class* di elemen bodi.

---

# Course Explorer & Filtering Design

* **Warna Dominan:** Gradien Biru Utama (`#2B7FFF` ke `#0065FF`).
* **Komponen Filter:** Menggunakan panel lengket (*Sticky Sidebar Filter*) yang ringkas untuk layar desktop, dan bertransformasi menjadi modal *Bottom Sheet Filter* yang ramah sentuhan jari pada perangkat mobile.
* **Elemen Filter:** Pencarian teks bebas, Checkbox Pilihan Tipe (Online/Offline), Dropdown Kategori, dan slider rentang harga (*Price Range Slider*).

---

# Learning Room & Video Player Design (Online Course)

Modul khusus interaksi materi video kelas mandiri (`materi video.png`).

* **Warna Dominan:** Latar belakang hitam pekat (`#000000`) pada kontainer utama pemutar untuk meminimalkan gangguan visual sekeliling (*Cinema Mode*).
* **Layout Pembagian Ruang:**
  * **Sektor Kiri (70% Lebar Desktop):** Kotak pemutar media HTML5 native responsif beresolusi tinggi dengan kontrol UI kustom yang minimalis.
  * **Sektor Kanan (30% Lebar Desktop):** Sidebar daftar putar (*Playlist Materials*) berbasis komponen glassmorphism (`glass-playlist`).
* **Interaksi Playlist:** Setiap baris silabus materi berupa baris klik interaktif. Ketika diklik, Vanilla JS memperbarui properti `src` media tanpa memicu muat ulang halaman total, disertai animasi transisi penanda baris aktif (*active row highlight*).

---

# Manual Payment & Invoice Design

* **Warna Dominan:** Netral Profesional dengan penanda status yang kontras.
* **Komponen:**
  * **Invoice Card:** Menampilkan nomor invoice, detail kelas hobi yang dibeli, dan kalkulasi total biaya.
  * **Bank Info Box:** Menggunakan background kontras rendah dengan tipografi monospace untuk mempermudah penyalinan nomor rekening resmi platform.
  * **Upload Area Container:** Area drop file bergaris putus-putus (*dashed border*) yang interaktif. Mendukung validasi visual langsung menggunakan JavaScript (mengubah ikon menjadi pratonton/thumbnail gambar jika file gambar bukti pembayaran valid berhasil dipilih).

---

# Rating & Review System Design

* **Warna Dominan:** Warna Sukses Hijau (`#22C55E`) untuk tombol konfirmasi dan Emas Cerah untuk Bintang Penilaian.
* **Komponen Modal Popup:**
  * Menggunakan lapisan buram (*backdrop-blur layout*) sebagai latar belakang pengunci fokus.
  * **Interactive Star Rating:** 5 komponen ikon bintang kosong yang terprogram dengan Vanilla JS. Saat kursor mouse melintas (*hover*) atau jari menyentuh (*tap*), bintang akan terisi warna emas secara progresif dari kiri ke kanan. Klik terakhir mengunci nilai angka integer (1-5) ke dalam form data kiriman.

---

# Status System

## Success / Verified
* **Color:** `#22C55E`
* **Penggunaan:** Status Pembayaran Diterima, Kelas Selesai, Sertifikat Terbit, Notifikasi Berhasil.

## Warning / Pending
* **Color:** `#F59E0B`
* **Penggunaan:** Transaksi Menunggu Verifikasi, Sesi Kelas Antrean Menunggu Jadwal.

## Danger / Rejected
* **Color:** `#EF4444`
* **Penggunaan:** Bukti Transfer Ditolak, Pembatalan Transaksi, Pesan Error Form.

## Info / Active
* **Color:** `#0065FF` (Gradient Link / Solid)
* **Penggunaan:** Status Kursus Sedang Berjalan, Petunjuk Informasi Silabus, Akses Tombol Utama.

---

# Animations

Menggunakan animasi mikro yang berbobot ringan untuk menjaga performa rendering browser di bawah 500ms.

* **Durasi:** 150ms sampai maksimal 250ms.
* **Jenis Transisi:**
  * `fade-in-out` untuk pembukaan modal popup rating dan perpindahan tab dasbor.
  * `slide-up` (jarak pergeseran pendek 8px) saat elemen kartu kursus pertama kali dimuat di layar.
  * `scale-hover` (`scale(1.02)`) dengan transisi linier-lembut untuk kartu kategori hobi.
* **Larangan:** Hindari efek animasi memantul (*bouncing* berat) atau animasi berdurasi panjang yang mengganggu kecepatan interaksi pengguna.

---

# Icons
* Menggunakan pustaka **Lucide Icons** secara konsisten di seluruh modul halaman untuk menjamin keselarasan ketebalan garis (*stroke weight*) dan gaya visual geometris.

---

# Do's
* Gunakan whitespace yang melimpah untuk memisahkan kelompok materi hobi.
* Pertahankan konsistensi sudut lengkung besar (`rounded.lg` / 20px) pada seluruh elemen kartu modern.
* Pastikan kontras teks memenuhi standar keterbacaan tinggi di kedua mode (Light/Dark).
* Prioritaskan kenyamanan layout ponsel cerdas pada setiap pembuatan komponen masukan form.
* Gunakan transisi warna yang halus pada elemen gradien biru vertikal (`#2B7FFF` ke `#0065FF`).

---

# Don'ts
* Jangan gunakan sudut lancip tajam (0px rounded) pada elemen tombol atau kartu utama.
* Jangan gunakan bayangan hitam pekat yang tebal (*heavy dark shadow*); gunakan shadow dengan opasitas rendah yang lembut.
* Jangan mencampur lebih dari dua warna aksen mencolok dalam satu layar pembelajaran materi.
* Jangan membuat dasbor administratif admin menyerupai sistem tabel pemerintahan gaya lama; pertahankan visual minimalis, bersih, dan berorientasi data saas premium.

---

# Final Goal
Saat pengguna (baik peserta maupun administrator) berinteraksi dengan platform Kursus Hobi ini, impresi psikologis pertama yang dihadirkan adalah: 
"Ini adalah ruang belajar kreatif digital Indonesia yang sangat modern, bersih, berestetika premium, dan memiliki standar fungsional setara dengan produk digital edukasi kelas dunia."