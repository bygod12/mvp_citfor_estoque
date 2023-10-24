<?php

use App\Http\Controllers\api\CategoriumController;
use App\Http\Controllers\api\LoginController;
use App\Http\Controllers\api\ProdutoController;
use App\Http\Controllers\api\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {

    Route::resource('/produto', ProdutoController::class);

    Route::resource('/categoria', CategoriumController::class);

    Route::resource('/venda', VendaController::class);

    Route::resource('/doacao', DoadorController::class);

    Route::resource('/funcionario', FuncionarioController::class);

    Route::resource('/cliente', VendaController::class);

});
// Rota de login
Route::post('/login', [LoginController::class, 'login']);

// Rota de registro
Route::post('/register', [RegisterController::class, 'register']);

// Rotas autenticadas (exemplo)
Route::middleware('auth:sanctum')->group(function () {
    // Rota protegida
    Route::get('/user', function () {
        return Auth::user();
    });

    // Outras rotas protegidas aqui
});
