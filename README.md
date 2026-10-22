# Website SMK Infokom Bogor

Website sekolah + CMS admin + Portal Siswa, dibangun dengan Laravel (Blade + Tailwind CDN + Alpine.js + AOS). Tidak butuh Node.js/npm — semua library front-end dimuat lewat CDN.

---

## 1. Yang perlu disiapkan di komputer kamu

- PHP 8.2 atau lebih baru
- Composer ([getcomposer.org](https://getcomposer.org))
- MySQL / MariaDB (biasanya sudah termasuk kalau kamu pakai XAMPP/Laragon)
- phpMyAdmin (biasanya sudah termasuk di XAMPP/Laragon)

Kalau belum punya PHP+MySQL, paling gampang install **Laragon** (Windows) atau **XAMPP** (Windows/Mac/Linux) — keduanya sudah termasuk phpMyAdmin.

---

## 2. Cara install project ini

Folder yang aku kirim ini **belum termasuk folder inti Laravel** (vendor/, dan beberapa file bawaan Laravel) karena ukurannya besar dan itu semua di-generate otomatis oleh Composer. Jadi caranya:

### Langkah 1 — Buat project Laravel kosong

Buka terminal/CMD, arahkan ke folder tempat kamu mau simpan project (misal Desktop), lalu jalankan:

```bash
composer create-project laravel/laravel smks-infokom-bogor "^11.0"
```

Tunggu sampai selesai (download beberapa menit tergantung koneksi internet).

### Langkah 2 — Timpa dengan file yang aku kirim

Buka folder `smks-infokom-bogor` yang baru dibuat tadi. Copy **semua isi** folder project yang aku kirim (app/, database/, resources/, routes/, bootstrap/app.php, composer.json, .env.example, storage/app/public/...) ke dalam folder `smks-infokom-bogor`, **timpa/replace** file yang sama.

> Kalau pakai Windows Explorer / Finder: buka 2 folder berdampingan, copy-paste semua folder & file dari paket ini ke folder `smks-infokom-bogor`, pilih "Replace" saat ditanya.

### Langkah 3 — Install ulang dependency (karena composer.json ikut ditimpa)

Di dalam folder `smks-infokom-bogor`:

```bash
composer install
```

### Langkah 4 — Buat file `.env`

```bash
cp .env.example .env
```
(Windows CMD: `copy .env.example .env`)

Lalu generate application key:

```bash
php artisan key:generate
```

---

## 3. Membuat Database di phpMyAdmin

1. Buka **phpMyAdmin** di browser (biasanya `http://localhost/phpmyadmin`)
2. Klik tab **"Databases"** / **"Basis Data"**
3. Di kolom "Create database" / "Buat basis data baru", ketik nama: `smks_infokom`
4. Pilih Collation: `utf8mb4_unicode_ci`
5. Klik **Create** / **Buat**

Selesai — database kosong sudah siap, tidak perlu bikin tabel manual (Laravel yang akan membuatnya lewat migration).

### Sambungkan Laravel ke database itu

Buka file `.env` di folder project, pastikan bagian ini sesuai:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=smks_infokom
DB_USERNAME=root
DB_PASSWORD=
```

(`DB_USERNAME` dan `DB_PASSWORD` sesuaikan dengan punyamu — default XAMPP/Laragon biasanya user `root` tanpa password)

---

## 4. Jalankan migration + isi data awal

Masih di folder project, jalankan:

```bash
php artisan migrate --seed
```

Perintah ini akan otomatis membuat semua tabel **dan** mengisi data awal: data sekolah (NPSN, alamat, dll — data asli terverifikasi), 4 program keahlian, **21 data guru asli beserta foto & mata pelajaran**, beberapa berita/galeri/prestasi/agenda contoh (ditandai `[Contoh]`, boleh dihapus lewat dashboard), dan akun demo.

Lalu buat symbolic link supaya foto/upload bisa tampil di browser:

```bash
php artisan storage:link
```

---

## 5. Jalankan website

```bash
php artisan serve
```

Buka browser ke:

- **Website publik:** http://127.0.0.1:8000
- **Login admin:** http://127.0.0.1:8000/admin/login
- **Login siswa:** http://127.0.0.1:8000/login *(sengaja tidak ada link-nya di website, bagikan URL ini manual ke siswa)*
- **Daftar siswa:** http://127.0.0.1:8000/student/register

---

## 6. Akun Demo (Ganti password ini setelah instalasi!)

| Role | Email | Password |
|---|---|---|
| Admin | admin@smkinfokom.sch.id | admin12345 |
| Guru (demo) | guru@smkinfokom.sch.id | guru12345 |
| Siswa (demo) | siswa@smkinfokom.sch.id | siswa12345 |

Nama akun demo siswa di atas: **Revan Dwi Erlangga**.

21 akun guru asli (dari data yang kamu kasih) juga dibuat otomatis dengan pola email `nama-guru@smkinfokom.sch.id` dan password default `guru12345` — bisa dicek/diubah lewat menu **Guru** di dashboard admin.

---

## 7. Struktur menu Dashboard Admin

- **Dashboard** — ringkasan statistik
- **Pengaturan Website** — edit SEMUA teks/logo/hero/kontak/visi-misi/biaya PPDB (tanpa buka kode)
- **Konten** — Berita (+ opsi link Instagram), Pengumuman, Agenda, Galeri, Video, Prestasi, Program Keahlian, Ekstrakurikuler, Fasilitas
- **Akademik** — Kelas, Mata Pelajaran, Jadwal, Nilai, Kehadiran
- **Pengguna** — Admin/Guru, Siswa (approve pendaftar baru di sini)
- **PPDB & Pesan** — lihat pendaftar PPDB dan pesan dari form kontak

---

## 8. Kalau ada error

- **"could not find driver"** → aktifkan extension `pdo_mysql` di `php.ini`, restart server
- **Foto tidak muncul** → jalankan `php artisan storage:link` lagi
- **Error 419 saat login** → jalankan `php artisan config:clear` lalu coba lagi
- **Halaman putih / blank** → jalankan `php artisan config:clear && php artisan view:clear`, lihat isi `storage/logs/laravel.log` untuk detail error

---

## 9. Catatan penting

**Jadwal Pelajaran kelas XII RPL 2 (terbaru):**
- `database/seeders/ScheduleSeeder.php` — **baru**, mengisi jadwal pelajaran Senin–Jumat kelas XII RPL 2 sesuai data yang diberikan user. Mata pelajaran yang belum ada (Karakter, PWM, Robotik, PABP, dst) otomatis dibuat sebagai data Subject baru. Guru pengampu (teacher_id) sengaja dikosongkan karena belum ditentukan — admin bisa isi manual lewat menu Jadwal. Tampil otomatis di dashboard admin (menu Jadwal, pilih kelas XII RPL 2) dan Portal Siswa (menu Jadwal, untuk siswa yang class-nya XII RPL 2). Data jadwal piket belum diisi karena belum diberikan datanya.


- Ini pakai **Tailwind CSS via CDN**, jadi tidak perlu `npm install` / `npm run build` sama sekali.
- Semua konten publik (teks, gambar, berita, dll) **wajib** diedit lewat dashboard admin — tidak ada yang di-hardcode di kode.
- Data sekolah (NPSN, alamat, akreditasi, statistik siswa/guru) sudah pakai data resmi yang kamu berikan — jangan diubah kecuali memang datanya berubah.
- Data `[Contoh]` (berita, galeri, prestasi, agenda) adalah data demo supaya halaman tidak kosong — silakan diedit/dihapus dan diganti data asli lewat dashboard.

---

## 10. Riwayat Perubahan Sesi Terbaru

**Akun demo siswa masuk kelas XII RPL 2:**
- `database/seeders/ClassMemberSeeder.php` — akun demo siswa (Revan Dwi Erlangga) otomatis di-assign ke kelas XII RPL 2, jadi menu Jadwal/Teman Sekelas/Nilai/Kehadiran di portal siswa nggak kosong lagi

**Link sosial media ditampilkan di Footer & halaman Kontak:**
- `resources/views/layouts/public.blade.php` — ikon Facebook/Instagram/YouTube/WhatsApp muncul di footer (cuma tampil kalau diisi di Pengaturan Website)
- `resources/views/public/contact.blade.php` — tombol "Ikuti Kami" (Facebook/Instagram/YouTube) ditambahkan di halaman Kontak

**Ekstrakurikuler pakai foto, bukan logo kecil:**
- `resources/views/public/extracurricular.blade.php` — bagian atas card sekarang foto penuh (aspect-video), bukan kotak logo kecil lagi. Bagian bawah (nama, pembina, jadwal, deskripsi) tidak berubah
- `resources/views/admin/extracurriculars/form.blade.php` — label field diganti jadi "Foto"

**Kartu Berita/Prestasi/Galeri/Fasilitas: foto jadi background penuh dengan teks overlay:**
- `resources/views/public/home.blade.php` (kartu berita beranda), `resources/views/public/news/index.blade.php`, `resources/views/public/achievements.blade.php`, `resources/views/public/gallery/index.blade.php`, `resources/views/public/facilities.blade.php` — desain kartu diubah total: foto mengisi penuh kartu (rasio 4:5) sebagai background, teks (judul, tanggal, dll) tampil putih di atas gradient gelap di bagian bawah foto
- **Catatan penting:** demi tampilan grid yang rapi & konsisten, kartu jenis ini memakai `object-cover` (foto mengisi penuh area kartu, kemungkinan sedikit terpotong di tepi kalau proporsi foto jauh beda dari 4:5) — ini beda dari aturan "foto tidak pernah di-crop" yang berlaku di foto tunggal (hero, cover jurusan, dll). Kalau kamu nggak mau ada crop sama sekali di kartu-kartu ini juga, kasih tau, nanti aku ubah ke mode letterbox (foto utuh + ruang kosong) seperti sebelumnya.

**Logo admin & login sekarang ikut logo yang diupload di Pengaturan Website:**
- `resources/views/layouts/admin.blade.php`, `resources/views/layouts/student.blade.php` — logo di sidebar admin & sidebar Portal Siswa sekarang ambil dari Pengaturan Website → Umum → Logo (sebelumnya hardcode teks "SI")
- `resources/views/auth/admin-login.blade.php`, `resources/views/auth/student-login.blade.php`, `resources/views/auth/student-register.blade.php` — logo di halaman login admin, login siswa, dan daftar siswa juga ikut logo yang sama
- Kalau logo belum diupload, semua tempat ini tetap tampil badge "SI" seperti biasa (fallback), jadi upload sekali di Pengaturan Website otomatis kepakai di navbar publik + sidebar admin + sidebar siswa + semua halaman login

**Ganti semua "SMKS" jadi "SMK":**
- 28 file (blade, controller, seeder, README) — semua tulisan "SMKS" diganti "SMK" secara konsisten

**Statistik sekolah bisa diedit dari dashboard:**
- `app/Http/Controllers/Admin/SettingController.php`, `resources/views/admin/settings/index.blade.php` — tab baru "Statistik Sekolah" untuk edit Akreditasi, Jumlah Guru, Siswa Laki-laki/Perempuan, Rombongan Belajar, Ruang Kelas, Laboratorium, Perpustakaan (sebelumnya angka ini cuma ada di seeder, tidak bisa diedit dari admin)

**Foto showcase mengikuti bentuk aslinya (bukan dipaksa rasio tertentu):**
- `resources/views/public/home.blade.php` — foto Hero beranda, foto Tentang Kami, dan foto Kepala Sekolah sekarang auto-height mengikuti proporsi asli foto yang diupload, dengan batas aman max 600px (400px khusus foto Kepala Sekolah) supaya tidak terlalu tinggi kalau fotonya sangat portrait — foto tetap 100% utuh, tidak dipotong
- `resources/views/public/programs/show.blade.php` — foto Cover Jurusan sama, auto-height mengikuti bentuk asli dengan batas aman 600px
- Grid thumbnail (Berita, Galeri, Prestasi, Fasilitas) **sengaja tidak diubah** — tetap pakai rasio seragam (aspect-video/aspect-square) supaya grid-nya rapi sejajar; foto tetap tidak dipotong (di-letterbox dalam frame seragam), cuma bentuknya konsisten karena memang tampil sebagai daftar/grid
- Halaman **Data Guru sengaja tidak disentuh** sama sekali di revisi ini

**Foto showcase (hero, tentang kami, kepala sekolah, cover jurusan) ikut bentuk asli foto:**
- `resources/views/public/home.blade.php` (hero, foto Tentang Kami, foto Kepala Sekolah), `resources/views/public/programs/show.blade.php` (foto cover jurusan) — container sekarang otomatis menyesuaikan tinggi sesuai proporsi asli foto yang diupload (landscape/portrait/kotak), dengan batas atas ~600px (400px khusus foto kepala sekolah) cuma sebagai jaring pengaman untuk foto berproporsi ekstrem — foto tetap selalu utuh, tidak pernah dipotong
- **Sengaja TIDAK diubah**: thumbnail grid (Berita, Galeri, Prestasi, Fasilitas) tetap pakai rasio seragam supaya barisnya rapi sejajar — foto tetap tidak dipotong (masih object-contain, cuma di-letterbox dalam frame seragam), dan halaman **Data Guru sengaja tidak disentuh sama sekali** sesuai permintaan

**Fix ukuran upload logo jurusan (5MB):**
- `app/Http/Controllers/Admin/ProgramController.php` — batas upload logo dinaikkan dari 1MB jadi 5MB (`max:1024` → `max:5120`)

**Fix card foto cover jurusan yang meluber:**
- `resources/views/public/programs/show.blade.php` — container foto cover di halaman detail Program Keahlian sekarang punya tinggi tetap (420px) dengan foto ditampilkan utuh di tengah (letterbox kalau proporsinya tidak pas) — foto tidak pernah kepotong dan ukurannya tidak lagi membengkak mengikuti resolusi asli file

**Fix bug redirect /admin/login & /login:**
- `bootstrap/app.php` — ditambahkan `redirectUsersTo()` supaya user yang sudah login otomatis diarahkan ke dashboard sesuai role (bukan balik ke homepage) saat membuka halaman guest login

**Logo Jurusan (ganti badge kode teks):**
- `database/migrations/..._create_programs_table.php` — tambah kolom `logo`
- `app/Models/Program.php`, `app/Http/Controllers/Admin/ProgramController.php`, `resources/views/admin/programs/form.blade.php` — field upload Logo Jurusan (terpisah dari foto cover)
- `resources/views/public/home.blade.php`, `resources/views/public/programs/index.blade.php` — tampilkan logo kalau ada, fallback ke badge kode kalau logo belum diupload

**Link di kartu Prestasi:**
- `database/migrations/..._create_achievements_table.php` — tambah kolom `link`
- `app/Models/Achievement.php`, `app/Http/Controllers/Admin/AchievementController.php`, `resources/views/admin/achievements/form.blade.php` — field Link (opsional)
- `resources/views/public/achievements.blade.php` — tombol "Lihat Sumber" muncul di kartu kalau link diisi

**Marquee (kartu auto-scroll):**
- `resources/views/layouts/public.blade.php` — CSS animasi marquee baru (jalan terus ke kiri, loop mulus, pause saat di-hover)
- `resources/views/public/home.blade.php` (section Program Keahlian), `resources/views/public/achievements.blade.php` (bagian atas) — diterapkan marquee, HANYA di dua bagian ini

**Redesign halaman Akademik:**
- `resources/views/public/academic.blade.php` — hero gradient + blob, 4 card dengan nomor 01–04 & hover effect, section statistik (dari data sekolah asli), tombol CTA modern, animasi scroll halus

**Redesign total halaman PPDB:**
- `resources/views/public/ppdb.blade.php` — hero lebih besar dengan statistik, alur pendaftaran jadi timeline bernomor, section biaya (kalau diisi admin), form lebih rapi, tambah FAQ accordion

**Upgrade UI halaman dropdown "Informasi":**
- `resources/views/public/agenda.blade.php`, `teachers.blade.php`, `gallery/index.blade.php`, `videos.blade.php`, `extracurricular.blade.php`, `facilities.blade.php` — hero dengan blob & badge, hover-lift, border dipertegas, animasi AOS lebih variatif

**Fitur roster kelas (khusus Portal Siswa & Admin, TIDAK tampil di publik):**
- `database/migrations/..._create_class_members_table.php`, `app/Models/ClassMember.php` — tabel baru khusus daftar nama teman sekelas (bukan akun login)
- `app/Http/Controllers/Admin/ClassMemberController.php`, `resources/views/admin/class-members/*.blade.php` — CRUD admin, menu "Pengurus/Anggota Kelas"
- `app/Http/Controllers/Student/ClassmatesController.php`, `resources/views/student/classmates.blade.php` — halaman "Teman Sekelas" di portal siswa (cuma tampil untuk siswa yang sekelas)
- `database/seeders/ClassMemberSeeder.php` — **baru**, roster kelas XII RPL 2 (28 nama & peran) sesuai data yang kamu kirim

> **Catatan penting soal data kelas XII RPL 2:** data yang kamu kirim cuma berisi nama panggilan & peran (Ketua Kelas/Sekretaris/dst), tanpa NISN atau email asli. Sesuai prinsip "jangan mengarang data", aku TIDAK membuat akun login (NISN/email) palsu untuk 28 nama itu — mereka cuma tampil sebagai daftar nama (read-only) di Portal Siswa & admin, bukan akun yang bisa login sendiri. Kalau nanti kamu mau mereka masing-masing punya akun login beneran, tinggal kasih NISN + email asli tiap siswa, nanti aku buatkan akunnya lewat menu Siswa di admin (bukan menu Pengurus Kelas ini). Foto juga belum keisi (tidak bisa diambil dari screenshot) — bisa diupload manual lewat menu **Pengurus/Anggota Kelas** di admin.

---

## 11. Riwayat Perubahan Sesi Sebelumnya (revisi kedua)

**Login siswa disembunyikan dari tampilan publik:**
- `routes/web.php` — URL login siswa dipindah jadi **`/login`** (bukan `/student/login`), tidak dipasang di route group `student` lagi
- `resources/views/layouts/public.blade.php` — tombol "Portal Siswa" dihapus total dari navbar desktop & menu mobile
- Tidak ada satupun link ke halaman login di tampilan publik — siswa harus diberi tahu URL `/login` secara manual oleh sekolah

**Logo navbar jadi bulat:**
- `resources/views/layouts/public.blade.php` — logo/inisial "SI" di navbar sekarang `rounded-full` (bulat penuh), siap dipakai untuk logo asli yang nanti diupload lewat dashboard

**Foto tidak pernah di-crop (berlaku di semua halaman):**
- Semua `object-cover` diganti `object-contain` di seluruh halaman publik (beranda, program keahlian, berita, prestasi, galeri, fasilitas, ekskul, data guru) dan beberapa halaman admin/portal siswa — foto selalu tampil utuh, kalau proporsi tidak pas kotak akan ada padding warna latar, bukan dipotong

**Tema navy/biru (bukan monokrom, bukan biru pastel):**
- Semua `layouts/*.blade.php` dan `auth/*.blade.php` dan `errors/*.blade.php` — palet warna diganti navy medium-tua (`#1e40af`/`#172554`) dengan aksen biru (`#0ea5e9`)

**Border kartu dipertegas:**
- Semua kartu/box konten di halaman publik (Akademik, PPDB, Kontak, Prestasi, Fasilitas, dll) — border tipis nyaris tak terlihat diganti border hitam tipis (`border-slate-900/15`) supaya kartu terlihat jelas dari latar terang, tapi tetap halus (bukan border tebal)

**Link Instagram di halaman detail berita:**
- `resources/views/public/news/show.blade.php` — tombol "Lihat Postingan Asli di Instagram" muncul di halaman detail kalau berita itu ada link Instagram-nya (sebelumnya cuma aktif di kartu beranda/daftar berita)

**Halaman Akademik, PPDB, Kontak dipercantik:**
- `resources/views/public/academic.blade.php` — didesain ulang dengan ikon per kartu, animasi AOS bertahap, tombol CTA ke Agenda/Berita
- `resources/views/public/ppdb.blade.php` — hero dengan blob animasi, kartu info dengan ikon, hover-lift
- `resources/views/public/contact.blade.php` — kartu kontak dengan ikon per item, hover-lift, form lebih menonjol

**Nama akun demo siswa:**
- `database/seeders/UserSeeder.php` — nama akun demo siswa diganti jadi "Revan Dwi Erlangga" (email & password tetap sama: siswa@smkinfokom.sch.id / siswa12345)

---

## 12. Riwayat Perubahan Awal (build pertama)

**Data Guru (21 guru + foto, tanpa sapaan Pak/Bu, mapel per guru):**
- `database/migrations/..._create_teachers_table.php` — tambah kolom `subjects`
- `app/Models/Teacher.php` — tambah field `subjects` + accessor `subjects_list`
- `app/Http/Controllers/Admin/TeacherController.php` — tambah handling field `subjects`
- `resources/views/admin/teachers/form.blade.php` — tambah textarea Mata Pelajaran
- `database/seeders/TeacherSeeder.php` — **baru**, 21 data guru + foto (dicocokkan dari file yang kamu kirim)
- `storage/app/public/teachers/*.png` — 21 foto guru yang sudah dicocokkan by name
- `app/Http/Controllers/Public/TeacherController.php` — **baru**
- `resources/views/public/teachers.blade.php` — **baru**, halaman publik Data Guru (`/guru`)
- `routes/web.php` — tambah route `/guru`

**Link Instagram di Berita (form & kartu):**
- `database/migrations/..._create_news_table.php` — tambah kolom `instagram_url`
- `app/Models/News.php`, `app/Http/Controllers/Admin/NewsController.php`, `resources/views/admin/news/form.blade.php` — tambah field Link Instagram
- `resources/views/public/home.blade.php`, `resources/views/public/news/index.blade.php` — klik berita ke Instagram (tab baru) kalau link diisi, badge "Instagram" pada kartu

**Navbar disederhanakan (dropdown "Informasi"):**
- `resources/views/layouts/public.blade.php` — Prestasi/Galeri/Video/Ekstrakurikuler/Fasilitas/Agenda/Data Guru dikelompokkan ke satu dropdown

**Pengaturan tambahan:**
- `app/Http/Controllers/Admin/SettingController.php`, `resources/views/admin/settings/index.blade.php` — tambah field Jam Operasional, WhatsApp (Humas), Gambar Tentang Kami (terpisah dari Hero), tab baru Biaya PPDB per Gelombang
- `database/seeders/SchoolSettingSeeder.php` — update nama & foto Kepala Sekolah, isi Jam Operasional

**Konten demo diperbanyak:**
- `database/seeders/NewsSeeder.php` (2→5), `AchievementSeeder.php` (1→5), `GallerySeeder.php` (1→5), `ExtracurricularSeeder.php` (1→5), `EventSeeder.php` (1→5), `AnnouncementSeeder.php` (1→3)

**Animasi tambahan:**
- `resources/views/layouts/public.blade.php` — efek blob mengambang di hero, fade-in halaman, hover-lift pada kartu, badge shimmer
