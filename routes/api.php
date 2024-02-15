<?php

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\ProfissionalController;
use App\Http\Controllers\ServicoController;
use App\Http\Middleware\IsAuthenticated;
use App\Http\Middleware\SetSanctumGuard;
use Illuminate\Http\Request;
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
//Serviços
Route::post('servico/cadastro', [ServicoController::class, 'criarServico']);
Route::get('servico/descricao', [ServicoController::class, 'pesquisarPorDescricao']);
Route::get('servico/all',[ServicoController::class, 'retornarTodos']);
Route::post('servico/pesquisa/nome', [ServicoController::class, 'pesquisarPorNome']);
Route::delete('servico/delete/{id}', [ServicoController::class, 'excluirServico']);
Route::put('servico/update', [ServicoController::class, 'atualizarServico']);
Route::get('servico/find/{id}', [ServicoController::class, 'pesquisarPorId']);

//Clientes
Route::post('cliente/cadastrar', [ClienteController::class, 'criarCliente']);
Route::get('cliente/all', [ClienteController::class, 'retornarTodos']);
Route::post('cliente/find/nome', [ClienteController::class, 'pesquisarPorNome']);
Route::delete('cliente/delete/{id}', [ClienteController::class, 'excluirCliente']);
Route::put('cliente/update', [ClienteController::class, 'atualizarCliente']);
Route::get('cliente/find/cpf', [ClienteController::class, 'pesquisarPorCpf']);
Route::get('cliente/find/celular', [ClienteController::class, 'pesquisarPorTelefone']);
Route::get('cliente/find/email', [ClienteController::class, 'pesquisarPorEmail']);
Route::get('cliente/find/{id}', [ClienteController::class, 'pesquisarPorId']);
Route::post('cliente/atualizar/senha', [ClienteController::class, 'esqueciMinhaSenha']);

//Profissional
Route::post('profissional/cadastrar', [ProfissionalController::class, 'criarProfissional']);
Route::get('profissional/all', [ProfissionalController::class, 'retornarTodos']);
Route::post('profissional/find/nome', [ProfissionalController::class, 'pesquisarPorNome']);
Route::delete('profissional/delete/{id}', [ProfissionalController::class, 'excluirProfissional']);
Route::put('profissional/update', [ProfissionalController::class, 'atualizarProfissional']);
Route::get('profissional/find/cpf', [ProfissionalController::class, 'pesquisarPorCpf']);
Route::get('profissional/find/celular', [ProfissionalController::class, 'pesquisarPorTelefone']);
Route::get('profissional/find/email', [ProfissionalController::class, 'pesquisarPorEmail']);
Route::get('profissional/find/{id}', [ProfissionalController::class, 'pesquisarPorId']);
Route::post('profissional/atualizar/senha', [ProfissionalController::class, 'esqueciMinhaSenha']);
Route::post('profissional/agendamento',[AgendaController::class,'criarHorarioProfissional' ]);
Route::delete('profissional/agenda/delete/{id}',[AgendaController::class,'excluirHorario']);
Route::put('profissional/agenda/atualizar/horarios', [AgendaController::class,'updateHorarios']);
Route::get('profissional/agenda/find/datas', [AgendaController::class, 'pesquisarPorData']);
Route::post('profissional/cadastrar/cliente',[ClienteController::class,'criarCliente']);
Route::put('profissional/cliente/update', [ClienteController::class, 'atualizarCliente']);
Route::delete('profissional/cliente/delete/{id}', [ClienteController::class, 'excluirCliente']);
Route::get('profissional/cliente/all', [ClienteController::class, 'retornarTodos']);

//Agendamento

Route::get('agenda/horarios/profissionais', [AgendaController::class, 'retornarTodos']);
Route::delete('agenda/delete/{id}',[AgendaController::class,'excluirHorario']);
Route::put('agenda/atualizar/horarios', [AgendaController::class,'updateHorarios']);
Route::get('agenda/find/horario/{id}', [AgendaController::class, 'pesquisarPorIdAgenda']);
Route::get('agenda/find/datas', [AgendaController::class, 'pesquisarPorData']);
Route::post('agenda/find/data/', [AgendaController::class, 'pesquisarPorDataDoProfissional']);

//Admin
Route::post('admin/cadastrar', [AdministradorController::class, 'criarAdm']);
Route::post('admin/cadastrar/cliente',[ClienteController::class,'criarCliente']);
Route::post('admin/cadastrar/profissional',[ProfissionalController::class,'criarProfissional']);
Route::post('admin/cadastrar/servicos',[ServicoController::class,'criarServico']);
Route::put('admin/atualizar/cliente', [ClienteController::class,'atualizarCliente']);
Route::put('admin/atualizar/profissional', [ProfissionalController::class,'atualizarProfissional']);
Route::put('admin/atualizar/servico', [ServicoController::class,'atualizarServico']);
Route::delete('admin/cliente/delete/{id}',[ClienteController::class,'excluirCliente']);
Route::delete('admin/profissional/delete/{id}',[ProfissionalController::class,'excluirProfissional']);
Route::delete('admin/servico/delete/{id}',[ServicoController::class,'excluirServico']);
Route::get('admin/profissional/all', [ProfissionalController::class, 'retornarTodos']);
Route::get('admin/servico/all',[ServicoController::class, 'retornarTodos']);
Route::get('admin/cliente/all', [ClienteController::class, 'retornarTodos']);
Route::post('admin/pagamento/cadastrar', [PagamentoController::class, 'tipoPagamento']);
Route::delete('admin/pagamento/excluir/{id}', [PagamentoController::class, 'excluirPagamento']);
Route::put('admin/pagamento/update', [PagamentoController::class, 'updatePagamento']);
Route::get('admin/pagamento/retornarTodos', [PagamentoController::class, 'retornarTodos']);
Route::post('admin/cliente/atualizar/senha', [ClienteController::class, 'esqueciMinhaSenha']);
Route::post('admin/profissional/atualizar/senha', [ProfissionalController::class, 'esqueciMinhaSenha']);
Route::post('admin/atualizar/senha', [AdministradorController::class, 'esqueciMinhaSenha']);


//Tipo de Pagamento
Route::post('pagamento/cadastrar', [PagamentoController::class, 'tipoPagamento']);
Route::delete('pagamento/excluir/{id}', [PagamentoController::class, 'excluirPagamento']);
Route::put('pagamento/update', [PagamentoController::class, 'updatePagamento']);
Route::get('pagamento/retornarTodos', [PagamentoController::class, 'retornarTodos']);


//Autentificação

Route::post('/admin/create', [AdministradorController::class, 'store']);

Route::post('/login',[AdministradorController::class, 'login']);

Route::get('admin/teste', [AdministradorController::class, 'verficarUsuarioLogado'])
->middleware([
    'auth:sanctum', 
    SetSanctumGuard::class,
    IsAuthenticated::class]);



