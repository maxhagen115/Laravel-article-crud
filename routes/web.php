<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserPageController;
use Illuminate\Support\Facades\Auth;
use App\Models\Blog;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Authenticatie
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('/registratie', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');

Route::get('/wachtwoord-vergeten', [PasswordController::class, 'forgotPassword'])->name('forgotpwd');
Route::post('verander-wachtwoord', [PasswordController::class, 'PostforgotPassword'])->name('Postforgotpwd');
Route::get('/verander-wachtwoord/{token}', [PasswordController::class, 'ResetPassword'])->name('Resetpwd');
Route::post('reset-password', [PasswordController::class, 'PostresetPassword'])->name('Postresetpwd');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//Profile
Route::get('/profile', [AuthController::class, 'getProfilePage'])->name('profile')->middleware('auth');
Route::post('saveProfileData', [AuthController::class, 'saveProfileData'])->name('saveProfileData')->middleware('auth');
Route::get('/profile/verander-wachtwoord', [AuthController::class, 'veranderWachtwoord'])->name('verander-wachtwoord')->middleware('auth');
Route::post('profile/verander-wachtwoord', [AuthController::class, 'updateWachtwoord'])->name('update-wachtwoord')->middleware('auth');
Route::post('veranderProfilePicure', [AuthController::class, 'veranderProfilePicure'])->name('update-profile-picture')->middleware('auth');
Route::get('/changeStatus', [AuthController::class, 'maakPrive'])->name('maak-prive')->middleware('auth');

// Notfound page
Route::get('/notfound', [AuthController::class, 'notFoundPage'])->name('notfound')->middleware('auth');

Route::get('/', [BlogController::class, 'return_dashboard'])->name('return-dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/blogs', [BlogController::class, 'blogs'])->name('blogs')->middleware('auth');
Route::get('/blog/{id}', [BlogController::class, 'showBlog'])->name('showBlog')->middleware('auth');
Route::get('/add-blog', [BlogController::class, 'addBlog'])->name('add-blog')->middleware('auth');
Route::post('save-blog', [BlogController::class, 'saveBlog'])->name('save-blog')->middleware('auth');
Route::post('update-blog', [BlogController::class, 'updateBlog'])->name('update-blog')->middleware('auth');
Route::get('/edit-blog/{id}', [BlogController::class, 'editBlog'])->name('edit-blog')->middleware('auth');
Route::get('/delete-blog/{id}', [BlogController::class, 'deleteBlog'])->name('delete-blog')->middleware('auth');

Route::get('/users', [UserPageController::class, 'userpage'])->name('userpage')->middleware('auth');
Route::get('/user/{id}', [UserPageController::class, 'showUser'])->name('showUser')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::post('like', [LikeController::class, 'like'])->name('like')->middleware('auth');
    Route::delete('like', [LikeController::class, 'unlike'])->name('unlike')->middleware('auth');
});

Route::fallback(function () {
    if (Auth::check()) {
        return view('notfound');
    } else {
        return redirect('login');
    }
});

// ->middleware(['auth','is_admin'])
