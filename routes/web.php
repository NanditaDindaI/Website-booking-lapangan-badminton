<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;

// ================= LANDING =================
Route::get('/', function () {
    return view('welcome');
});

// ================= AUTH =================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ================= ADMIN =================
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // 🔥 Konfirmasi Pembayaran
    Route::get('/konfirmasi', [AdminController::class, 'konfirmasiIndex'])->name('admin.konfirmasi');
    Route::post('/konfirmasi/{id}/approve', [AdminController::class, 'approve'])->name('admin.approve');
    Route::post('/konfirmasi/{id}/reject', [AdminController::class, 'reject'])->name('admin.reject');
});

// ================= ADMIN KELOLA =================
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('lapangan', LapanganController::class)->except(['index', 'show']);
    Route::resource('jadwal', JadwalController::class)->except(['index']);
});

// ================= USER =================
Route::middleware(['auth'])->group(function () {

    // Lapangan & Jadwal (read-only untuk user)
    Route::resource('lapangan', LapanganController::class)->only(['index', 'show']);
    Route::resource('jadwal', JadwalController::class)->only(['index']);

    // 🔥 Booking dari lapangan
    Route::get('/lapangan/{id}/book', [PemesananController::class, 'bookFromLapangan'])->name('lapangan.book');

    // Pemesanan
    Route::resource('pemesanan', PemesananController::class);

    // Pembayaran
    Route::get('/pembayaran/create/{pemesanan_id}', [PembayaranController::class, 'create'])->name('pembayaran.create');
    Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');

    // Notifikasi
    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
    Route::get('/notifikasi/read-all', [NotifikasiController::class, 'markAllRead'])->name('notifikasi.readAll');
    Route::get('/notifikasi/{id}/read', [NotifikasiController::class, 'markRead'])->name('notifikasi.read');

    // Review
    Route::get('/review', [ReviewController::class, 'index'])->name('review.index');
    Route::post('/review', [ReviewController::class, 'store'])->name('review.store');

    // ================= PROFILE (NEW) =================
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    //================= DELETE =========================
    Route::delete('/profile/delete', [ProfileController::class, 'deleteAccount'])->name('profile.delete');
});