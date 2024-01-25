<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagamentoController extends Controller
{
    public function tipoPagamento(FormaPagamentoRequest $request)
    {
        $pagamento = Pagamento::create([
            'tipoPagamento' => $request->tipoPagamento,
           
            
        ]);
        return response()->json([
            "sucess" => true,
            "message" => "Métodos de Pagamento Adicionado",
            "data" => $pagamento
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

    public function updatePagamento(FormaPagamentoRequest $request)
    {
        $pagamento = Pagamento::find($request->id);

        if (!isset($pagamento)) {
            return response()->json([
                'status' => false,
                'message' => 'Tipo de Pagamento não encontrado'
            ]);
        }

        if (isset($request->tipoPagamento)) {
            $pagamento->tipoPagamento = $request->tipoPagamento;
        }
        $pagamento->update();

        return response()->json([
            'status' => true,
            'message' => 'Tipo de Pagamento Atualizado'
        ]);
    }
}
