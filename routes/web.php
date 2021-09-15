<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\BackController;
use App\Http\Controllers\Auth\FrontController;
use Illuminate\Support\Facades\Route;
use Intervention\Image\ImageManagerStatic;


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

Route::get('/img', function()
{
    $img = ImageManagerStatic::make("about.jpg")->resize(164, 200);
    $img->save();
    return $img->response('jpg');
});

Route::get('/', [FrontController::class, 'home']);
Route::get('/lien-he', [FrontController::class, 'contact']);
Route::get('/ve-chung-toi', [FrontController::class, 'about']);
Route::get('/xu-huong-thoi-trang', [FrontController::class, 'trend']);
Route::get('/{slug}.html', [FrontController::class, 'slugHTML'])->middleware('Filter');
Route::get('/khuyen-mai', [FrontController::class, 'discount']);
Route::get('/tim-kiem', [FrontController::class, 'search']);
Route::post('/dang-ky-nhan-tin-khuyen-mai', [FrontController::class, 'subEmail']);
Route::post('/gui-email-lien-he', [FrontController::class, 'contactSendEmail']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::prefix('admin')->group(function(){
    Route::middleware(['auth'])->group(function(){
        Route::get('/home', [BackController::class, 'home']);

        Route::get('/logout1', [AuthenticatedSessionController::class, 'destroy1']);
      
        //Staff
            Route::prefix('staff')->group(function () {
                Route::get('/profile', [BackController::class, 'staff_profile']);
                Route::post('/profile', [BackController::class, 'staff_profile_post']);
                Route::get('/list', [BackController::class, 'staff_list'])->name('staff_list');
                Route::get('/add', [BackController::class, 'staff_add']);
                Route::post('/add', [BackController::class, 'staff_add_post']);
                Route::get('/edit/{id}', [BackController::class, 'staff_edit']);
                Route::post('/edit/{id}/{role_id}', [BackController::class, 'staff_edit_post']);
                // Route::get('/delete/{id}/{role_id}', [BackController::class, 'staff_delete']);
                Route::get('/delete/{id}', [BackController::class, 'staff_destroy']);
                Route::get('/filter', [BackController::class, 'staff_filter']);   
            });
                
        //Cau hinh he thong
            Route::get('/system', [BackController::class, 'system']);
            Route::post('/system', [BackController::class, 'system_post']);

        //Page
            Route::prefix('page')->group(function () {
                Route::get('/list', [BackController::class, 'page_list']);
                Route::post('/edit/{id}', [BackController::class, 'page_edit_post']);
                Route::get('/edit/{id}', [BackController::class, 'page_edit'])->name('page_edit');
            });


            Route::prefix('social')->group(function () {
                Route::get('/list', [BackController::class, 'social_list']);
                Route::post('/edit/{id}', [BackController::class, 'social_edit_post']);
                Route::get('/edit/{id}', [BackController::class, 'social_edit']);
            });

            //tin khuyen mai
            Route::prefix('newletters')->group(function () {
                Route::get('/list', [BackController::class, 'newletters_list']);
                Route::post('/edit/{id}', [BackController::class, 'newletters_edit_post']);
                Route::get('/edit/{id}', [BackController::class, 'newletters_edit']);
                Route::get('/delete/{id}', [BackController::class, 'newletters_delete']);
            });

            //lien he
            Route::prefix('contact')->group(function () {
                Route::get('/list', [BackController::class, 'contact_list']);
                Route::post('/edit/{id}', [BackController::class, 'contact_edit_post']);
                Route::get('/edit/{id}', [BackController::class, 'contact_edit']);
                Route::get('/delete/{id}', [BackController::class, 'contact_delete']);
            });

            //danh sach tin tuc
            Route::prefix('news_cat')->group(function () {
                Route::get('/list', [BackController::class, 'news_cat_list']);
                Route::post('/edit/{id}', [BackController::class, 'news_cat_edit']);
                Route::get('/edit/{id}', [BackController::class, 'news_cat_getedit']);
                Route::get('/delete/{id}', [BackController::class, 'news_cat_delete']);
            });

            Route::prefix('news')->group(function () {
                Route::get('/list', [BackController::class, 'news_list']);
                Route::get('/add', [BackController::class, 'news_add']);
                Route::post('/add', [BackController::class, 'news_add_post']);
                Route::get('/edit/{id}', [BackController::class, 'news_edit']);
                Route::post('/edit/{id}', [BackController::class, 'news_edit_post']);
                Route::get('/delete/{id}', [BackController::class, 'news_delete']);
                Route::post('/delete/{id}', [BackController::class, 'news_destroy']);

                Route::post('/sort/{id}', [BackController::class, 'news_cat_update_sort']);
            });

            //danh sach slide
            Route::prefix('slider')->group(function () {
                Route::get('/list', [BackController::class, 'slider_list']);
                Route::get('/add', [BackController::class, 'slider_add']);
                Route::post('/add', [BackController::class, 'slider_add_post']);
                Route::get('/edit/{id}', [BackController::class, 'slider_edit']);
                Route::post('/edit/{id}', [BackController::class, 'slider_edit_post']);
                Route::get('/delete/{id}', [BackController::class, 'slider_delete']);
                Route::post('/delete/{id}', [BackController::class, 'slider_destroy']);
            });
    });
        

});



