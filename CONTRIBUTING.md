# Guideline untuk Kolaborasi Kode
**Peringatan**<br>
Sebelum mengerjakan proyek, tolong selalu baca file "README.md" dan "CONTRIBUTING.md".<br>
Jangan mengubah/menghapus file "README.md" dan "CONTRIBUTING.md" tanpa izin ketua.

File ini berisi:

* Aturan sebelum anggota melakukan perubahan kode.
* Panduan penggunaan git (push/pull/commit).
* Struktur folder yang harus diikuti.
* Etika dan gaya kode.
* Alur kontribusi supaya tidak bentrok dengan anggota lain.

## Struktur dan Role Tim
Ketua, 1 orang, (setup awal proyek, review pull request, dan merge kode ke branch main).<br>
Frontend, 5 orang, (fokus pada desain antarmuka pengguna).<br>
Backend, 5 orang, (fokus pada logika sistem).<br>
Laporan & Presentasi, 3 orang, (menyusun laporan, membuat presentasi, dan dokumentasi progres).<br>

## Persiapan Awal (Langkah Wajib untuk Semua Anggota)
1. Pastikan laragon sudah aktif, jika belum pencet Start All.
2. PHP, Node.js, Composer, npm, dan Git sudah terinstal.
3. Sudah menerima **invitation** sebagai **collaborator** di Github.
4. Sudah clone proyek dari Github Ketua.

### Jika belum clone proyek
Jika sudah clone proyek, bisa skip ke bagian selanjutnya.<br>
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
6. Install Laravel Breeze dan setup mail
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
7. Membuat symbolic link folder 'storage/app/public' ke 'public/'
```bash
php artisan storage:link
```

## Struktur Folder Proyek dan Tempat Bekerja
* 'app/': Logika backend (controller, model)
* 'database/': Struktur tabel dan data awal
* 'public/build': Folder hasil build frontend **(OTOMATIS, JANGAN DIMODIFIKASI)**
* 'public/images': Folder untuk menaruh aset gambar statis/jarang diubah (Logo website, banner, dll)
* 'resources/views': Tampilan website (Blade template)
* 'resources/css': Kode CSS mentah
* 'resources/js': Kode JS mentah
* 'routes/web.php': Rute URL website
* 'routes/auth.php': Rute untuk sistem autentikasi (dari Laravel Breeze)
* 'storage/app/public': Folder tempat menyimpan file yang diunggah user dan dapat diakses publik (Contoh: Foto profile user)
* 'storage/app/private': Folder tempat menyimpan file yang diunggah user dan tidak boleh diakses publik (Contoh: Bukti payment)

Backend: 'app/', 'database/', dan 'routes/'<br>
Frontend: 'resources/views', 'resources/css', 'resources/js', dan 'public/images'<br>
Ketua: Semua folder<br>
Laporan & Presentasi: 'README.md' dan 'CONTRIBUTING.md'<br>

Jangan mengubah atau menambah file atau folder lain tanpa diskusi ke anggota/tim yang berkaitan.<br>
Folder 'storage/app' digunakan untuk menyimpan hasil unggahan dari user melalui form input html tipe file.<br>

## Cara Kontribusi (Tambah/Edit Fitur)
1. Pastikan proyek lokal anda sudah versi terbaru:
```bash
git pull origin main
```
2. Buat branch baru untuk fitur yang ingin dikerjakan:
```bash
git checkout -b nama_branch
# Contoh git checkout -b homepage_user
```
3. Kerjakan kode di branch tersebut.
4. Setelah selesai:
```bash
git add .
git commit -m "Sesuaikan isi pesan dengan yang dikerjakan"
git push origin nama_branch
```
5. Buka Github, buat Pull Request (PR) ke main. Yang nanti akan direview dan digabungkan jika sudah benar.

## Aturan Penulisan Kode
* Gunakan komentar di setiap fungsi dan logika penting.
* Gunakan nama variabel yang mudah dipahami dan jelas (Contoh: movie_list).
* **Jangan** ubah branch main langsung, kerjakan di branch fitur.
* Satu fitur = satu branch = satu orang.
* Sebelum migrasi besar simpan backup database.
* Pastikan website bisa berjalan tanpa error menggunakan 'npm run dev dan php artisan serve' sebelum push.

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
