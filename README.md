# Sistem Login Aman dengan PHP

## Deskripsi Proyek
Sistem login aman menggunakan PHP dan MySQL dengan fitur enkripsi password, validasi input, dan manajemen sesi yang aman. Didesain untuk keamanan optimal dengan implementasi praktik termantap pengembangan web.

## Fitur
- Enkripsi password menggunakan algoritma modern
- Validasi input yang ketat
- Proteksi terhadap SQL Injection
- Proteksi terhadap XSS (Cross-Site Scripting)
- Interface responsif dengan Bootstrap 5
- Sistem notifikasi yang informatif
- Manajemen sesi yang aman

## Spesifikasi Teknis
- PHP 8.1+
- MySQL 5.7+
- Bootstrap 5.1.3
- PDO untuk koneksi database

## Struktur Database
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## Instalasi
1. Clone repository ini ke direktori web server:
   ```bash
   git clone [url-repository] secure-login
   ```
2. Import database:
   - Buka phpMyAdmin
   - Buat database baru 'secure_login'
   - Import file setup_database.php

3. Konfigurasi database:
   - Buka config/database.php
   - Sesuaikan kredensial database

4. Akses aplikasi:
   ```
   http://localhost/secure-login
   ```

## Panduan Penggunaan
1. Akses halaman login
2. Gunakan kredensial default:
   - Email: test@example.com
   - Password: Test123456
3. Sistem akan memvalidasi input
4. Jika berhasil, akan diarahkan ke halaman sukses


## Cara Kerja Program
1. Proses Login

User memasukkan email dan password
Sistem melakukan validasi format input
Data input dibersihkan untuk mencegah XSS
Password diverifikasi dengan hash di database
Session dibuat jika autentikasi berhasil

2. Security

Password disimpan dalam bentuk hash
Input disanitasi sebelum diproses
Prepared statements untuk mencegah SQL Injection
Validasi email menggunakan filter PHP
Session management yang aman

3. Database

Tabel users menyimpan informasi pengguna
Struktur: id, email, password (hashed), created_at
Menggunakan PDO untuk koneksi database yang aman


## Keamanan
- Password di-hash menggunakan algoritma bcrypt
- Prepared statements untuk mencegah SQL Injection
- Sanitasi input untuk mencegah XSS
- Validasi email menggunakan filter PHP
- Session handling yang aman

## Pengembangan
### Prasyarat
- XAMPP/WAMP/LAMP
- Text editor (VS Code direkomendasikan)
- Git untuk version control

### Setup Development
1. Fork repository
2. Clone ke lokal
3. Buat branch untuk fitur baru
4. Submit pull request

## Troubleshooting
### Masalah Umum
1. Database Connection Error
   - Periksa kredensial database
   - Pastikan service MySQL berjalan

2. Session Error
   - Periksa konfigurasi PHP
   - Pastikan folder tmp dapat ditulis

3. Port Conflict
   - Ubah port di httpd.conf
   - Gunakan port alternatif (8080, 8081)
