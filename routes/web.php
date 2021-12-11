<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;

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

//Estos devuelven vistas
Route::get('/usuarios/crear', 'UserController@create')->name('user.create');
Route::get('usuarios/{user}/editar', 'UserController@edit')->name('user.edit');

Route::get('partidos/crear', 'PartyController@create')->name('party.create');
Route::get('partidos/{party}/editar', 'PartyController@edit')->name('party.edit');

Route::get('candidatos/crear', 'CandidateController@create')->name('candidate.create');
Route::get('candidatos/{candidate}/editar', 'CandidateController@edit')->name('candidate.edit');

Route::get('elecciones/crear', 'ElectionController@create')->name('election.create');
Route::get('elecciones/{election}/editar', 'ElectionController@edit')->name('election.edit');


