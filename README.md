# SmartAsset Hub

SmartAsset Hub merupakan pengembangan dari project **Smart-Hub Management System** yang dikembangkan pada tahap sebelumnya. 
Aplikasi ini berfokus pada pengembangan **Frontend Services berbasis Web Application** menggunakan Laravel 13 dan Inertia.js dengan integrasi API Backend.

Project ini dibuat untuk memenuhi kebutuhan pengembangan sistem manajemen aset/peralatan yang memiliki fitur autentikasi, pengelolaan data master, transaksi peminjaman, serta validasi proses bisnis.

## Teknologi yang Digunakan

### Backend
- Laravel 13
- Laravel REST API
- Laravel Sanctum (Token Authentication)
- PostgreSQL Database
- Supabase Cloud Database

### Frontend
- Laravel Inertia.js
- Vue.js 3
- Vite
- Tailwind CSS

### Development Tools
- Git Version Control
- Composer
- Node.js & NPM


## Fitur Utama

### Authentication
- Login menggunakan API Authentication
- Register user
- Logout menggunakan Laravel Sanctum Token
- Validasi user


### Dashboard
- Menampilkan informasi jumlah aset/peralatan
- Menampilkan jumlah kategori
- Monitoring status peminjaman


### Manage Data Master

#### Category Management
- Menampilkan daftar kategori
- Menambah data kategori
- Menghapus data kategori


#### Equipment Management
- Menampilkan data peralatan
- Menambah data peralatan
- Mengubah data peralatan
- Menghapus data peralatan


### Transaction Management
- Melakukan transaksi peminjaman peralatan
- Menampilkan daftar transaksi
- Update status transaksi
- Validasi data check-in peralatan


## Arsitektur Sistem

Project menggunakan konsep pemisahan layanan antara backend services dan frontend services.
