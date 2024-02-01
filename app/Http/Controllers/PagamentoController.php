<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormaPagamentoRequest;
use App\Http\Requests\PagamentoUpdateFormRequest;
use App\Models\Pagamento;
use Illuminate\Http\Request;

class PagamentoController extends Controller
{
    public function tipoPagamento(FormaPagamentoRequest $request)
    {
        $originalStatus = $request->status;
        $statusText = $request->status ? 'Ativado' : 'Desativado';
    
        $tipoPagamento = Pagamento::create([
            'nome' => $request->nome,
            'taxa' => $request->taxa,
            'status' => $originalStatus 
        ]);
    
        return response()->json([
            "success" => true,
            "message" => "Métodos de Pagamento Adicionado",
            "data" => [
                'nome' => $tipoPagamento->nome,
                'taxa' => $tipoPagamento->taxa,
                'status' => $statusText 
            ]
        ], 200);
    }




    public function excluirPagamento($id)
    {
        $pagamento = Pagamento::find($id);

        if (!isset($pagamento)) {
            return response()->json([
                'status' => false,
                'message' => "Pagamento não encontrado"
            ]);
        }
        $pagamento->delete();
        return response()->json([
            'status' => true,
            'message' => "Pagamento excluído com sucesso"
        ]);
    }

    public function updatePagamento(PagamentoUpdateFormRequest $request)
    {
        $pagamento = Pagamento::find($request->id);

        if (!isset($pagamento)) {
            return response()->json([
                'status' => false,
                'message' => 'Tipo de Pagamento não encontrado'
            ]);
        }

        if (isset($request->nome)) {
            $pagamento->nome = $request->nome;
        }
        
        if (isset($request->taxa)) {
            $pagamento->taxa = $request->taxa;
        }
        
        if (isset($request->status)) {
            $pagamento->status = $request->status;
        }
        $pagamento->update();

        return response()->json([
            'status' => true,
            'message' => 'Tipo de Pagamento Atualizado'
        ]);
    }

    public function retornarTodos()
    {
        $pagamento = Pagamento::all();
        return response()->json([
            'status' => true,
            'data' => $pagamento
        ]);
    }
}
