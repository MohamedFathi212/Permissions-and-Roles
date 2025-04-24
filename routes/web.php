<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Permissions Routes
    Route::get("permissions",[PermissionController::class , 'index'])->name('permissions.index');
    Route::get("permissions/create",[PermissionController::class , 'create'])->name('permissions.create');
    Route::post("permissions",[PermissionController::class , 'store'])->name( 'permissions.store');
    Route::get("permissions/{id}/edit",[PermissionController::class , 'edit'])->name(  'permissions.edit');
    Route::post("permissions/{id}",[PermissionController::class , 'update'])->name(  name: 'permissions.update');
    Route::delete('/permissions/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');

    // Roles Routes
    Route::get("roles",[RolesController::class , 'index'])->name('roles.index');
    Route::get("roles/create",action: [RolesController::class , 'create'])->name('roles.create');
    Route::post("roles",[RolesController::class , 'store'])->name( 'roles.store');
    Route::get("roles/{id}/edit",[RolesController::class , 'edit'])->name(  'roles.edit');
    Route::post("roles/{id}",[RolesController::class , 'update'])->name(  name: 'roles.update');
    Route::delete('/roles/{id}',  [RolesController::class, 'destroy'])->name('roles.destroy');


        // Articles Routes
    Route::get("articles",[ArticleController::class , 'index'])->name('articles.index');
    Route::get("articles/create", [ArticleController::class , 'create'])->name('articles.create');
    Route::post("articles", [ArticleController::class , 'store'])->name( 'articles.store');
    Route::get("articles/{id}/edit",[ArticleController::class , 'edit'])->name(  'articles.edit');
    Route::post("articles/{id}",[ArticleController::class , 'update'])->name(   'articles.update');
    Route::delete('/articles/{id}',  [ArticleController::class, 'destroy'])->name('articles.destroy');


});

require __DIR__.'/auth.php';
