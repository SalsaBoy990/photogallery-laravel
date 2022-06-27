<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\FileAccessController;
use App\Http\Controllers\GoalController;

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
        Route::get('gallery/create', [GalleryController::class, 'create'])->name('gallery.create');
        Route::post('gallery/store', [GalleryController::class, 'store'])->name('gallery.store');
        Route::get('gallery/{gallery_id}', [GalleryController::class, 'show'])->name('gallery.show');
        

        /* Photos */
        Route::get('photo/{photo_id}', [PhotoController::class, 'show'])->name('photo.show');
        
        Route::get('photo/create/{gallery_id}', [PhotoController::class, 'create'])->name('photo.create');
        Route::post('photo/create', [PhotoController::class, 'store'])->name('photo.store');

        Route::put('photo/update/{photo_id}', [PhotoController::class, 'update'])->name('photo.update');

        Route::resource('goal', GoalController::class);
    }
);

Route::get('/file/{user_id}/cover/{file}', [FileAccessController::class, 'serveCoverImage'])->name('file.serve.cover');
Route::get('/file/{user_id}/photo/{file}', [FileAccessController::class, 'servePhoto'])->name('file.serve.photo');



