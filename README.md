# Website CineFlick 
Repository sistem booking bioskop berbasis website. Repository ini digunakan untuk kolaborasi kode **projek tugas kelompok UAS** mata kuliah **Sistem Basis Data** dan **Pemrograman Web**.<br>

Projek dibuat oleh **Kelompok 2**.<br>

Sebelum mengerjakan projek, tolong selalu baca file "README.md" dan "CONTRIBUTING.md".

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


## Dependensi dan Versi yang Digunakan Projek
Pastikan di projek semua sudah terinstall dan versi sama seperti dibawah, gunakan terminal di laragon untuk mengecek:
* PHP 8.3.26
* Node.js 22.12.0
* npm 10.9.0
* Laravel framework 12.35.1
* Composer 2.8.4
* MySQL 8.4.3
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


## Catatan
Berikut adalah catatan yang bisa dicek untuk informasi lebih lanjut dari projek:
1. Pastikan file ".env" tidak diupload (Cek di isi file ".gitignore" di folder awal projek dengan tulisan ".env, pastikan ada tulisannya) karena ada key yang gak boleh dishare, untuk file ".env.example" boleh diupload karena hanya contoh yang tidak ada key.

2. Gunakan Laragon untuk menghost website secara lokal.

3. Database MySQL yang digunakan tidak sama setiap sistem individu.

4. Jalankan perintah 'npm run dev dan php artisan serve' untuk menjalankan website.

5. Frontend menggunakan npm (Vite) dan backend menggunakan composer (Laravel).


## Kontak
Mohon maaf jika ada kesalahan atau kekurangan. Jika ada yang perlu dikoreksi atau ditambah di file "README.md" dan "CONTRIBUTING.md" tolong berikan info melalui WA ketua.

## Tambahan
Terima kasih kepada semua anggota yang telah berkontribusi. Semoga projek dapat dikerjakan dengan baik, amin.