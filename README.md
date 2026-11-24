# Aplikasi Peminjaman Alat

Aplikasi web manajemen peminjaman dan pengembalian alat laboratorium berbasis **Laravel 12**, **MySQL** (Migration, Function, Trigger, Stored Procedure), dan **AdminLTE 3**.

## Fitur Utama

- **Autentikasi & Hak Akses 3 Role**: `Admin`, `Petugas`, dan `Peminjam` menggunakan middleware `role`.
- **Admin**:
  - Dashboard ringkasan data & peminjaman terbaru.
  - CRUD User, Kategori, dan Alat.
  - Manajemen Data Peminjaman, Data Pengembalian, dan Log Aktivitas.
- **Petugas**:
  - Dashboard pengajuan menunggu ACC.
  - Persetujuan peminjaman (otomatis memotong stok alat melalui MySQL Trigger).
  - Pantau & proses pengembalian beserta perhitungan denda otomatis melalui Stored Procedure & Function.
  - Cetak laporan peminjaman & pengembalian.
- **Peminjam**:
  - Dashboard riwayat peminjaman pribadi.
  - Melihat daftar alat tersedia dan mengajukan peminjaman.
  - Melihat status peminjaman, total denda, dan melakukan pengembalian alat.

## Persyaratan

- PHP >= 8.2
- Composer
- MySQL / MariaDB (misal melalui Laragon)

## Instalasi & Menjalankan

1. Buat database kosong di MySQL bernama `db_peminjaman_alat`.
2. Sesuaikan konfigurasi database di `.env` (`DB_CONNECTION=mysql`, `DB_DATABASE=db_peminjaman_alat`, `DB_USERNAME=root`, `DB_PASSWORD=`).
3. Jalankan migration dan seeder:
   ```bash
   php artisan migrate:fresh --seed
   ```
4. Jalankan server pengembangan:
   ```bash
   php artisan serve
   ```
5. Buka `http://127.0.0.1:8000` di browser.

## Akun Default

| Role | Username | Password |
| :--- | :--- | :--- |
| Admin | `admin` | `admin123` |
| Petugas | `petugas` | `petugas123` |
| Peminjam | `peminjam` | `peminjam123` |

## Dokumentasi Penjelasan Kode

Untuk penjelasan detail lokasi file, alur kode per fitur, daftar route, serta cara kerja Trigger, Function, dan Stored Procedure, lihat [DOKUMENTASI_LENGKAP.md](DOKUMENTASI_LENGKAP.md).
