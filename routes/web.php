<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('usuarios/', 'UserController@index')->name('user.index');
Route::get('usuarios/crear', 'UserController@create')->name('user.create');
Route::post('usuarios/crear', 'UserController@store')->name('user.store');
Route::get('usuarios/{user}', 'UserController@show')->name('user.show');
Route::get('usuarios/{user}/editar', 'UserController@edit')->name('user.edit');
Route::patch('usuarios/{user}/editar', 'UserController@update')->name('user.update');
Route::delete('usuarios/{user}', 'UserController@destroy')->name('user.destroy');

Route::get('candidatos/', 'CandidateController@index')->name('candidate.index');
Route::get('candidatos/crear', 'CandidateController@create')->name('candidate.create');
Route::post('candidatos/crear', 'CandidateController@store')->name('candidate.store');
Route::get('candidatos/{candidate}', 'CandidateController@show')->name('candidate.show');
Route::get('candidatos/{candidate}/editar', 'CandidateController@edit')->name('candidate.edit');
Route::patch('candidatos/{candidate}/editar', 'CandidateController@update')->name('candidate.update');
Route::delete('candidatos/{candidate}', 'CandidateController@destroy')->name('candidate.destroy');

Route::get('partidos/', 'PartyController@index')->name('party.index');
Route::get('partidos/crear', 'PartyController@create')->name('party.create');
Route::post('partidos/crear', 'PartyController@store')->name('party.store');
Route::get('partidos/{party}', 'PartyController@show')->name('party.show');
Route::get('partidos/{party}/editar', 'PartyController@edit')->name('party.edit');
Route::patch('partidos/{party}/editar', 'PartyController@update')->name('party.update');
Route::delete('partidos/{party}', 'PartyController@destroy')->name('party.destroy');

Route::get('elecciones/', 'ElectionController@index')->name('election.index');
Route::get('elecciones/crear', 'ElectionController@create')->name('election.create');
Route::post('elecciones/crear', 'ElectionController@store')->name('election.store');
Route::get('elecciones/{election}', 'ElectionController@show')->name('election.show');
Route::get('elecciones/{election}/editar', 'ElectionController@edit')->name('election.edit');
Route::patch('elecciones/{election}/editar', 'ElectionController@update')->name('election.update');
Route::delete('elecciones/{election}', 'ElectionController@destroy')->name('election.destroy');
