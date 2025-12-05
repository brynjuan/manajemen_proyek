# Sistem Absensi Rapat Berbasis QR Code 

![Laravel](https://img.shields.io/badge/Laravel-11-red) ![Tailwind CSS](https://img.shields.io/badge/Tailwind-CSS-blue) ![Status](https://img.shields.io/badge/Status-Completed-success)

Sistem manajemen absensi rapat digital yang dirancang untuk efisiensi dan akurasi tinggi. Aplikasi ini memungkinkan administrator untuk mengelola rapat dan anggota, serta memungkinkan proses absensi cepat menggunakan pemindaian QR Code (Scan Gun/Device) secara real-time.

Aplikasi ini telah dioptimalkan untuk penggunaan mobile (responsif) dan siap untuk environment production.

## 🌟 Fitur Utama

### 🛡️ Panel Admin
* **Dashboard Statistik:** Visualisasi data rapat, total anggota, dan tren kehadiran menggunakan grafik interaktif (Chart.js).
* **Manajemen Anggota:** CRUD lengkap dengan fitur pencarian, filter (Prodi/Angkatan), dan import data masif (Seeding).
* **Manajemen Rapat:** Membuat rapat, memantau status (*ongoing/finished*), dan menutup sesi rapat.
* **Scanning Absensi:** Halaman khusus scan QR Code yang mendukung input dari *Scanner Gun* dengan fitur *auto-focus*, validasi real-time, dan pencegahan input ganda (*debounce*).
* **Laporan & Ekspor:** Rekapitulasi kehadiran per rapat dan fitur ekspor ke PDF siap cetak (A4).
* **Absensi Manual:** Fitur *fallback* untuk mencatat kehadiran anggota secara manual jika tidak membawa QR Code.

### 👤 Panel Anggota
* **QR Code Pribadi:** Identitas unik berbasis UUID untuk setiap anggota.
* **Riwayat Kehadiran:** Daftar rapat yang telah dihadiri.
* **Profil Pengguna:** Manajemen data diri.

## 🛠️ Teknologi yang Digunakan

**Backend:**
* **Framework:** Laravel 11 (PHP 8.2)
* **Database:** MySQL (Local) / PostgreSQL (Production)
* **Authentication:** Manual Auth implementation (Controller & Middleware based).
* **Libraries:**
    * `simplesoftwareio/simple-qrcode` (QR Generation)
    * `barryvdh/laravel-dompdf` (PDF Export)

**Frontend:**
* **Styling:** Tailwind CSS (via Vite)
* **Charting:** Chart.js
* **Scripting:** Vanilla JavaScript (AJAX scanning logic, Debounce, Interactive UI).

**Infrastruktur:**
* **Deployment:** Railway
* **Web Server:** Nginx (via Nixpacks)

## ⚙️ Instalasi dan Pengaturan Lokal

Ikuti langkah berikut untuk menjalankan proyek di komputer lokal Anda:

1.  **Clone Repositori**
    ```bash
    git clone [https://github.com/username/repo-name.git](https://github.com/username/repo-name.git)
    cd repo-name
    ```

2.  **Instal Dependensi**
    ```bash
    composer install
    npm install
    ```

3.  **Konfigurasi Environment**
    Salin file `.env.example` menjadi `.env` dan sesuaikan kredensial database Anda.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Migrasi dan Seeding Data**
    Jalankan migrasi database dan isi data dummy (Angkatan 2020-2024).
    ```bash
    php artisan migrate --seed
    ```
    *Catatan: Seeder menggunakan metode `upsert` untuk mencegah duplikasi data.*

5.  **Jalankan Aplikasi**
    Buka dua terminal terpisah untuk menjalankan server Laravel dan Vite.
    ```bash
    php artisan serve
    ```
    ```bash
    npm run dev
    ```

## 🗃️ Struktur Database

Sistem ini menggunakan relasi **Many-to-Many** antara `Users` dan `Meetings` melalui tabel pivot `Attendances`.

* **Users:** Menyimpan data anggota (NIM, QR Data [UUID], Role, dll). Indexing diterapkan pada kolom `nim` dan `qr_data`.
* **Meetings:** Menyimpan data rapat dan status (`ongoing`, `finished`).
* **Attendances:** Mencatat waktu kehadiran (`attended_at`) dengan validasi unik pair `user_id` + `meeting_id`.

## 👥 Tim Pengembang

Proyek ini diselesaikan dalam waktu 4 minggu oleh tim berikut:

| Peran | Nama | NIM | Tanggung Jawab Utama |
| :--- | :--- | :--- | :--- |
| **PROJECT MANAGER** | Briant Juan Hamonangan | F55123030 | Pembuatan repo, Evaluasi code sebelum masuk main, Deployment Railway, Membagi tugas dan mengatur anggota. |
| **Backend 1** | Fahril Antonio Hande | F55123031 | Inisiasi Laravel, Model & Eloquent, Meeting Logic, Reporting. |
| **Backend 2** | Zaky Putera Safandra | F55123011 | Authentication, Role Middleware, QR Logic. |
| **Frontend 1** | Putri Cassiola Mokondongan | F55123008 | Setup Tailwind, Layouting, Dashboard UI, Mobile Responsiveness. |
| **Frontend 2** | Fransisca Aprilia Tarabu | F55123012 | Auth Pages, CRUD UI, Scan Interface, UX improvements. |
| **Database** | Aura Nayla Djogja | F55123043 | ERD Design, Migrations, Seeding Strategy, Optimization. |
| **UI/UX** | Mahreczy | F55123007 | Prototyping, Design System, User Flow. |

## 📄 Lisensi

[MIT License](LICENSE)

### **Link Desain Figma**
Link Figma: [Klik Disini](https://www.figma.com/design/FfWxavdqFPC0nIC0O4u82O/Responsive-Startup-Website--Community-?node-id=0-1&t=lidtvAcAtmypm2Ko-1)
