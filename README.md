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
# Sesuaikan dengan folder instalasi laragon masing-masing
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
4. Buat data (php artisan serve bisa diskip kalau website udah bisa diakses dari laragon)
```bash
php artisan migrate # Jika ditanya seperti ini, Database cineflick_db does not exist. Do you want to create it? pilih yes
php artisan db:seed
npm run dev # Menjalankan vite untuk frontend (Jika lagi developing)
npm run build # Membuat folder build di public (Untuk Hosting)
php artisan serve
```
5. Setup file ".env"
Di file ".env", selain di bagian mail (tahap 6). Pastikan nilainya yang ada di file seperti ini:
```txt
APP_URL=https://cineflick.test # Sesuaikan dengan URL website

DB_CONNECTION=mysql
DB_HOST=127.0.0.1 # Sesuaikan dengan alamat host database
DB_PORT=3306 # Sesuaikan port database
DB_DATABASE=cineflick_db
DB_USERNAME=root # Sesuaikan dengan username ke database
DB_PASSWORD= # Jika database mysql ada password, masukkan passwordnya
```
6. Lalu jalankan kode ini di terminal laragon, untuk membersihkan semua cache:
```bash
php artisan optimize:clear
```
7. Membuat symbolic link folder 'storage/app/public' untuk data gambar poster dan makanan & minuman
```bash
php artisan storage:link
```

## Catatan
Berikut adalah catatan yang bisa dicek untuk informasi lebih lanjut dari proyek:

1. Pastikan file ".env" tidak diupload (Cek di isi file ".gitignore" di folder awal proyek dengan tulisan ".env, pastikan ada tulisannya) karena ada key yang gak boleh dishare, untuk file ".env.example" boleh diupload karena hanya contoh yang tidak ada key.
2. Gunakan Laragon untuk menghost website secara lokal selama development.
3. Database MySQL yang digunakan tidak sama setiap sistem individu.
4. Jalankan perintah 'npm run dev dan php artisan serve' setiap menjalankan website lokal **(WAJIB)**.
5. Frontend menggunakan npm (Vite) dan backend menggunakan composer (Laravel).
6. Jika ada update database (terutama struktur), jalankan perintah di bawah:
```bash
# Membuat ulang database cineflick_db dari nol dan mengisi dengan nilai default dari seeders (Catatan: Session dan user akan hilang!)
php artisan migrate:fresh --seed
# Atau jalankan ini jika tidak mau semua data hilang
php artisan migrate
php artisan db:seed
```
7. **Jangan mengubah file ".env.example"**, file ini adalah file contoh .env yang dishare ke repo.
8. Jika ada kendala saat baru mulai mengerjakan (belum ada melakukan coding), silahkan coba install ulang.
9. Jangan lupa untuk menjalankan git pull origin main setiap sebelum dan sesudah mengerjakan kode agar progres  proyek di sistem masing-masing tetap terupdate.

## Kontak
Mohon maaf jika ada kesalahan atau kekurangan. Jika ada yang perlu dikoreksi atau ditambah di file "README.md" dan "CONTRIBUTING.md" tolong berikan info melalui WA ketua.

## Tambahan
Terima kasih kepada semua anggota yang telah berkontribusi. Semoga proyek dapat dikerjakan dengan baik, amin.<br>
Berikut adalah file untuk melihat referensi progres proyek:<br>
<a href="https://docs.google.com/document/d/1jCS7-8fVJhjv4X_mvjQG8Z2XSomctwMPMPOBasBEF2Q/edit?usp=sharing">Progres CineFlick</a><br>
Dan berikut link untuk file data gambar di website, agar bisa tampil:<br>
<a href="https://drive.google.com/drive/folders/1RyHxmVgmkuFqpJSpmLI_YX1n-yLJAjSO">Proyek CineFlick</a><br>
Download folder poster dan FoodDrink lalu copy ke folder storage/app/public<br>
