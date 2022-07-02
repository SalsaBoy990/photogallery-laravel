<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\FileAccessController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\TagController;

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
    return view('welcome');
});


Route::get('/app', [GalleryController::class, 'index'])->middleware(['auth'])->name('app');

require __DIR__ . '/auth.php';


Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'app'],
    function () {
        /* Galleries */
        Route::get('gallery', [GalleryController::class, 'index'])->name('gallery.index');
        Route::post('gallery', [GalleryController::class, 'store'])->name('gallery.store');
        Route::get('gallery/create', [GalleryController::class, 'create'])->name('gallery.create');
        Route::get('gallery/{gallery}', [GalleryController::class, 'show'])->name('gallery.show');
        
        /* Photos */
        Route::get('photo/{photo}', [PhotoController::class, 'show'])->name('photo.show');
        Route::post('photo', [PhotoController::class, 'store'])->name('photo.store');
        Route::get('photo/create/{gallery}', [PhotoController::class, 'create'])->name('photo.create');
        Route::put('photo/update/{photo}', [PhotoController::class, 'update'])->name('photo.update');

        // Goals (bucketlist)
        Route::resource('goal', GoalController::class);

        // Tags used for galleries and photos
        Route::resource('tag', TagController::class);
    }
);

/* Get images from protected storage path (only owner can access them if logged in) */
Route::get('/file/{user}/cover/{file}', [FileAccessController::class, 'serveCoverImage'])->name('file.serve.cover');
Route::get('/file/{user}/photo/{file}', [FileAccessController::class, 'servePhoto'])->name('file.serve.photo');

/* Get language, set language in session */
Route::get('lang/{locale}', [LocalizationController::class, 'index'])->name('lang.index');

