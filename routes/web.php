<?php

use App\Http\Controllers\CategoriumController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DoadorController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\LojaController;
use App\Http\Controllers\VendaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdutoController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
//Route::group(['middleware' => 'auth'], function () {
//    Route::get('/home', [HomeController::class, 'index'])->name('home');
//
//    Route::get('/produto/dados', [ProdutoController::class, 'dados'])->name('produto.dados');
//    Route::resource('/produto', ProdutoController::class);
//
//    Route::get('/categoria/dados', [CategoriumController::class, 'dados'])->name('categoria.dados');
//    Route::resource('/categoria', CategoriumController::class);
//
//    Route::group(['middleware' => 'admin'], function () {
//        Route::get('/doacao/dados', [DoadorController::class, 'dados'])->name('doacao.dados');
//        Route::resource('/doacao', DoadorController::class);
//
//        Route::get('/funcionario/dados', [FuncionarioController::class, 'dados'])->name('funcionario.dados');
//        Route::resource('/funcionario', FuncionarioController::class);
//
//    });
//
//});


    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/produto/dados', [ProdutoController::class, 'dados'])->name('produto.dados');
    Route::resource('/produto', ProdutoController::class);

    Route::get('/categoria/dados', [CategoriumController::class, 'dados'])->name('categoria.dados');
    Route::resource('/categoria', CategoriumController::class);

    Route::get('/doacao/dados', [DoadorController::class, 'dados'])->name('doacao.dados');
    Route::resource('/doacao', DoadorController::class);

    Route::get('/funcionario/dados', [FuncionarioController::class, 'dados'])->name('funcionario.dados');
    Route::resource('/funcionario', FuncionarioController::class);

    Route::get('/venda/dados', [VendaController::class, 'dados'])->name('venda.dados');
    Route::resource('/venda', VendaController::class);

    Route::get('/cliente/dados', [ClienteController::class, 'dados'])->name('cliente.dados');
    Route::resource('/cliente', ClienteController::class);

    Route::get('/profile', [LojaController::class, 'index'])->name('profile');
