# Guideline untuk Kolaborasi Kode
**Peringatan**<br>
Sebelum mengerjakan projek, tolong selalu baca file "README.md" dan "CONTRIBUTING.md".<br>
Jangan mengubah/menghapus file "README.md" dan "CONTRIBUTING.md" tanpa izin ketua.

File ini berisi:

* Aturan sebelum anggota melakukan perubahan kode.
* Panduan penggunaan git (push/pull/commit).
* Struktur folder yang harus diikuti.
* Etika dan gaya kode.
* Alur kontribusi supaya tidak bentrok dengan anggota lain.


## Struktur dan Role Tim
Ketua, 1 orang, (setup awal projek, review pull request, dan merge kode ke branch main).<br>
Frontend, 5 orang, (fokus pada desain antarmuka pengguna).<br>
Backend, 5 orang, (fokus pada logika sistem).<br>
Laporan & Presentasi, 3 orang, (menyusun laporan, membuat presentasi, dan dokumentasi progres).<br>


## Persiapan Awal (Langkah Wajib untuk Semua Anggota)
1. Pastikan laragon sudah aktif, jika belum pencet Start All.
2. PHP, Composer, dan Git sudah terinstal.
3. Sudah menerima **invitation** sebagai **collaborator** di Github.
4. Sudah clone proyek dari Github Ketua.


### Jika belum clone proyek
Jika sudah clone, bisa skip ke bagian selanjutnya.<br>
Diambil dari README.md<br>
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


## Struktur Folder Proyek dan Tempat Bekerja
* 'app/': Logika backend (controller, model)
* 'database/': Struktur tabel dan data awal
* 'public/build': Folder hasil build frontend **(OTOMATIS)**
* 'resources/views': Tampilan website (Blade template)
* 'resources/css': Kode CSS mentah
* 'resources/js': Kode JS mentah
* 'routes/web.php': Rute URL website

Backend: 'app/', 'database/', dan 'routes/'
Frontend: 'resources/views', 'resources/css', 'resources/jss'
Ketua: Semua folder
Laporan & Presentasi: 'README.md' dan 'CONTRIBUTING.md'

Jangan mengubah file atau folder lain tanpa diskusi.

## Cara Kontribusi (Tambah/Edit Fitur)
1. Pastikan proyek lokal anda sudah versi terbaru:
```bash
git pull origin main
```

2. Buat branch baru untuk fitur yang ingin dikerjakan:
```bash
git checkout -b nama_branch
# Contoh
git checkout -b homepage_user
```

3. Kerjakan kode di branch tersebut.

4. Setelah selesai:
```bash
git add.
git commit -m "Sesuaikan isi pesan dengan yang dikerjakan"
git push origin nama_branch
```

5. Buka Github, buat Pull Request (PR) ke main. Yang nanti akan direview dan digabungkan jika sudah benar.


## Aturan Penulisan Kode
* Gunakan komentar di setiap fungsi dan logika penting.
* Gunakan nama variabel yang mudah dipahami dan jelas (Contoh: movie_list).
* **Jangan** ubah main branch langsung, gunakan branch fitur.
* Satu fitur = satu branch.
* Sebelum migrasi besar simpan backup database.
* Pastikan website bisa berjalan tanpa error menggunakan 'php artisan serve' sebelum push.


## Sinkronisasi Harian
Sebelum mulai koding:
```bash
git pull origin main
```

Sesudah selesai koding:
```bash
git pull origin main
git push origin nama_branch
```


## Prosedur jika ada konflik kode
1. Simpan dulu perubahan lokal anda.
2. Hubungi ketua atau tim yang berkaitan.
3. Ketua akan bantu resolve conflict dan merge ulang kode.


## Etika Kolaborasi
Selagi kolaborasi diharap:
* Gunakan bahasa yang sopan.
* Jangan menghapus atau mengubah file orang lain tanpa diskusi.
* Hubungi ketua jika ada konflik kode.
