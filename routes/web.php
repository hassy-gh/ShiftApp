<?php

use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\Group\AddAdminController;
use App\Http\Controllers\Admin\Group\NewAdminController;
use App\Http\Controllers\Admin\Group\ProfileController as GroupProfileController;
use App\Http\Controllers\Admin\Group\RegisterController as GroupRegisterController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Employee\Group\JoinController;
use App\Http\Controllers\Employee\Group\ProfileController;
use Illuminate\Support\Facades\Route;

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
    return view('top');
});

// フロント
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['as' => 'employee.'], function () {
    // グループ
    Route::group(['prefix' => 'groups', 'as' => 'group.'], function () {
        Route::get('join', [JoinController::class, 'showJoinForm'])->name('join');
        Route::post('join', [JoinController::class, 'join'])->name('join');
        Route::get('{group_name}', [ProfileController::class, 'showGroupProfile'])->name('profile');
    });
});

// 管理者
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    // 新規登録
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');

    // 認証
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // パスワードリセット
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

    // トップページ
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // グループ
    Route::group(['prefix' => 'groups', 'as' => 'group.'], function () {
        // グループ作成
        Route::get('register', [GroupRegisterController::class, 'showRegisterForm'])->name('register');
        Route::post('register', [GroupRegisterController::class, 'register'])->name('register');
        // プロフィール
        Route::get('{group_name}', [GroupProfileController::class, 'showGroupProfile'])->name('profile');
        // 管理者作成・追加
        Route::get('/new-admin', [NewAdminController::class, 'showNewAdminForm'])->name('new-admin');
        Route::post('/new-admin', [NewAdminController::class, 'newAdmin'])->name('new-admin');
        Route::get('/add-admin', [AddAdminController::class, 'showAddAdminForm'])->name('add-admin');
        Route::post('/add-admin', [AddAdminController::class, 'addAdmin'])->name('add-admin');
    });
});