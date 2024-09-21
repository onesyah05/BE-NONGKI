# BE-NONGKI - Backend API dengan Laravel, JWT, dan Redis

Proyek ini adalah aplikasi backend sederhana yang dibangun menggunakan **Laravel**, dengan **JWT** untuk autentikasi dan **Redis** untuk caching serta rate-limiting. Aplikasi ini menyediakan fitur dasar seperti **autentikasi** (login, signup, logout), serta **CRUD** untuk mengelola profil pengguna.

## Fitur Utama
- **Autentikasi JWT**: Login, Signup, Logout.
- **CRUD Profil**: Mengelola profil pengguna yang terhubung dengan akun.
- **Redis**: Digunakan untuk caching dan rate limiting.
- **SOLID Principles**: Mengikuti prinsip pengembangan yang baik.
- **Design Patterns**: Clean architecture dan penggunaan pattern sesuai kebutuhan.

## Requirements
- PHP >= 7.4
- Composer
- MySQL atau MariaDB
- Redis
- Node.js (opsional untuk manajemen asset front-end)

## Instalasi

### 1. Clone Repository
Clone repository ini ke dalam direktori lokal Anda:
```bash
git clone https://github.com/onesyah05/BE-NONGKI
cd BE-NONGKI
```
### 2. Install Dependensi
Jalankan perintah berikut untuk menginstal semua dependensi PHP yang diperlukan:
```bash
composer install
```
### 3. Install Dependensi
Jalankan perintah berikut untuk menginstal semua dependensi PHP yang diperlukan:
```bash
composer install
```
### 4. Konfigurasi `.env`
Salin file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```
Kemudian, buka file `.env` dan sesuaikan pengaturan berikut dengan konfigurasi lokal Anda:
-   Database (`DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`)
-   Redis (`REDIS_HOST`, `REDIS_PASSWORD`, `REDIS_PORT`)

Jangan lupa untuk menghasilkan **APP_KEY** dan kunci JWT:
```bash
php artisan key:generate
php artisan jwt:secret
```
### 5. Migrasi Database
Salin file `.env.example` menjadi `.env`:
```bash
php artisan migrate
```

### 5. Jalankan Redis
Pastikan Redis sudah berjalan. Anda dapat memulai Redis dengan perintah:
```bash
redis-server
```
### 5. Jalankan Aplikasi
Pastikan Redis sudah berjalan. Anda dapat memulai Redis dengan perintah:
```bash
php artisan serve
```
Aplikasi akan berjalan di `http://127.0.0.1:8000`.

## Endpoint API

### 1. Autentikasi

-   **POST** `/api/login`: Login dan mendapatkan token JWT.

| field |type  | required|desc|
|--|--|--|--|
|name  | string | true |...|
|email  | string | true |...|
-   **POST** `/api/signup`: Mendaftarkan pengguna baru.	

| field |type  | required|desc|
|--|--|--|--|
|name  | string | true |...|
|email  | string | true |...|
|password  | string | true |max:`225`|
|password_confirmation  | string | true |max:`225`|

-   **POST** `/api/logout`: Logout dan menghapus token dari cache.

### 2. Profil

-   **GET** `/api/profile`: Melihat profil pengguna yang terautentikasi.
-   **PUT** `/api/profile`: Memperbarui data profil pengguna.

| field |type  | required|desc|
|--|--|--|--|
|full_name| string | true |...|
|address| string | true |...|
|gender| string | true |`Male` atau `Female`|
|marital_status| string | true |`Single` atau `Married` `default:` **Single** |
-   **DELETE** `/api/profile`: Menghapus profil pengguna.

Semua endpoint profil dilindungi oleh autentikasi JWT. Anda harus mengirimkan token JWT di header `Authorization` dengan format:
`Authorization: Bearer <token_jwt>`

## Tools dan Teknologi

-   **Laravel 9**: Framework PHP untuk aplikasi web.
-   **JWT (JSON Web Token)**: Untuk autentikasi pengguna.
-   **Redis**: Untuk caching dan rate-limiting.
-   **MySQL/MariaDB**: Sebagai database utama.

## ERD
![GAMBAR ERD Sederhana](https://i.ibb.co.com/6JJ42TM/ERD.png)