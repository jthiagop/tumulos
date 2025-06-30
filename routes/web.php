<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LixeiraController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\PessoaFalecidaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TumulosController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('profile/users', UserController::class);
    Route::resource('tumulos', TumulosController::class);
    Route::resource('falecidos', PessoaFalecidaController::class);
    Route::resource('pagamentos', PagamentoController::class);
    Route::get('/pagamentos/{pagamento}/imprimir', [PagamentoController::class, 'imprimirComprovante'])
        ->name('pagamentos.imprimir');

    Route::get('pagamentos-mensais', [DashboardController::class, 'getPagamentosMensaisData'])->name('pagamentosMensais');
    Route::get('distribuicao-descricao', [DashboardController::class, 'getDistribuicaoDescricaoData'])->name('distribuicaoDescricao');

    Route::prefix('lixeira')->group(function () {
        Route::get('/', [LixeiraController::class, 'index'])->name('lixeira.index');
        Route::patch('/{id}/restore', [LixeiraController::class, 'restore'])->name('lixeira.restore');
        Route::delete('/{id}/force-delete', [LixeiraController::class, 'forceDelete'])->name('lixeira.forceDelete');
    });
});

require __DIR__ . '/auth.php';
