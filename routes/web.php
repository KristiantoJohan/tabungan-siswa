<?php

use App\Http\Controllers\AdminSiswaSectionController;
use App\Http\Controllers\AdminTabunganSectionController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Models\Savings;
use App\Models\Students;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/admin/dashboard', function () {
//     return view('admin.dashboard');
// });

Route::get('/student/dashboard', function () {
    $user = auth()->user();

    $savings = Savings::with('user.student.class')
        ->where('user_id', $user->id)
        ->get(); // karena 1 user hanya punya 1 student

        return view('student.dashboard', compact('savings'));
});

// Route::get('/', function () {
//     return view('auth.login');
// });

// Route::get('/admin/siswa', function () {
//     return view('admin.siswa');
// });

// Route::get('/login', [AuthenticationController::class, 'showLoginForm'])->name('login');

// Route::post('/login', [AuthenticationController::class, 'login']);
// Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');

// // Redirect sesuai role
// Route::middleware(['auth', 'isAdmin'])->get('/admin/dashboard', function () {
//     return view('admin.dashboard');
// });

// Route::middleware(['auth', 'isStudent'])->get('/siswa/dashboard', function () {
//     return view('student.dashboard');
// });

Route::get('/', [AuthenticationController::class, 'showLoginForm']);
Route::get('/login', [AuthenticationController::class, 'showLoginForm'])->name('login');

// Redirect sesuai role
Route::middleware(['auth', 'isAdmin'])->get('/admin/dashboard', [DashboardController::class, 'showAdminDashboard'])->name('admin.dashboard');
Route::middleware(['auth', 'isStudent'])->get('/siswa/dashboard', [DashboardController::class, 'showStudentDashboard'])->name('student.dashboard');
Route::middleware(['auth', 'isAdmin'])->get('/admin/siswa', [AdminSiswaSectionController::class, 'showAdminSiswaSection'])->name('admin.siswa');
Route::middleware(['auth', 'isAdmin'])->get('/admin/tabungan', [AdminTabunganSectionController::class, 'showAdminTabunganSection'])->name('admin.tabungan');

Route::post('/login', [AuthenticationController::class, 'login'])->name('post.login');
Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
Route::post('/admin/siswa', [AdminSiswaSectionController::class, 'store'])->name('admin.siswa.store');

Route::patch('/admin/siswa/{id}', [AdminSiswaSectionController::class, 'update'])->name('admin.siswa.update');

Route::delete('/admin/siswa/{id}', [AdminSiswaSectionController::class, 'destroy'])->name('admin.siswa.destroy');