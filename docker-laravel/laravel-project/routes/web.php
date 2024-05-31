<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EngineerController;
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
    return redirect('/login');
});

// ログアウト処理を実行するルート
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::group(['middleware' => 'web'], function () {
    // ログインが必要なルートにミドルウェアを適用
    Route::middleware(['auth'])->group(function () {
        // エンジニア一覧を表示するためのルート
        Route::get('/engineers', [EngineerController::class, 'index'])->name('engineer.index');
        // エンジニア登録フォームを表示するためのルート
        Route::get('/engineers/create', 'EngineerController@create')->name('engineer.create');
        // エンジニアを検索するためのルート
        Route::post('/engineers/search', 'EngineerController@search')->name('engineer.search');
        // エンジニアの編集フォームを表示するためのルート
        Route::get('/engineers/{engineer}/edit', 'EngineerController@edit')->name('engineer.edit');
        // エンジニアの更新を処理するためのルート
        Route::put('/engineers/{engineer}', 'EngineerController@update')->name('engineer.update');
        // エンジニアを処理するためのルート
        Route::put('/engineers/{engineer}/updateFlag', 'EngineerController@updateFlag')->name('engineer.updateFlag');
        // エンジニアの詳細を表示するためのルート
        Route::get('/engineers/{engineer}', 'EngineerController@show')->name('engineer.show');
        // エンジニアの詳細をスキルシートをPDFに表示するためのルート
        Route::get('/skillsheet/{engineerId}/{fileName}', function ($engineerId, $fileName) {
            $filePath = 'skillsheet/' . $engineerId . '/' . $fileName;
            $file = Storage::disk('public')->get($filePath);
            $fileType = Storage::disk('public')->mimeType($filePath);
            return response($file)->header('Content-Type', $fileType);
        });
        // エンジニアを登録するためのルート
        Route::post('/engineers', 'EngineerController@store')->name('engineer.store');
    });
});

// ログインフォームを表示するルート
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');

// ログイン処理を実行するルート
Route::post('/login', 'Auth\LoginController@login');

// ログインユーザー登録フォームを表示するルート
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');

// ログインユーザー登録処理を実行するルート
Route::post('/register', 'Auth\RegisterController@register');

// パスワードリセットのリクエストフォームを表示するルート
Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');

// パスワードリセットのリクエストを処理するルート
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

// パスワードリセットフォームを表示するルート
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

// パスワードリセットを実行するルート
Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Auth::routes();

