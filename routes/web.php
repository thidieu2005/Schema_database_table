<?php

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
use App\Http\Controllers\PageControllerController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('index', [
    'as' => 'trangchu',
    'uses' => 'PageController@getIndex'
]);

// Route::get('login', [
//     'as' => 'login',
//     'uses' => 'PageController@getLogin'
// ]);
// Route::get('shop', [
//     'as' => 'shop',
//     'uses' => 'PageController@geShop'
// ]);
// Route::get('detail', [
//     'as' => 'detail',
//     'uses' => 'PageController@getDetail'
// ]);
// Route::get('contact', [
//     'as' => 'contact',
//     'uses' => 'PageController@getContact'
// ]);
use Illuminate\Support\Facades\Schema;

Route::get('database', function () {
    Schema::create('loaisanpham', function ($table) {
        $table->increments('id');
        $table->string('ten', 200);
    });

    return "  ✅ Bảng 'loaisanpham' đã được tạo thành công!";
});

use App\Http\Controllers\TaobangController;

Route::get('create-table', [TaobangController::class, 'createTable']);
Route::get('drop-table', [TaobangController::class, 'dropTable']);
