CREATE DATABASE IF NOT EXISTS eduplay_ceria CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE eduplay_ceria;
SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS log_aktivitas,sertifikat,badge,prestasi,nilai,jawaban,soal,quiz,permainan,materi,kategori_materi,users,setting;
CREATE TABLE users(id INT AUTO_INCREMENT PRIMARY KEY,nama VARCHAR(120) NOT NULL,username VARCHAR(80) UNIQUE NOT NULL,password VARCHAR(255) NOT NULL,role ENUM('admin','siswa') DEFAULT 'siswa',created_at DATETIME DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE kategori_materi(id INT AUTO_INCREMENT PRIMARY KEY,nama VARCHAR(100) NOT NULL,slug VARCHAR(120) UNIQUE NOT NULL);
CREATE TABLE materi(id INT AUTO_INCREMENT PRIMARY KEY,kategori_id INT NULL,judul VARCHAR(180) NOT NULL,slug VARCHAR(190) UNIQUE NOT NULL,ringkasan TEXT,konten LONGTEXT,status ENUM('draft','publish') DEFAULT 'publish',created_at DATETIME DEFAULT CURRENT_TIMESTAMP,updated_at DATETIME NULL,FOREIGN KEY(kategori_id) REFERENCES kategori_materi(id) ON DELETE SET NULL);
CREATE TABLE permainan(id INT AUTO_INCREMENT PRIMARY KEY,judul VARCHAR(180),jenis VARCHAR(80),level VARCHAR(30),status ENUM('draft','publish') DEFAULT 'publish',created_at DATETIME DEFAULT CURRENT_TIMESTAMP);
CREATE TABLE quiz(id INT AUTO_INCREMENT PRIMARY KEY,judul VARCHAR(180),kategori VARCHAR(80),kelas TINYINT NULL,status ENUM('draft','publish') DEFAULT 'publish');
CREATE TABLE soal(id INT AUTO_INCREMENT PRIMARY KEY,quiz_id INT,pertanyaan TEXT,tipe VARCHAR(40) DEFAULT 'pilihan_ganda',FOREIGN KEY(quiz_id) REFERENCES quiz(id) ON DELETE CASCADE);
CREATE TABLE jawaban(id INT AUTO_INCREMENT PRIMARY KEY,soal_id INT,teks TEXT,is_benar TINYINT(1) DEFAULT 0,FOREIGN KEY(soal_id) REFERENCES soal(id) ON DELETE CASCADE);
CREATE TABLE nilai(id INT AUTO_INCREMENT PRIMARY KEY,user_id INT NULL,jenis VARCHAR(120),skor INT DEFAULT 0,created_at DATETIME DEFAULT CURRENT_TIMESTAMP,FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE SET NULL);
CREATE TABLE prestasi(id INT AUTO_INCREMENT PRIMARY KEY,user_id INT NULL,nama VARCHAR(120),deskripsi TEXT,created_at DATETIME DEFAULT CURRENT_TIMESTAMP,FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE);
CREATE TABLE badge(id INT AUTO_INCREMENT PRIMARY KEY,nama VARCHAR(120),ikon VARCHAR(255),syarat VARCHAR(255));
CREATE TABLE sertifikat(id INT AUTO_INCREMENT PRIMARY KEY,user_id INT NULL,nomor VARCHAR(80),file VARCHAR(255),created_at DATETIME DEFAULT CURRENT_TIMESTAMP,FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE);
CREATE TABLE setting(id INT AUTO_INCREMENT PRIMARY KEY,kunci VARCHAR(100) UNIQUE,nilai LONGTEXT);
CREATE TABLE log_aktivitas(id BIGINT AUTO_INCREMENT PRIMARY KEY,user_id INT NULL,aktivitas VARCHAR(255),created_at DATETIME DEFAULT CURRENT_TIMESTAMP);
INSERT INTO users(nama,username,password,role) VALUES
('Administrator','admin','$2y$12$XqgEI1tAw/j010y50Y7sYuKva7De67uxlzpJSXtwRvz0gStX918zu','admin'),
('Siswa Demo','siswa','$2y$12$QIKO/FTColREDRFjqOzWUOGjodOEWSK.unsMrS6cxnGxdN1zs0NNm','siswa');
INSERT INTO kategori_materi(nama,slug) VALUES ('Penguatan Karakter','karakter'),('Pola Hidup Sehat','sehat'),('Numerasi','numerasi');
INSERT INTO materi(kategori_id,judul,slug,ringkasan,konten) VALUES
(1,'Disiplin','disiplin','Kebiasaan mematuhi aturan dan melakukan hal benar.','Belajar disiplin di rumah, sekolah, dan lingkungan.'),
(1,'Jujur','jujur','Berkata dan bertindak sesuai kenyataan.','Kejujuran membuat hati tenang dan dipercaya.'),
(1,'Tanggung Jawab','tanggung-jawab','Melaksanakan tugas dengan sebaik-baiknya.','Tanggung jawab membuat kita mandiri dan dapat diandalkan.'),
(2,'Pola Hidup Sehat','pola-hidup-sehat','Kebiasaan untuk menjaga kesehatan tubuh dan pikiran.','Sarapan, cuci tangan, makanan bergizi, air putih, dan olahraga.'),
(3,'Numerasi Kelas 4','numerasi-kelas-4','Bilangan cacah, operasi hitung, dan pengukuran.','Materi numerasi dasar kelas 4.'),
(3,'Numerasi Kelas 5','numerasi-kelas-5','Pecahan, faktor, bangun datar, dan perbandingan.','Materi numerasi kelas 5.'),
(3,'Numerasi Kelas 6','numerasi-kelas-6','Operasi campuran, skala, dan HOTS.','Materi numerasi kelas 6.');
INSERT INTO permainan(judul,jenis,level) VALUES ('Kuis Aritmatika','numerasi','dasar'),('Cocokkan Makanan Sehat','sehat','dasar'),('Cerita Karakter','karakter','dasar');
INSERT INTO setting(kunci,nilai) VALUES ('nama_aplikasi','EduPlay Ceria'),('tagline','Belajar, Bermain, Bertumbuh');
SET FOREIGN_KEY_CHECKS=1;
