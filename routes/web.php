<?php

use App\Http\Controllers\ArahanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\GejalaKePenyakitController;
use App\Http\Controllers\GejalaRuleController;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KeputusanRuleController;
use App\Http\Controllers\KompartementController;
use App\Http\Controllers\PenyakitController;
use App\Http\Controllers\PenyakitKeGejalaController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\TampilGejalaController;
use App\Http\Controllers\TampilPenyakitController;
use App\Http\Controllers\TampilRuleController;
use App\Http\Controllers\UserController;
use App\Models\departement;
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

Route::get('/', function () {
    return view('pages.auth.login');
})->middleware(['guest']);

// matikan route ini jika .env email sudah di seting
Route::get('/forgot-password', function () {
    return redirect()->back();
})->name('password.request')->middleware(['guest']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::put('/change-profile-avatar', [DashboardController::class, 'changeAvatar'])->name('change-profile-avatar');
    Route::delete('/remove-profile-avatar', [DashboardController::class, 'removeAvatar'])->name('remove-profile-avatar');
    Route::resources(['arahan' => ArahanController::class]);
    Route::resources(['hasil' => HasilController::class]);
    Route::get('/hasil/{id}/review', [HasilController::class, 'review'])->name('review');
    Route::put('/hasil/{id}/next', [HasilController::class, 'next'])->name('next');
    Route::get('/komdashboard/{id}', [DashboardController::class, 'komdashboard'])->name('komdashboard');

    Route::middleware(['can:superadmin'])->group(function () {
        Route::resources(['user' => UserController::class]);
        Route::resources(['kompartement' => KompartementController::class]);
        Route::resources(['department' => DepartementController::class]);
        Route::resources(['jabatan' => JabatanController::class]);
        Route::get('/get-departments/{kompartement_id}', [UserController::class, 'getDepartments'])->name('get.departments');
    });


    //  Route::middleware(['can:user'])->group(function () {
    // });
});
