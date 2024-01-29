<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\User;
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
    if (auth()->check()) {
        return redirect(route('dashboard'));
    }

    return view('auth.login');

});

Route::get('/dashboard', [UserController::class, 'loadDashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('save-chat', [ChatController::class, 'saveChat']);
Route::post('load-receiver-old-chats', [ChatController::class, 'loadOldChats']);

require __DIR__ . '/auth.php';
