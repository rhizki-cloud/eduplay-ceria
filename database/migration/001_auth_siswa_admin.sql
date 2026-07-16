USE eduplay_ceria;

-- Struktur users versi awal sudah mendukung dua peran: admin dan siswa.
-- Jalankan bagian INSERT ini hanya bila akun demo siswa belum tersedia.
INSERT INTO users (nama, username, password, role)
SELECT 'Siswa Demo', 'siswa', '$2y$12$QIKO/FTColREDRFjqOzWUOGjodOEWSK.unsMrS6cxnGxdN1zs0NNm', 'siswa'
WHERE NOT EXISTS (SELECT 1 FROM users WHERE username = 'siswa');
