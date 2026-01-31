## Aplikasi Penyewaan Kamera & Drone

**Laravel • MySQL • Tailwind CSS**

### Deskripsi Proyek

Aplikasi Penyewaan Kamera & Drone adalah sebuah sistem berbasis web yang dibangun menggunakan **Laravel** dan **MySQL** untuk mengelola proses penyewaan alat fotografi seperti kamera dan drone.
Aplikasi ini menyediakan fitur **login multi-role (Admin & Customer)**, manajemen barang, transaksi penyewaan, konfirmasi pembayaran, serta monitoring status sewa secara real-time.

Proyek ini bertujuan untuk mempermudah proses penyewaan, meningkatkan efisiensi pengelolaan data, dan meminimalkan kesalahan pencatatan secara manual.

---

## Fitur Utama

### Customer

* Registrasi & Login akun
* Melihat daftar kamera & drone
* Melakukan penyewaan barang
* Memilih tanggal sewa melalui kalender
* Upload bukti pembayaran
* Melihat status penyewaan
* Mendapat notifikasi **“Bukti peminjaman berhasil dibuat”**

### Admin

* Dashboard statistik (kamera, drone, customer, transaksi aktif)
* Manajemen data barang
* Melihat seluruh transaksi penyewaan
* Konfirmasi / tolak pembayaran
* Update status sewa (Belum Diambil, Aktif, Selesai)
* Menghapus data penyewaan (jika belum aktif/selesai)

---

## Sistem Role

* **Admin**
  Mengelola seluruh data dan transaksi
* **Customer**
  Melakukan penyewaan barang

---

## Status Penyewaan

* `belum_diambil`
* `aktif`
* `selesai`

## Status Pembayaran

* `pending`
* `paid`
* `rejected`

---

## Teknologi yang Digunakan

* **Laravel** (Backend Framework)
* **MySQL** (Database)
* **Tailwind CSS** (UI)
* **Blade Template Engine**
* **Vite**
* **Carbon** (Date & Time)
* **Authentication Laravel (Breeze)**

---

## Cara Menjalankan Proyek

### 1️ Clone Repository

```bash
git clone https://github.com/username/nama-repo.git
cd nama-repo
```

### 2️ Install Dependency

```bash
composer install
npm install
npm run build
```

### 3️ Konfigurasi Environment

```bash
cp .env.example .env
php artisan key:generate
```

Atur database di file `.env`:

```env
DB_DATABASE=sewa_kamera
DB_USERNAME=root
DB_PASSWORD=
```

### 4️ Migrasi Database

```bash
php artisan migrate
```

### 5 Jalankan npm

```bash
npm run dev
```

### 6 Jalankan Server

```bash
php artisan serve
```

Akses aplikasi di:

```
http://localhost:8000
```


---

## Catatan

* Pastikan folder `storage` sudah di-link:

```bash
php artisan storage:link
```

* Upload bukti pembayaran disimpan di:

```
storage/app/public/payment_proofs
```

---

## Tujuan Proyek

* Sebagai **projek pembelajaran Laravel**
* Implementasi CRUD, Auth, dan Role Management
* Cocok untuk **tugas akhir / portofolio**

---

## Pengembang

**Nama:** *SandiPrmj*
**Framework:** Laravel
**Tahun:** 2026

---

<img width="1919" height="949" alt="Screenshot 2026-01-31 171205" src="https://github.com/user-attachments/assets/113b57c2-26eb-42bf-821b-bf2213e5fccb" />
<img width="1919" height="949" alt="Screenshot 2026-01-31 171257" src="https://github.com/user-attachments/assets/46b4a2a4-f363-4093-bcfa-718ab879b6ea" />
<img width="1919" height="948" alt="Screenshot 2026-01-31 171341" src="https://github.com/user-attachments/assets/a6b25554-ce6b-42b2-8eaf-2fead0b0f782" />
<img width="1919" height="949" alt="Screenshot 2026-01-31 171544" src="https://github.com/user-attachments/assets/11caad9e-b1b7-486c-a4bf-bdec562ec97a" />
<img width="1919" height="948" alt="Screenshot 2026-01-31 171607" src="https://github.com/user-attachments/assets/8f6f5eef-453c-452f-bda7-18e8cb6684dc" />
<img width="1919" height="947" alt="Screenshot 2026-01-31 172056" src="https://github.com/user-attachments/assets/96a568d0-1889-4e76-874e-33aa344dea37" />
<img width="1919" height="948" alt="Screenshot 2026-01-31 172416" src="https://github.com/user-attachments/assets/c0aa9fd6-1e0f-44cc-b404-4de17f2282eb" />
<img width="1919" height="946" alt="Screenshot 2026-01-31 172824" src="https://github.com/user-attachments/assets/828e29f0-1b84-4e2f-93d6-0b32d43c32e8" />
<img width="1919" height="948" alt="Screenshot 2026-01-31 172847" src="https://github.com/user-attachments/assets/f4e9f047-a78b-44c7-8d87-83c829604a74" />
<img width="1919" height="948" alt="Screenshot 2026-01-31 172906" src="https://github.com/user-attachments/assets/cc55c303-1b7d-4c65-a971-6ff3a758acaa" />
<img width="1919" height="947" alt="Screenshot 2026-01-31 174648" src="https://github.com/user-attachments/assets/cd0ff5af-9870-48c7-a74b-dbb85f4318f1" />
<img width="1919" height="948" alt="Screenshot 2026-01-31 174806" src="https://github.com/user-attachments/assets/f0490436-ccda-42e5-a8bd-e4df66203a64" />

