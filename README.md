# Website CineFlick 
Repository sistem booking bioskop berbasis website. Repository ini digunakan untuk kolaborasi kode **Proyek tugas kelompok UAS** mata kuliah **Sistem Basis Data** dan **Pemrograman Web**.<br>

Proyek dibuat oleh **Kelompok 2**.<br>

Sebelum mengerjakan proyek, tolong selalu baca file "README.md" dan "CONTRIBUTING.md".

Jangan mengubah/menghapus file "README.md" dan "CONTRIBUTING.md" tanpa izin ketua.

Anggota Kelompok:
1. Faishal Danni (3337240072), Ketua.
2. Muhammad Riyan (3337240018), Frontend.
3. Altaf Hafeesa Imtiaz (3337240054), Frontend.
4. Layyinnida Indah Ramadhan (3337240065), Frontend.
5. Hikmah Putri Ayu Fadhilah (3337240069), Frontend.
6. Winata Fadillah Mubarak (3337240091), Frontend.
7. Syahrial Ahmad Yusuf (3337240008), Backend.
8. Rafli Pradipta Ardiansyah (3337240011), Backend.
9. Dzikri Mardhani (3337240038), Backend.
10. Luthfi Eka Saputra (3337240094), Backend.
11. Dewangga Arka Putra (3337240096), Backend.
12. Siti Komariah (3337240045), Laporan & Presentasi.
13. Shenry Charissa (3337240080), Laporan & Presentasi.
14. Gallenina Mahsashera Widodo (3337240099), Laporan & Presentasi.

## Dependensi dan Versi yang Digunakan proyek
Pastikan di proyek semua sudah terinstall dan versi sama seperti dibawah, gunakan terminal di laragon untuk mengecek:
* PHP 8.3.26
* Node.js 22.12.0
* npm 10.9.0
* Laravel framework 12.35.1
* Composer 2.8.4
* MySQL 8.4.3
* Vite 7.1.12
* Git Versi Terbaru

## Tahap Instalasi
Pastikan ikut setiap tahap ini untuk menginstall project ke sistem anda, gunakan terminal di laragon:
1. Masuk ke terminal dan pilih folder seperti dibawah:
```bash
cd C:\laragon\www\
```
2. clone project dari git di bawah:
```bash
git clone https://github.com/FaishalDanni-24/cineflick.git
cd C:\laragon\www\cineflick
```
3. install semua dependensi yang diperlukan:
```bash
composer install
npm install
copy .env.example .env
php artisan key:generate
```
4. Buat database dengan nama "cineflick_db" di phpMyAdmin
5. Jalankan kode ini (php artisan serve bisa diskip kalau website udah bisa diakses dari laragon)
```bash
php artisan migrate
npm run dev
php artisan serve
```
6. Setup mail
```bash
# Menginstall package yang terbaru dari composer dan npm
composer install
npm install
php artisan migrate # Jika sudah ada pesan nothing to migrate, berarti tidak ada tabel baru
```
Tahap selanjutnya diperlukan untuk fitur email seperti (Recovery dari Forgot Password, Verifikasi Email, dll).<br>
**Pastikan Mailpit di laragon sudah jalan.**<br>
Setelah instalasi, pastikan config di ".env" anda dengan nilai berikut:
```txt
MAIL_MAILER=smtp
MAIL_SCHEME=null
MAIL_HOST=localhost # 127.0.0.1
MAIL_PORT=1025 # Sesuaikan dengan port yang ditampilkan di laragon
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="cineflick@testmail.com"
MAIL_FROM_NAME="${APP_NAME}"
```
Lalu jalankan kode ini di terminal laragon, untuk membersihkan cache:
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
# Atau (Bersihkan semua cache)
php artisan optimize:clear
```
7. Membuat symbolic link folder 'storage/app/public'
```bash
php artisan storage:link
```

8. Instruksi cara update akan diberikan lewat WA

## Catatan
Berikut adalah catatan yang bisa dicek untuk informasi lebih lanjut dari proyek:

1. Pastikan file ".env" tidak diupload (Cek di isi file ".gitignore" di folder awal proyek dengan tulisan ".env, pastikan ada tulisannya) karena ada key yang gak boleh dishare, untuk file ".env.example" boleh diupload karena hanya contoh yang tidak ada key.
2. Gunakan Laragon untuk menghost website secara lokal.
3. Database MySQL yang digunakan tidak sama setiap sistem individu.
4. Jalankan perintah 'npm run dev dan php artisan serve' untuk menjalankan website.
5. Frontend menggunakan npm (Vite) dan backend menggunakan composer (Laravel).
6. **Mailpit** digunakan untuk testing sistem pengiriman email secara lokal, untuk mengaksesnya gunakan **'localhost:8025'**. Fitur akan disesuaikan di waktu mendatang.
7. Jika ada update database (terutama struktur), jalankan perintah di bawah:
```bash
# Membuat ulang database cineflick_db dari nol dan mengisi dengan nilai default dari seeders (Catatan: Session dan user akan hilang!)
php artisan migrate:fresh --seed
# Atau jalankan ini jika tidak mau semua data hilang
php artisan migrate
php artisan db:seed
```

## Kontak
Mohon maaf jika ada kesalahan atau kekurangan. Jika ada yang perlu dikoreksi atau ditambah di file "README.md" dan "CONTRIBUTING.md" tolong berikan info melalui WA ketua.

## Tambahan
Terima kasih kepada semua anggota yang telah berkontribusi. Semoga proyek dapat dikerjakan dengan baik, amin.
