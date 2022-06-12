<?php

use App\Http\Controllers\TarefaController;
use App\Mail\MensagemTesteMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
    return view('bem-vindo');
});

Auth::routes(['verify' => true]);

Route::get('tarefa/exportacao/{extensao}', [TarefaController::class, 'exportacao'])->name('tarefa.exportacao');

Route::get('tarefa/exportar', [TarefaController::class, 'exportar'])->name('tarefa.exportar');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Route::resource('tarefa', TarefaController::class)->middleware(['verified', 'auth']); // ao invés de implamentamos no controlador o middleware podemos fazê-lo diretamente pela a rota 

Route::get('/mensagem-teste', function(){
   // return new MensagemTesteMail();
   Mail::to('di0g0v4sc0ncel0s@gmail.com')->send(new MensagemTesteMail());
   return "email enviado com sucesso";
});



