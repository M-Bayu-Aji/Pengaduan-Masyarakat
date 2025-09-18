# 🏛️ Pengaduan Masyarakat

[![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?style=for-the-badge&logo=php)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css)](https://tailwindcss.com)
[![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=for-the-badge&logo=mysql)](https://mysql.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge)](LICENSE)

Sistem Pengaduan Masyarakat adalah platform digital yang memungkinkan masyarakat untuk melaporkan berbagai masalah sosial, kejahatan, dan pembangunan di lingkungan mereka. Sistem ini dibangun dengan teknologi modern untuk memberikan pengalaman yang intuitif dan efisien.

## ✨ Fitur Utama

### 👥 **Untuk Masyarakat**
- 📝 **Pembuatan Laporan**: Buat laporan dengan detail lengkap dan lokasi spesifik
- 📍 **Lokasi Terintegrasi**: Sistem lokasi Indonesia dari provinsi hingga desa/kelurahan
- 🖼️ **Upload Gambar**: Lampirkan bukti visual pada laporan
- 📊 **Tracking Status**: Pantau perkembangan laporan secara real-time
- 💬 **Sistem Komentar**: Berinteraksi dengan petugas dan masyarakat lain
- 👍 **Voting System**: Dukung laporan yang penting

### 👨‍💼 **Untuk Petugas/Staf**
- 🏛️ **Manajemen Berdasarkan Wilayah**: Petugas mengelola laporan berdasarkan provinsi
- 📋 **Response Management**: Berikan tanggapan dan update status laporan
- 📈 **Dashboard Analytics**: Pantau statistik dan tren laporan
- 🔄 **Progress Tracking**: Update perkembangan penanganan laporan

## 🛠️ Teknologi yang Digunakan

### Backend
- **Laravel 10.x** - Framework PHP modern dan powerful
- **PHP 8.1+** - Bahasa pemrograman utama
- **MySQL 8.0+** - Database management system

### Frontend
- **Tailwind CSS 3.x** - Utility-first CSS framework
- **Vite** - Build tool yang cepat dan modern
- **Alpine.js** - Framework JavaScript minimalis
- **Font Awesome** - Icon library

### Libraries & Packages
- **Laravel Sanctum** - API authentication
- **Maatswebsite Excel** - Export data ke Excel
- **Barryvdh DOMPDF** - Generate PDF reports
- **Guzzle HTTP** - HTTP client untuk API eksternal

## 📋 Persyaratan Sistem

- **PHP**: 8.1 atau lebih tinggi
- **Composer**: 2.x
- **Node.js**: 16.x atau lebih tinggi
- **NPM**: 8.x atau lebih tinggi
- **MySQL**: 8.0 atau lebih tinggi
- **Web Server**: Apache/Nginx dengan mod_rewrite

## 🚀 Instalasi & Setup

### 1. Clone Repository
```bash
git clone https://github.com/M-Bayu-Aji/Pengaduan-Masyarakat.git
cd pengaduan-masyarakat
```

### 2. Install Dependencies PHP
```bash
composer install
```

### 3. Install Dependencies Node.js
```bash
npm install
```

### 4. Environment Configuration
```bash
cp .env.example .env
```

Edit file `.env` dan sesuaikan konfigurasi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pengaduan_masyarakat
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Generate Application Key
```bash
php artisan key:generate
```

### 6. Database Setup
```bash
# Buat database di MySQL terlebih dahulu
php artisan migrate
php artisan db:seed
```

### 7. Build Assets
```bash
npm run build
# atau untuk development
npm run dev
```

### 8. Storage Link (untuk upload gambar)
```bash
php artisan storage:link
```

### 9. Jalankan Aplikasi
```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## 📊 Struktur Database

### Tabel Utama
- **users**: Data pengguna (masyarakat & petugas)
- **reports**: Laporan pengaduan masyarakat
- **staff_provinces**: Penugasan petugas berdasarkan provinsi
- **responses**: Tanggapan petugas terhadap laporan
- **response_progress**: Tracking progress penanganan
- **comments**: Sistem komentar pada laporan

### Tipe Laporan
- **KEJAHATAN**: Laporan kejahatan dan pelanggaran hukum
- **PEMBANGUNAN**: Masalah infrastruktur dan pembangunan
- **SOSIAL**: Isu-isu sosial dan kesejahteraan masyarakat

## 🎯 Cara Penggunaan

### Untuk Masyarakat
1. **Registrasi**: Daftar akun baru
2. **Login**: Masuk ke sistem
3. **Buat Laporan**: Isi formulir pengaduan dengan lengkap
4. **Upload Bukti**: Lampirkan gambar pendukung
5. **Tracking**: Pantau status laporan
6. **Interaksi**: Berikan komentar dan vote

### Untuk Petugas
1. **Login**: Masuk dengan akun petugas
2. **Dashboard**: Lihat laporan di wilayah tugas
3. **Response**: Berikan tanggapan pada laporan
4. **Update Progress**: Update status penanganan
5. **Export Data**: Export laporan ke Excel/PDF

## 🔧 Perintah Artisan yang Tersedia

```bash
# Migrasi database
php artisan migrate

# Seed database dengan data dummy
php artisan db:seed

# Generate key aplikasi
php artisan key:generate

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Storage link untuk upload
php artisan storage:link

# Export laporan ke Excel
php artisan excel:export reports.xlsx

# Generate PDF laporan
php artisan pdf:generate report.pdf
```

## 🏗️ Arsitektur Aplikasi

```
pengaduan-masyarakat/
├── app/
│   ├── Http/Controllers/
│   │   ├── LoginController.php
│   │   ├── ReportController.php
│   │   └── StaffProvinceController.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Report.php
│   │   ├── StaffProvince.php
│   │   ├── Response.php
│   │   └── Comment.php
│   └── Providers/
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
│   ├── assets/
│   └── storage/ (symlink)
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
│       └── pages/
│           └── report/
├── routes/
│   ├── web.php
│   └── api.php
└── tests/
```

## 🔐 Sistem Autentikasi

- **Multi-role Authentication**: Sistem peran pengguna (masyarakat, petugas)
- **Session Management**: Laravel Sanctum untuk API authentication
- **Middleware Protection**: Route protection berdasarkan status login
- **CSRF Protection**: Perlindungan terhadap serangan CSRF

## 📱 API Endpoints

### Authentication
- `POST /proses/login-proses` - Login pengguna
- `POST /proses/register-proses` - Registrasi pengguna
- `POST /logout` - Logout

### Reports
- `GET /report/create` - Form pembuatan laporan
- `POST /report/proses` - Submit laporan baru
- `GET /report/report-user-me` - Laporan pengguna
- `DELETE /report/hapus-product/{id}` - Hapus laporan
- `GET /report/{id}` - Detail laporan
- `POST /report/comment` - Tambah komentar
- `GET /report/vote/{id}` - Vote laporan

### Staff
- `GET /staff/report` - Dashboard petugas
- `GET /head-staff/report` - Dashboard kepala staf

## 🧪 Testing

```bash
# Jalankan semua test
php artisan test

# Jalankan test spesifik
php artisan test --filter=ReportTest

# Generate test coverage
php artisan test --coverage
```

## 📦 Deployment

### Production Setup
1. **Environment**: Pastikan environment production
2. **Dependencies**: Install dependencies tanpa dev
3. **Assets**: Build dan optimize assets
4. **Database**: Migrate dan seed production data
5. **Cache**: Optimize aplikasi untuk production

```bash
composer install --optimize-autoloader --no-dev
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Server Requirements
- **PHP Extensions**: pdo, mbstring, openssl, tokenizer, xml, ctype, json, bcmath
- **Memory Limit**: Minimum 256MB
- **Upload Size**: Sesuaikan dengan kebutuhan upload gambar
- **SSL Certificate**: Recommended untuk production

## 🤝 Contributing

1. Fork repository
2. Buat branch fitur (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## 📝 License

Distributed under the MIT License. See `LICENSE` for more information.

## 👥 Tim Developer

- **Developer**: M. Bayu Aji
- **Framework**: Laravel Community
- **Contributors**: Welcome to contribute!

## 📞 Support

Jika Anda mengalami masalah atau memiliki pertanyaan:

1. **Issues**: Buat issue di GitHub repository
2. **Documentation**: Baca dokumentasi Laravel
3. **Community**: Bergabung dengan komunitas Laravel Indonesia

## 🔄 Changelog

### Version 1.0.0
- ✅ Sistem autentikasi multi-role
- ✅ CRUD laporan pengaduan
- ✅ Sistem lokasi Indonesia terintegrasi
- ✅ Upload gambar dengan preview
- ✅ Voting dan komentar system
- ✅ Dashboard petugas berdasarkan wilayah
- ✅ Export laporan ke Excel/PDF
- ✅ Responsive design dengan Tailwind CSS

---

<div align="center">
  <p>Dibuat dengan ❤️ menggunakan Laravel Framework</p>
  <p>
    <a href="#pengaduan-masyarakat">Kembali ke atas</a>
  </p>
</div>

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
