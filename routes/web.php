<?php

use Illuminate\Support\Facades\Auth;
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
Auth::routes();

//Resources
Route::resource('subjects', App\Http\Controllers\SubjectController::class);
Route::resource('users', App\Http\Controllers\UserController::class);
Route::resource('groups', App\Http\Controllers\GroupController::class);

//Subject routes
//Assign users
Route::get('subjects/{id}/users', [App\Http\Controllers\SubjectController::class, 'subjectShowUsers'])->name('subjects.users.show');
Route::patch('subjects/{id}/users', [App\Http\Controllers\SubjectController::class, 'subjectUpdateUsers'])->name('subjects.users.update');
//Assign groups
Route::get('subjects/{id}/groups', [App\Http\Controllers\SubjectController::class, 'subjectShowGroups'])->name('subjects.groups.show');
Route::patch('subjects/{id}/groups', [App\Http\Controllers\SubjectController::class, 'subjectUpdateGroups'])->name('subjects.groups.update');

//User routes
//Assign roles
Route::get('users/{id}/roles', [App\Http\Controllers\UserController::class, 'userShowRole'])->name('users.roles.show');
Route::patch('users/{id}/roles', [App\Http\Controllers\UserController::class, 'userUpdateRole'])->name('users.roles.update');
//Assign groups
Route::get('users/{id}/groups', [App\Http\Controllers\UserController::class, 'userShowGroup'])->name('users.groups.show');
Route::patch('users/{id}/groups', [App\Http\Controllers\UserController::class, 'userUpdateGroup'])->name('users.groups.update');
//Assign subjects
Route::get('users/{id}/subjects', [App\Http\Controllers\UserController::class, 'userShowSubject'])->name('users.subjects.show');
Route::patch('users/{id}/subjects', [App\Http\Controllers\UserController::class, 'userUpdateSubject'])->name('users.subjects.update');
//Assign parents
Route::get('users/{id}/parents', [App\Http\Controllers\UserController::class, 'userShowParent'])->name('users.parents.show');
Route::patch('users/{id}/parents', [App\Http\Controllers\UserController::class, 'userUpdateParent'])->name('users.parents.update');
//Assign teachers
Route::get('users/{id}/teachers', [App\Http\Controllers\UserController::class, 'userShowTeacher'])->name('users.teachers.show');
Route::patch('users/{id}/teachers', [App\Http\Controllers\UserController::class, 'userUpdateTeacher'])->name('users.teachers.update');

//Group routes
//Assign roles
Route::get('groups/{id}/users', [App\Http\Controllers\GroupController::class, 'groupShowUsers'])->name('groups.users.show');
Route::patch('groups/{id}/users', [App\Http\Controllers\GroupController::class, 'groupUpdateUsers'])->name('groups.users.update');
Route::get('groups/{id}/subjects', [App\Http\Controllers\GroupController::class, 'groupShowSubjects'])->name('groups.subjects.show');
Route::patch('groups/{id}/subjects', [App\Http\Controllers\GroupController::class, 'groupUpdateSubjects'])->name('groups.subjects.update');

//Profile routes
//Edit profile by ID
Route::get('profiles/{id}/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profiles.edit');
Route::patch('profiles/{id}/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profiles.update');
//Show profiles
Route::get('profiles/{id}', [App\Http\Controllers\ProfileController::class, 'show'])->name('profiles.show');
//Index of profile
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
//Edit profile
Route::get('profile/edit', [App\Http\Controllers\ProfileController::class, 'editUserProfile'])->name('profile.edit');
Route::patch('profile/update', [App\Http\Controllers\ProfileController::class, 'updateUserProfile'])->name('profile.update');

//Dashboard
Route::get('/', function () {
    return redirect('dashboard');
});

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
