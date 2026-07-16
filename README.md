# EduPlay Ceria

Aplikasi pembelajaran anak berbasis **PHP native + MySQL** dengan dua jenis pengguna: **siswa** dan **administrator**.

## Fitur autentikasi

- Login terpadu untuk siswa dan admin.
- Pendaftaran mandiri khusus siswa.
- Seluruh halaman belajar memerlukan login.
- Nilai permainan disimpan berdasarkan akun siswa yang sedang masuk.
- Admin dapat menambah akun siswa maupun akun admin baru.
- Admin dapat melihat detail pengguna, mengubah akun, mereset password, menghapus akun, dan mengekspor data CSV.
- Proteksi CSRF pada aksi tulis utama di panel admin.
- Pengaman agar akun admin aktif dan administrator terakhir tidak dapat dihapus.

## Panel admin

Panel admin menggunakan desain yang selaras dengan sisi siswa dan responsif untuk desktop maupun perangkat mobile. Modul utama:

- Dashboard
- Pengguna
- Kategori materi
- Materi
- Permainan
- Kuis
- Prestasi
- Laporan
- Pengaturan
- Profil admin

## Menjalankan di XAMPP

1. Salin folder `EduPlay-Ceria` ke `C:/xampp/htdocs/`.
2. Jalankan **Apache** dan **MySQL** dari XAMPP.
3. Buka phpMyAdmin.
4. Impor file `database/database.sql`.
5. Buka `http://localhost/EduPlay-Ceria/`.
6. Sistem akan mengarahkan pengguna ke halaman login.

### Akun awal

**Administrator**

- Username: `admin`
- Password: `admin123`

**Siswa demo**

- Username: `siswa`
- Password: `siswa123`

Siswa baru juga dapat mendaftar melalui tombol **Daftar akun siswa** pada halaman login.

## Jika database lama sudah pernah diimpor

Jalankan file berikut melalui menu SQL di phpMyAdmin:

`database/migration/001_auth_siswa_admin.sql`

Struktur tabel `users` lama sudah mendukung peran `admin` dan `siswa`, sehingga tidak diperlukan perubahan tabel tambahan.

## Konfigurasi database

Nilai bawaan di `config/database.php`:

- Host: `127.0.0.1`
- Database: `eduplay_ceria`
- User: `root`
- Password: kosong

Konfigurasi dapat diubah melalui environment variable `DB_HOST`, `DB_NAME`, `DB_USER`, dan `DB_PASS`.

## Catatan produksi

Sebelum dipublikasikan, ganti password admin awal, aktifkan HTTPS, gunakan kredensial database produksi, dan hapus akun demo bila tidak diperlukan.
