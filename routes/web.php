<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\Auth\AuthController;
use App\Http\controllers\BlogController;

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

//ログイン前のユーザーの場合
Route::group(['middleware' => ['guest']], function(){
    //ログインフォーム表示
    Route::get('/', [AuthController::class, 'showLogin'])->name('showLogin');

    //ログイン処理
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    //ユーザー新規登録画面
    Route::get('signup', function(){
        return view('signup.signup');
    })->name('signup');
    
    //ユーザー新規登録
    //Route::get('/signup', [AuthController::class, 'signup'])->name('signup');
});

//ログイン後のユーザーの場合
Route::group(['middleware' => ['auth']], function(){
    //ホーム画面
    Route::get('home', function(){
        return view('home');
    })->name('home');

    //ログアウト
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');


    //ブログ一覧画面を表示
    //Route::get('/', 'BlogController@showList')->name('blogs');
    Route::get('/blog', [BlogController::class, 'showList'])->name('blogs');

    //ブログ登録画面を表示
    Route::get('/blog/create', [BlogController::class, 'showCreate'])->name('create');

    //ブログ登録
    Route::post('/blog/store', [BlogController::class, 'exeStore'])->name('store');

    //ブログ詳細画面を表示
    Route::get('/blog/{id}', [BlogController::class, 'showDetail'])->name('show');

    //ブログ編集画面を表示
    Route::get('/blog/edit/{id}', [BlogController::class, 'showEdit'])->name('edit');

    //ブログ編集
    Route::post('/blog/update', [BlogController::class, 'exeUpdate'])->name('update');

    //ブログ削除
    Route::post('/blog/delete/{id}', [BlogController::class, 'exeDelete'])->name('delete');
});