<p align="center">
  <a href="#" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300">
  </a>
</p>

<h2 align="center">Laravel E-Commerce</h2>

<p align="center">
A simple and modern e-commerce & transaction management system built with <strong>Laravel</strong> and <strong>Livewire</strong>.
</p>

---

## Deskripsi Singkat

Aplikasi ini merupakan sistem manajemen transaksi dan profil pengguna berbasis Laravel + Livewire.  
Fitur inti meliputi autentikasi, edit profil, manajemen alamat, pemesanan, checkout, dan dashboard user.  
Dirancang dengan UI modern, validasi real-time, serta SweetAlert2 untuk notifikasi interaktif.

---

## Fitur Utama

- **Authentication System (Login & Register)**
- **Edit Profile + Upload Foto**
- **Manajemen Alamat Pengguna**
- **Order & Checkout System**
- **Status Transaksi (Pending, Shipped, Accepted, dll)**
- **Livewire Real-Time Validation**
- **UI Interaktif dengan SweetAlert2**
- **Upload File (Foto Profil, Bukti Pembayaran)**
- **Notifikasi Toast Success menggunakan SweetAlert**

---

## 🛠 Teknologi yang Digunakan

- **Laravel 12**
- **Livewire v3**
- **MySQL / MariaDB**
- **Blade Template**
- **SweetAlert2**
- **Bootstrap**

---

## Struktur Folder Utama


---

## ⚙️ Cara Instalasi Project

1. **Clone repository**
   ```bash
   git clone https://github.com/username/nama-project.git
   cd nama-project
2. **Install dependencies**
   ```bash
   composer install
3. **Copy file environment**
   ```bash
   cp .env.example .env
4. **Generate key**
   ```bash
   php artisan key:generate
5. **Atur konfigurasi database di file .env**
   ```bash
   DB_DATABASE=e-commerce
   DB_USERNAME=root
   DB_PASSWORD=
6. **Jalankan migrasi**
   ```bash
   php artisan migrate
6. **Link storage**
   ```bash
   php artisan storage:link


---

## Cara Menjalankan Project

1. **Jalankan server Laravel**
   ```bash
   php artisan serve



