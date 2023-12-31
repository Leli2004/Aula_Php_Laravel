<?php

use Illuminate\Support\Facades\Route;
//importar o arquivo do controlador
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AlunoController;

//chamar uma função do controlador
Route::get('/usuario', [UsuarioController::class, 'index']);

//rota aluno
//carrega uma listagem do dados do banco
Route::get('/aluno',
    [AlunoController::class, 'index'])->name('aluno.index');

 //chama o formulário aluno
Route::get('/aluno/create',
    [AlunoController::class, 'create'])->name('aluno.create');

 //realiza a ação de salvar os dados do fomulário
Route::post('/aluno',
    [AlunoController::class, 'store'])->name('aluno.store');

//chama o formulário para edição
Route::get('/aluno/edit/{id}', //passar o ID na edição
    [AlunoController::class, 'edit'])->name('aluno.edit');

 //realiza a ação de atualizar os dados do formulário
Route::put('/aluno/update/{id}',
    [AlunoController::class, 'update'])->name('aluno.update');

//chama o método para excluir o registro
Route::get('/aluno/destroy/{id}',
    [AlunoController::class, 'destroy'])->name('aluno.destroy');

//chama o método search para pesquisar e filtar o registro da listagem
Route::post('/aluno/search',
    [AlunoController::class, 'search'])->name('aluno.search');

//chamar uma página em HTML
Route::get('/pagina', function () {
    return view('index');
});

//chama um HTML
Route::get('/teste', function () {
    return "<h4>Olá Mundo Laravel!</h4>";
});


Route::get('/', function () {
    return view('welcome');
});
