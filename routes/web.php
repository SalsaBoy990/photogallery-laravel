<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\FileAccessController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GalleryTagController;

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

Route::get('/', function () {
    return view('guest.welcome');
});


Route::get('/app', [GalleryController::class, 'index'])->middleware(['auth'])->name('app');

require __DIR__ . '/auth.php';


Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'app'],
    function () {
        /* Galleries */
        Route::get('gallery', [GalleryController::class, 'index'])->name('gallery.index');
        Route::post('gallery', [GalleryController::class, 'store'])->name('gallery.store');
        Route::put('gallery/{gallery}', [GalleryController::class, 'update'])->name('gallery.update');
        Route::delete('gallery/{gallery}', [GalleryController::class, 'destroy'])->name('gallery.destroy');
        Route::get('gallery/{gallery}/edit', [GalleryController::class, 'edit'])->name('gallery.edit');
        Route::get('gallery/create', [GalleryController::class, 'create'])->name('gallery.create');
        Route::get('gallery/{gallery}', [GalleryController::class, 'show'])->name('gallery.show');
        Route::get('/gallery/{gallery}/tag/{tag}/attach', [GalleryTagController::class, 'attachTag'])->name('gallery.tag.attach');
        Route::get('/gallery/{gallery}/tag/{tag}/detach', [GalleryTagController::class, 'detachTag'])->name('gallery.tag.detach');

        /* Photos */
        Route::post('photo', [PhotoController::class, 'store'])->name('photo.store');
        Route::get('photo/{photo}', [PhotoController::class, 'show'])->name('photo.show');
        Route::put('photo/{photo}', [PhotoController::class, 'update'])->name('photo.update');
        Route::delete('photo/{photo}', [PhotoController::class, 'destroy'])->name('photo.destroy');
        Route::get('photo/create/{gallery}', [PhotoController::class, 'create'])->name('photo.create');

        // Goals (bucketlist)
        Route::resource('goal', GoalController::class);

        // Tags used for galleries
        Route::resource('tag', TagController::class);

        // User profile
        Route::put('user/change-password', [UserController::class, 'changePassword'])->name('user.change.password');
        Route::resource('user', UserController::class);
    }
);

/* Get images from protected storage path (only owner can access them if logged in) */
Route::get('/file/{user}/{file}', [FileAccessController::class, 'serveUserAvatar'])->name('file.serve.avatar');
Route::get('/file/{user}/cover/{folder}/{file}', [FileAccessController::class, 'serveCoverImage'])->name('file.serve.cover');
Route::get( '/file/{user}/photo/{gallery}/{file}', [FileAccessController::class, 'servePhoto'])->name('file.serve.photo');

/* Get language, set language in session */
Route::get('lang/{locale}', [LocalizationController::class, 'index'])->name('lang.index');

Route::get('/admin', [AdminController::class, 'index'])->middleware(['admin', 'auth'])->name('admin.index');

