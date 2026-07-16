# Pembaruan Autentikasi dan Panel Admin

## Autentikasi
- Login terpadu untuk siswa dan administrator.
- Pendaftaran mandiri khusus siswa.
- Proteksi seluruh halaman sisi siswa dan panel admin.
- Sesi tunggal berbasis role `siswa` dan `admin`.
- Logout membersihkan sesi dan cookie.
- Nilai permainan terkait dengan akun yang sedang login.

## Pengguna
- Tambah akun siswa dan administrator dari panel admin.
- Pencarian dan filter berdasarkan role.
- Detail akun dan riwayat nilai siswa.
- Edit nama, username, dan role.
- Reset password.
- Hapus akun dengan pengaman akun aktif dan admin terakhir.
- Ekspor data pengguna ke CSV.

## Panel Admin
- Desain responsif yang selaras dengan sisi siswa.
- Dashboard statistik dan aktivitas terbaru.
- Pengelolaan kategori, materi, permainan, dan kuis.
- Ringkasan prestasi dan laporan.
- Pengaturan dasar aplikasi.
- Profil dan penggantian password admin.

## Keamanan
- Password menggunakan `password_hash()` dan `password_verify()`.
- CSRF token pada aksi tulis utama.
- Query database menggunakan prepared statement.
- Service worker tidak menyimpan halaman PHP pribadi ke cache.
