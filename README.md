# 🛒 Jual Lagih - E-Commerce Web Application

**Jual Lagih** adalah aplikasi _e-commerce_ berbasis web yang dibangun untuk memenuhi syarat **Ujian Kompetensi Keahlian (UKK) / Rekayasa Perangkat Lunak (RPL)**. Aplikasi ini memfasilitasi transaksi jual-beli daring dengan memisahkan fitur operasional untuk dua peran pengguna utama kelolaan sistem: **Pembeli (Buyer)** dan **Penjual (Seller)**.

Aplikasi dirancang dengan pendekatan antarmuka yang modern, responsif, dan didominasi tema biru yang konsisten menggunakan **Tailwind CSS**.

---

## ✨ Fitur Utama (Features)

Sistem menggunakan Autentikasi dengan multi-role access control untuk mengarahkan pengguna ke halaman panel yang sesuai.

### 🛍️ Panel Pembeli (Buyer)

- **Beranda (Home):** Menampilkan produk-produk terbaru dan statistik pengguna.
- **Katalog Produk:** Daftar lengkap produk dengan fitur pencarian (Search).
- **Detail Produk:** Informasi spesifik mengenai produk, sisa stok, serta opsi tambah ke keranjang.
- **Keranjang Belanja (Cart):** Manajemen barang yang ingin dibeli, kalkulasi total otomatis, ubah kuantitas, dan proses _Checkout_.
- **Riwayat Pesanan:** Melacak status pemesanan secara _real-time_ dengan label status berwarna (_Badge_).
- **Manajemen Profil:** Mengubah informasi identitas, kontak (Nomor HP/Alamat), serta pembaruan _password_.

### 🏪 Panel Penjual (Seller)

- **Dashboard Toko:** Ringkasan statistik performa tokoh (total produk, jumlah pesanan masuk, pesanan pending, dan estimasi pendapatan uang).
- **Manajemen Produk (CRUD):** Tambah produk baru (dengan unggah foto + pratinjau), edit harga/stok/deskripsi, dan hapus produk.
- **Manajemen Pesanan Masuk:** Mengelola transaksi dari pembeli, memperbarui status pengiriman (_Pending_, _Processing_, _Shipped_, _Completed_, _Cancelled_).
- **Manajemen Profil:** Memperbarui informasi profil toko/penjual serta kata sandi.

---

## 🛠️ Tech Stack & Alat Pembuatan

- **Framework Backend:** [Laravel](https://laravel.com/) (PHP)
- **Framework Frontend & Styling:** [Tailwind CSS](https://tailwindcss.com/) (menggunakan directive `@vite`)
- **Templating Engine:** Laravel Blade (`.blade.php`)
- **Database:** MySQL / MariaDB (via Eloquent ORM)
- **Development Tooling:** Node.js (Vite, pnpm/npm), Git

---

## 🚀 Panduan Instalasi (Local Development)

Ikuti langkah-langkah berikut untuk menjalankan project ini di komputer lokal Anda (pastikan sudah terinstall PHP, Composer, Node.js, dan MySQL).

1. **Clone repositori ini:**

    ```bash
    git clone <url-repo-anda>
    cd jual-Lagih
    ```

2. **Install dependensi PHP (Composer):**

    ```bash
    composer install
    ```

3. **Install dependensi Node (Tailwind & Vite):**

    ```bash
    npm install
    # atau menggunakan pnpm
    pnpm install
    ```

4. **Konfigurasi Environment Database:**
   Salin file konfigurasi lingkungan:

    ```bash
    cp .env.example .env
    ```

    Buka file `.env`, lalu atur kredensial database Anda:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=jual_lagih  # (atau nama db sesuai yang Anda buat di phpMyAdmin)
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5. **Generate Application Key:**

    ```bash
    php artisan key:generate
    ```

6. **Jalankan Migrasi Database:**

    ```bash
    php artisan migrate
    ```

7. **Tautkan Folder Storage (Untuk upload foto produk):**

    ```bash
    php artisan storage:link
    ```

8. **Jalankan Development Server:**
   Buka dua terminal terpisah.

    Terminal 1 (Menjalankan server PHP Laravel):

    ```bash
    php artisan serve
    ```

    Terminal 2 (Menjalankan Vite asset bundler agar styling Tailwind aktif):

    ```bash
    npm run dev
    # atau
    pnpm run dev
    ```

9. Buka browser dan akses aplikasi pada: **http://127.0.0.1:8000**

---

## 📝 Catatan Pengujian (Testing)

Untuk keperluan UKK/Demo aplikasi, Anda bisa mencoba alur berikut:

1. Registrasi akun baru (sebagai penjual ataupun pembeli bergantung skenario yang ditentukan role di database saat pendaftaran).
2. Login sebagai **Seller** → Tambahkan beberapa data produk beserta fotonya.
3. Login sebagai **Buyer** (di browser berbeda / mode incognito) → Belanja produk yang dibuat seller tadi → Lakukan _checkout_.
4. Kembali ke halaman **Seller** → Cek _Dashboard_ dan _Pesanan Masuk_ → Ubah status pesanan menjadi sedang diproses atau selesai.
5. Cek kembali akun **Buyer** → Pastikan status di menu _Riwayat Pesanan_ sudah berubah.

---

_Dibuat untuk keperluan Ujian Kompetensi Keahlian (UKK) RPL - 2024/2026_
