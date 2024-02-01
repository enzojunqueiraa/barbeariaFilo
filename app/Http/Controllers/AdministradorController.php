<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdmFormRequest;
use App\Models\Administrador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdministradorController extends Controller
{
    public function criarAdm(AdmFormRequest $request)
    {
        $administrador = Administrador::create([
            'nome' =>  $request->nome,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'senha' => Hash::make($request->senha)

        ]);
        return response()->json([
            "success" => true,
            "message" => "Administrador cadastrado com sucesso",
            "data" => $administrador
        ], 200);
    }

    public function pesquisarPorCpf(Request $request)
    {
        $administrador = Administrador::where('cpf', 'like', '%' . $request->cpf . '%')->get();

        if (count($administrador) > 0) {

            return response()->json([
                'status' => true,
                'data' => $administrador
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Não há resultados para a pesquisa.'
        ]);
    }
    
    public function retornarTodos()
    {
        $administrador = Administrador::all();
        return response()->json([
            'status' => true,
            'data' => $administrador
        ]);
    }

    public function pesquisarPorNome(Request $request)
    {
        $administrador =  Administrador::where('nome', 'like', '%' . $request->nome . '%')->get();

        if (count($administrador) > 0) {

            return response()->json([
                'status' => true,
                'data' => $administrador
            ]);
        } else {

            return response()->json([
                'status' => false,
                'message' => 'Não há resultados para a pesquisa.'
            ]);
        }
    }

    public function excluirAdm($id)
    {
        $administrador = Administrador::find($id);

        if (!isset($administrador)) {
            return response()->json([
                'status' => false,
                'message' => "Administrador não encontrado"
            ]);
        }
        $administrador->delete();
        return response()->json([
            'status' => true,
            'message' => "Administrador excluido com sucesso"
        ]);
    }

    public function atualizarAdm(AdmFormRequest $request)
    {
        $administrador = Administrador::find($request->id);

        if (!isset($cliente)) {
            return response()->json([
                'status' => false,
                'message' => "Clientes não atualizado"
            ]);
        }

        if (isset($request->nome)) {
            $administrador->nome = $request->nome;
        }

        if (isset($request->email)) {
            $administrador->email = $request->email;
        }

        if (isset($request->cpf)) {
            $administrador->cpf = $request->cpf;
        }

        

        if (isset($request->senha)) {
            $administrador->senha = $request->senha;
        }


        $administrador->update();

        return response()->json([
            'status' => true,
            'message' => "Administrador atualizado"
        ]);
    }

    public function esqueciMinhaSenha(Request $request)
    {
        $administrador = Administrador::where('email', 'LIKE', $request->email)->first();
        if ($administrador) {
            $novaSenha = $administrador->cpf;
            $administrador->update([
                'senha' => Hash::make
                ($novaSenha),
                'updated_at' => now()
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Senha redefinida',
                'nova_senha' => ($novaSenha)
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Administrador não encontrado'
            ]);
        }
    }
}
