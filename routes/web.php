<?php

use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VacanteController;
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

Route::get('/', HomeController::class)->name('home');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/dashboard', [VacanteController::class, 'index'])-> middleware(['rol.reclutador'])->name('vacantes.index');
    Route::get('/vacantes/create', [VacanteController::class, 'create'])->name('vacantes.create');
    Route::get('/vacantes/edit/{vacante_id}', [VacanteController::class, 'edit'])->name('vacantes.edit');
    Route::get('/candidatos/{vacante}', [CandidatoController::class, 'index'])->name('candidatos.index');
});

// {{-- no autenticado --}}
Route::get('/vacantes/{vacante_id}', [VacanteController::class, 'show'])->name('vacantes.show');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Notificaciones
Route::get('/notificaciones', NotificacionController::class)->middleware('auth', 'verified', 'rol.reclutador')->name('notificaciones');


require __DIR__ . '/auth.php';
