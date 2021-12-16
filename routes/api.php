<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\ElectionCandidateController;
use App\Http\Controllers\PartyController;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/usuarios', [UserController::class,'index'])->name('users');//Devuelve todos los usuarios
Route::post('/usuarios/crear', [UserController::class,'store'])->name('users.create');//Crea un usuario
Route::get('/usuarios/{user}', [UserController::class,'show'])->name('user.show');//Devuelve un solo usuario
Route::patch('/usuarios/{user}', [UserController::class,'update'])->name('user.update');//Se le mandan los datos por raw
Route::delete('/usuarios/{user}', [UserController::class,'destroy'])->name('user.destroy');//Eliminar un usuario


Route::get('/partidos', [PartyController::class,'index'])->name('parties');//Devuelve todos los partidos
Route::post('/partidos/crear', [PartyController::class,'store'])->name('parties.create');//Crea un partido
Route::get('/partidos/{id}', [PartyController::class,'show'])->name('parties.show');//Devuelve un solo partido
Route::patch('/partidos/{id}', [PartyController::class,'update'])->name('parties.update');//Modificar partido
Route::delete('/partidos/{id}', [PartyController::class,'destroy'])->name('parties.destroy');//Eliminar un partido


Route::get('/elecciones', [ElectionController::class,'index'])->name('election.index');
Route::post('/elecciones/crear', [ElectionController::class,'store'])->name('election.store');
Route::get('/elecciones/{election}', [ElectionController::class,'show'])->name('election.show');
Route::patch('/elecciones/{election}', [ElectionController::class,'update'])->name('election.update');
Route::delete('/elecciones/{election}', [ElectionController::class,'destroy'])->name('election.destroy');


Route::get('/candidatos', [CandidateController::class,'index'])->name('candidate.index');
Route::post('/candidatos/crear', [CandidateController::class,'store'])->name('candidate.store');
Route::get('/candidatos/{candidate}', [CandidateController::class,'show'])->name('candidate.show');
Route::patch('/candidatos/{candidate}', [CandidateController::class,'update'])->name('candidate.update');
Route::delete('/candidatos/{candidate}', [CandidateController::class,'destroy'])->name('candidate.destroy');



//Reportes
Route::get('/reporteListado', [UserController::class,'ListarVotantes'])->name('reportes.uno');
Route::get('/reporteEleccion/{fecha}', [ElectionController::class,'BuscarFecha'])->name('reportes.dos');

Route::get('/reporteEleccionResultados/{id}', [ElectionController::class,'Resultados'])->name('reportes.tres');

Route::get('/reporteListadoElecciones', [ElectionController::class,'Listar'])->name('reportes.cuatro');
Route::get('/reporteListadoEleccionesVotante/{id}', [UserController::class,'BuscarVotos'])->name('reportes.cinco');
Route::get('/reporteListadoPromedio', [UserController::class,'VotantesPromedio'])->name('reportes.seis');
Route::get('/reporteListadoPartidos', [PartyController::class,'PartidosOrden'])->name('reportes.siete');
Route::get('/reporteListadoEdad', [UserController::class,'VotantesEdad'])->name('reportes.ocho');

