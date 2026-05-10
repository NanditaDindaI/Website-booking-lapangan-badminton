## BOOKMINTON - Sistem Booking Lapangan Badminton
Bookminton adalah aplikasi web berbasis Laravel untuk memudahkan proses booking lapangan badminton secara online. Pengguna dapat melihat ketersediaan lapangan, melakukan pemesanan, membayar, dan memberikan ulasan, semua dalam satu platform.

## Fitur Utama
**User/pelanggan **
Registrasi & Login : dengan validasi password (min. 8 karakter, huruf besar, huruf kecil, angka/karakter spesial)
Lihat & Cari Lapangan : filter berdasarkan nama, tipe, dan status ketersediaan
Booking Lapangan : langsung dari halaman detail lapangan
Pembayaran : upload bukti pembayaran (Transfer, Tunai, QRIS)
Notifikasi : booking berhasil, pembayaran diterima, booking dibatalkan, pengingat bayar
Review : beri ulasan dan rating setelah booking selesai (anti-duplikat per pemesanan)
Profil : ubah data diri, ubah password, hapus akun
Auto Expired : booking otomatis expired jika tidak dibayar sebelum batas waktu

** Admin **
Dashboard : statistik total pemesanan, lapangan, dan pelanggan
Kelola Lapangan : tambah, edit, soft delete, restore, dan hard delete permanen
Kelola Jadwal : tambah dan edit slot jadwal lapangan
Konfirmasi Pembayaran : approve/reject bukti pembayaran user
Status Lapangan Otomatis : status lapangan sinkron dengan ketersediaan jadwal

## Teknologi yang digunakan
PHP Framework : Laravel 12
Database : MySQL
Styling UI : Tailwind CSS (CDN)
Local Development Server : Laragon
Backend Language : PHP 8.2

## Cara Instalasi 
Prasyarat :
PHP >= 8.2
Composer
MySQL
Laragon / XAMPP

Langkah instalasi : 
# 1. Clone repository
git clone https://github.com/NanditaDindaI/Website-booking-lapangan-badminton.git
cd Website-booking-lapangan-badminton
# 2. Install dependencies
composer install
# 3. Copy file environment
cp .env.example .env
# 4. Generate application key
php artisan key:generate
# 5. Konfigurasi database di .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bookminton
DB_USERNAME=root
DB_PASSWORD=
# 6. Jalankan migrasi database
php artisan migrate
# 7. Buat storage link untuk upload file
php artisan storage:link
# 8. Jalankan aplikasi
php artisan serve

## Akun default 
Buat akun admin lewat tinker :
php artisan tinker
App\Models\User::create([
    'name'     => 'Admin',
    'email'    => 'admin@bookminton.com',
    'password' => bcrypt('password123'),
    'role'     => 'admin',
]);

role admin : email : admin@bookminton.com ; password : password123

## Entity Relationship Diagram
Tabel utama dalam database:

users — data pengguna (admin & pelanggan)
lapangan — data lapangan badminton (dengan soft delete)
jadwal — slot jadwal per lapangan
pemesanan — data booking oleh user
pembayaran — data pembayaran dan bukti transfer
notifikasi — notifikasi sistem ke user
reviews — ulasan dan rating lapangan per pemesanan

## Alur Penggunaan 

User Register/Login
       ↓
Lihat & Cari Lapangan
       ↓
Pilih Jadwal & Booking
       ↓
Upload Bukti Pembayaran
       ↓
Admin Konfirmasi Pembayaran
       ↓
Status → Lunas 
       ↓
User Beri Review 

## Lisensi
Projek ini dibuat untuk keperluan akademik.
